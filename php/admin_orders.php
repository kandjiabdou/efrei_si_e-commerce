<?php
error_reporting(-1);
require_once("../php/utils/cnx.database.php");
require("../php/utils/function.php");


isConnected();
isAdmin();

if ($_SERVER["REQUEST_METHOD"] == "POST") $method = $_POST;
else $method = $_GET;



switch ($method["choisir"]) {


    case "select_id":

        $stmt = $bdd->prepare("SELECT o.*, concat(u.firstname, ' ', u.lastname) as client  
                                FROM orders as o 
                                INNER JOIN users u ON u.id_user = o.id_user 
                                where id_order = :id_order ");
        $stmt->bindValue(":id_order", $method['id_order'], PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $bdd->prepare("SELECT p.*, po.quantity 
                                FROM product_order po 
                                INNER JOIN products p ON po.id_product = p.id_product 
                                WHERE po.id_order = :id_order");
        $stmt->bindValue(":id_order", $method['id_order'], PDO::PARAM_INT);
        $stmt->execute();
        $order["products"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(["success" => true, "order" => $order]);
        break;



    case "select":

        $stmt = $bdd->query("SELECT o.*, concat(u.firstname, ' ', u.lastname) as client, count(po.id_order) AS total_products 
                        FROM orders o 
                        LEFT JOIN product_order po ON po.id_order = o.id_order 
                        INNER JOIN users u ON u.id_user =o.id_user
                        GROUP BY (po.id_order) DESC
                        ");
        // J'affecte la totalité de mes résultats à la variable $orders
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Je retourne tous les produits avec un message success
        echo json_encode(["success" => true, "orders" => $orders]);
        break;
    case "validate":
        if ($_SERVER["REQUEST_METHOD"] != "GET") {

            echo json_encode(["success" => false, "error" => "Méthode non permise"]);
            die;
        }


        if (!isset($method["id"]) || empty(trim($method["id"]))) {
            // J'envoie une réponse avec un success false et un message d'erreur
            echo json_encode(["success" => false, "error" => "Données manquantes"]);
            die;
        }

        // J'écris une requete préparée de mise à jour du product à partir de son produit.
        $stmt = $bdd->prepare("UPDATE orders SET statut=:statut 
                WHERE id_order = :id");

        $stmt->bindValue(":id", $method["id"]);
        $stmt->bindValue(":statut", 1, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount()) echo json_encode(["success" => true]);
        else echo json_encode(["success" => false, "error" => $bdd->errorInfo()]);
        break;

    case "delete":
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            echo json_encode(["success" => false, "error" => "Méthode non permise"]);
            die;
        }

        if (!isset($method["id_order"]) || empty(trim($method["id_order"]))) {
            echo json_encode(["success" => false, "error" => "Id manquant"]);
            die;
        }

        // J'écris une requete préparée de suppression du product en fonction de son id.
        $stmt = $bdd->prepare("DELETE FROM orders WHERE id_order = ? ");
        $stmt->execute([$method["id_order"]]);
        if ($stmt->rowCount()) echo json_encode(["success" => true]);
        else echo json_encode(["success" => false, "error" => "Erreur de suppression"]);
        break;


    default:

        echo json_encode(["success" => false, "error" => "Mauvaise requête"]);
        break;
}
