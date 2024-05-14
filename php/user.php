<?php
error_reporting(-1);
require_once("../php/utils/cnx.database.php");
require("../php/utils/function.php");

isConnected();

/** TO DO
 * add_to_cart, remove_from_cart, view_cart, update_qity_in_cart
 * view_profile, update_profile
 */


if ($_SERVER["REQUEST_METHOD"] == "POST") $method = $_POST;
else $method = $_GET;


switch ($method["choisir"]) {
    case 'view_profile':
        if (!isset($method["id"]) || empty(trim($method["id"]))) {
            echo json_encode(["success" => false, "error" => "Données manquantes"]);
            die;
        }

        $mail_stmt = false;
        if (
            (isset($_SESSION["connected"]) || $_SESSION["connected"])
            && $_SESSION['user_id'] == $method['id']
        ) {
            $mail_stmt = " email, ";
        }

        $stmt = $bdd->prepare(" SELECT id_user, lastname, firstname, $mail_stmt image, admin
                                FROM users
                                WHERE id_user= :id");
        $stmt->bindValue(':id', $method['id'], PDO::PARAM_INT);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        echo json_encode(["success" => true, "user" => $user]);

        break;

    case "update_profile":
        // TO DO

        break;

    default:

        echo json_encode(["success" => false, "error" => "Mauvaise requête"]);
        break;
}
