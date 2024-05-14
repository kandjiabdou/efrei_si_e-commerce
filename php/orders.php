<?php
error_reporting(-1);
require_once("../php/utils/cnx.database.php");
require("../php/utils/function.php");


isConnected();



if ($_SERVER["REQUEST_METHOD"] == "POST") $method = $_POST;
else $method = $_GET;



switch ($method["choisir"]) {

    case "insert":
        if (!isset($method["user"], $method["panier"])) {
            // J'envoie une réponse avec un success false et un message d'erreur
            echo json_encode(["success" => false, "error" => "Données manquantes"]);
            die;
        }
        $stmtOrder = $bdd->prepare("INSERT into orders(id_user) VALUE (:idUser)");
        $stmtOrder->bindValue(":idUser", $method["user"]['id_user'], PDO::PARAM_INT);
        if ($stmtOrder->execute()) {
            $idOrder = $bdd->lastInsertId();

            foreach ($method['panier'] as $produitPanier) {
                $stmt = $bdd->prepare("INSERT into product_order(quantity, id_product, id_order ) VALUES (:quantity, :product, :order) ");
                $stmt->bindValue(":quantity", $produitPanier['quantity']);
                $stmt->bindValue(":product", $produitPanier['id_product']);
                $stmt->bindValue(":order", $idOrder);
                $stmt->execute();
            }
        }





        echo json_encode(["success" => true]);

        break;

    default:

        echo json_encode(["success" => false, "error" => "Mauvaise requête"]);
        break;
}
