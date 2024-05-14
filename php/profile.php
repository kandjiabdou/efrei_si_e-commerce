<?php

error_reporting(-1);

require_once("../php/utils/cnx.database.php");
require("../php/utils/function.php");

isConnected();
//isAdmin();

if ($_SERVER["REQUEST_METHOD"] == "POST")  $method = $_POST;
else $method = $_GET;

switch ($method["choisir"]) {
    case 'select_id':
        $stmt = $bdd->prepare("SELECT lastname, firstname, email from users WHERE id_user= ?;");
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


    case 'update_pwd':
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            echo json_encode(["success" => false, "error" => "Mauvaise méthode"]);
            die;
        }

        if (!isset($method["ancienpwd"], $method["newpwd"], $method["confirmpwd"])  || empty(trim($method["newpwd"])) || empty(trim($method["ancienpwd"])) || empty(trim($method["confirmpwd"]))) {
            echo json_encode(["success" => false, "error" => "Données introuvables"]);
            die;
        }



        $stmt = $bdd->prepare("SELECT pwd FROM users WHERE id_user = :id");
        $stmt->bindvalue(":id", $method["user_id"]);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if (!($user && password_verify($_POST["ancienpwd"], $user["pwd"]))) {
            echo json_encode(["success" => false, "error" => " mot de passe incorrect"]);
            die;
        }
        if (($_POST["newpwd"] != $_POST["confirmpwd"])) {
            echo json_encode(["success" => false, "error" => " Les mots de passe ne sont pas identiques"]);
            die;
        }
        $regex = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9]{8,12}$/";
        if (!preg_match($regex, $_POST["newpwd"])) {
            echo json_encode(["success" => false, "error" => "Le mot de passe ne correspond pas au format"]);
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
