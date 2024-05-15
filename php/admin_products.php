<?php
error_reporting(-1);
require_once ("utils/cnx.database.php");
require_once ("utils/function.php");

isConnected();
// isAdmin();

if ($_SERVER["REQUEST_METHOD"] == "POST")
    $method = $_POST;
else
    $method = $_GET;


switch ($method["choisir"]) {

    case "select_id":
        // Je selectionne tous les produits(tous les colonnes) ainsi que les catégories en fonction de leur id dans les produits.
        $stmt = $bdd->prepare("SELECT * FROM products  where id_product = :id_product ");
        $stmt->bindValue(":id_product", $method['id_product'], PDO::PARAM_INT); // contrainte 
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        // Je retourne tous les produits avec un message success
        echo json_encode(["success" => true, "product" => $product]);
        break;

    case "select":
        // Je selectionne tous les produits(tous les colonnes) ainsi que les catégories en fonction de leur id dans la table produits.
        $stmt = $bdd->query("SELECT p.*, c.name_category AS category FROM products p INNER JOIN categories c ON p.id_category = c.id_category ORDER BY id_product DESC");
        // J'affecte la totalité de mes résultats à la variable $products
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Je retourne tous les produits avec un message success
        echo json_encode(["success" => true, "products" => $products]);
        break;

    case "insert":
        isAdmin();
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            echo json_encode(["success" => false, "error" => "Méthode non permise"]);
            die;
        }
        if (
            !isset($method["name"], $method["desc"], $method["quantite"], $method["prix"], $method["reduction"], $method["id_category"]) || empty(trim($method["name"])) || empty(trim($method["desc"])) || empty(trim($method["quantite"])) || empty(trim($method["prix"])) || empty(trim($method["id_category"]))
        ) {
            // Si tous ces paramètres n'existent alors j'envoie une réponse success false.
            echo json_encode(["success" => false, "error" => "Données manquantes"]);
            die;
        }

        $img = null;

        // Je vérifie si l'image existe , si elle existe j'upload et je récupere son url. sinon j'envoie un message d"erreur.
        if (isset($_FILES["image"]["name"])) {
            $img = upload($_FILES);
        } else {
            echo json_encode(["success" => false, "error" => "Image manquante"]);
            die;
        }

        $stmt = $bdd->prepare("INSERT INTO products (product_name, description, product_quantity, product_picture, product_price, reduction, id_category) VALUES (:name, :description, :quantity, :img, :price, :reduction, :category_id)");
        // Grâce à la fonction bindvalue j'affecte chaque clé a sa valeur.
        $stmt->bindValue(":name", htmlspecialchars($method["name"]));
        $stmt->bindValue(":description", htmlspecialchars($method["desc"]));
        $stmt->bindValue(":price", htmlspecialchars($method["prix"]));
        $stmt->bindValue(":reduction", htmlspecialchars($method["reduction"]));
        $stmt->bindValue(":quantity", htmlspecialchars($method["quantite"]), PDO::PARAM_INT); // verifier si int.
        $stmt->bindValue(":img", $img);
        $stmt->bindValue(":category_id", htmlspecialchars($method["id_category"]));
        $stmt->execute();

        // J'envoie une réponse avec un success true, l'id du product que je viens d'insérer ainsi que l'image.
        echo json_encode(["success" => true, "id" => $bdd->lastInsertId(), "image" => $img]);
        break;

    case "update":
        isAdmin();
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            echo json_encode(["success" => false, "error" => "Méthode non permise"]);
            die;
        }
        if (!isset($method["name"], $method["desc"], $method["quantite"], $method["prix"], $method["id_category"], $method["id"]) || empty(trim($method["name"])) || empty(trim($method["desc"])) || empty(trim($method["quantite"])) || empty(trim($method["prix"])) || empty(trim($method["id_category"])) || empty(trim($method["id"]))) {
            // J'envoie une réponse avec un success false et un message d'erreur
            echo json_encode(["success" => false, "error" => "Données manquantes"]);
            die;
        }

        $img = false; // Je défini img à false par défaut
        if (isset($_FILES["image"]["name"]))
            $img = upload($_FILES); // Je récupère la réponse de l'upload

        $img_stmt = ''; // Par défaut rien n'est ajouté dans la requête SQL
        if ($img) {
            $img_stmt = ", product_picture = :img";
        } // S'il y a une image d'upload lors de la mise à jour je rajoute le bout de requête SQL correspondant.

        // J'écris une requete préparée de mise à jour du product à partir de son identifiant .
        $stmt = $bdd->prepare("UPDATE products SET product_name=:name, description=:desc, product_quantity=:quantity, product_price=:price, reduction=:reduction, id_category=:id_category $img_stmt WHERE id_product = :id");

        $stmt->bindValue(":name", $method["name"]);
        $stmt->bindValue(":desc", $method["desc"]);
        $stmt->bindValue(":quantity", $method["quantite"]);
        $stmt->bindValue(":price", $method["prix"]);
        $stmt->bindValue(":reduction", $method["reduction"]);
        $stmt->bindValue(":id_category", $method["id_category"]);
        $stmt->bindValue(":id", $method["id"]);
        if ($img)
            $stmt->bindValue(":img", $img); // Je peux modifier les informations d'un produit sans changer l'image de celui-ci.
        $stmt->execute();
        if ($stmt->rowCount())
            echo json_encode(["success" => true, "image" => $img]);
        else
            echo json_encode(["success" => false, "error" => $bdd->errorInfo()]);
        break;

    case "delete":
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            echo json_encode(["success" => false, "error" => "Méthode non permise"]);
            die;
        }

        if (!isset($method["id_product"]) || empty(trim($method["id_product"]))) {
            echo json_encode(["success" => false, "error" => "Id manquant"]);
            die;
        }

        // J'écris une requete préparée de suppression du product en fonction de son id.
        $stmt = $bdd->prepare("UPDATE products SET product_quantity= 0, supprime= 0 WHERE id_product = ? ");
        $stmt->execute([$method["id_product"]]);
        if ($stmt->rowCount())
            echo json_encode(["success" => true]);
        else
            echo json_encode(["success" => false, "error" => "Erreur de suppression"]);
        break;

    default:
        echo json_encode(["success" => false, "error" => "Mauvaise requête"]);
        break;
}
