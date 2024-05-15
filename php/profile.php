<?php

error_reporting(-1);

require_once ("../php/utils/cnx.database.php");
require ("../php/utils/function.php");

isConnected();
//isAdmin();

if ($_SERVER["REQUEST_METHOD"] == "POST")
    $method = $_POST;
else
    $method = $_GET;

switch ($method["choisir"]) {
    case 'select_id':
        $stmt = $bdd->prepare("SELECT lastname, firstname, email, adresse, ville, code_postal from users WHERE id_user= ?;");
        $stmt->execute([$method["user_id"]]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(["success" => true, "user" => $user]);
        break;
    case 'order':

        $stmt = $bdd->prepare("SELECT * FROM orders WHERE id_user = :id");

        $stmt->bindValue(":id", $method["user_id"]);
        $stmt->execute();

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($orders as $key => $order) {
            $stmt = $bdd->prepare("SELECT * FROM product_order inner join products on products.id_product=product_order.id_product WHERE product_order.id_order = :id");
            $stmt->bindValue(":id", $order["id_order"]);
            $stmt->execute();
            $orders[$key]["products"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode(["success" => true, "orders" => $orders]);
        break;

    case 'update_info':
        // Assurez-vous que toutes les données nécessaires sont présentes
        if (isset($method["user_id"], $method["lastName"], $method["firstName"], $method["address"], $method["city"], $method["code"])) {
            $stmt = $bdd->prepare("UPDATE users SET lastname = ?, firstname = ?, adresse = ?, ville = ?, code_postal = ? WHERE id_user = ?;");
            $success = $stmt->execute([
                $method["lastName"],
                $method["firstName"],
                $method["address"],
                $method["city"],
                $method["code"],
                $method["user_id"]
            ]);
            $selectStmt = $bdd->prepare("SELECT * FROM users WHERE id_user = ?;");
            $selectStmt->execute([$method["user_id"]]);
            $updatedUser = $selectStmt->fetch(PDO::FETCH_ASSOC);

            if ($updatedUser) {
                echo json_encode(["success" => true, "message" => "Informations mises à jour avec succès.", "user" => $updatedUser]);
            } else {
                echo json_encode(["success" => false, "error" => "Erreur lors de la récupération des informations mises à jour."]);
            }
        } else {
            echo json_encode(["success" => false, "error" => "Données incomplètes pour la mise à jour."]);
        }
        break;
    case 'update_pwd':
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            echo json_encode(["success" => false, "error" => "Mauvaise méthode"]);
            die;
        }

        if (!isset($method["ancienpwd"], $method["newpwd"], $method["confirmpwd"]) || empty(trim($method["newpwd"])) || empty(trim($method["ancienpwd"])) || empty(trim($method["confirmpwd"]))) {
            echo json_encode(["success" => false, "error" => "Données introuvables"]);
            die;
        }
        $stmt = $bdd->prepare("SELECT pwd FROM users WHERE id_user = :id");
        $stmt->bindvalue(":id", $method["user_id"]);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!($user && password_verify($_POST["ancienpwd"], $user["pwd"]))) {
            echo json_encode(["success" => false, "error" => "Le mot de passe incorrect"]);
            die;
        }

        if (password_verify($_POST["newpwd"], $user["pwd"])) {
            echo json_encode(["success" => false, "error" => "Le mot de passe doit etre différent de l'ancien"]);
            die;
        }

        if (($_POST["newpwd"] != $_POST["confirmpwd"])) {
            echo json_encode(["success" => false, "error" => "Les mots de passe ne sont pas identiques"]);
            die;
        }

        $regex = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9]{8,12}$/";
        if (!preg_match($regex, $_POST["newpwd"])) {
            echo json_encode(["success" => false, "error" => "Le mot de passe ne correspond pas au format : longueur 8 à 12 caratecre, au moins (un chiffre, une lettre majuscule, minuscule)"]);
            die;
        }

        $hash = password_hash($_POST["newpwd"], PASSWORD_DEFAULT);
        $stmt = $bdd->prepare("UPDATE users SET pwd = :pwd WHERE id_user = :id");
        $stmt->bindValue(":id", $method["user_id"]);
        $stmt->bindValue(":pwd", $hash);
        $stmt->execute();

        if ($stmt->rowcount()) {
            echo json_encode(["success" => true, "message" => "Le mot de passe est bien mis à jour avec success"]);
        } else {
            echo json_encode(["success" => false, "error" => "La mise à jour a échoué"]);
        }
        break;


    case 'update_avatar':
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            echo json_encode(["success" => false, "error" => "Méthode non permise"]);
            die;
        }
        if (!isset($_FILES["image"])) {
            echo json_encode(["success" => false, "error" => "Aucun fichier d'avatar fourni"]);
            die;
        }
        $avatar = $_FILES["image"]["name"];
        $location = __DIR__ . "/../assets/avatar/$avatar";
        $extension = pathinfo($avatar, PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        $valid_extensions = ["jpg", "jpeg", "png", "gif"];
        if (in_array($extension, $valid_extensions)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $location)) {
                $stmt = $bdd->prepare("UPDATE users SET image = :avatar WHERE id_user = :id");
                $stmt->bindValue(":avatar", $avatar);
                $stmt->bindValue(":id", $_POST["user_id"]);
                $stmt->execute();
                if ($stmt->rowCount()) {
                    echo json_encode(["success" => true, "message" => "Avatar mis à jour avec succès", "image" => $avatar]);
                } else {
                    echo json_encode(["success" => false, "error" => "La mise à jour de l'avatar a échoué"]);
                }
            } else {
                echo json_encode(["success" => false, "error" => "Erreur lors de l'upload du fichier"]);
            }
        } else {
            echo json_encode(["success" => false, "error" => "Type de fichier non supporté"]);
        }
        break;

    case 'view_profile':
        if (!isset($method["id"]) || empty(trim($method["id"]))) {
            echo json_encode(["success" => false, "error" => "Données manquantes"]);
            die;
        }

        $stmt = $bdd->prepare(" SELECT id_user, lastname, firstname, email,  image, admin
                            FROM users
                            WHERE id_user= :id");
        $stmt->bindValue(':id', $method['id'], PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode(["success" => true, "user" => $user]);
        break;
}

// TO DO
// Ajouter des produits dans son panier, supprimer des produits , update la quantité dans son panier
// update son profile 

// modifier l'ud de l'utilisateur que si je suis l'utilsiateur connecté
