<?php
error_reporting(-1);
require_once("../php/utils/cnx.database.php");
require("../php/utils/function.php");

isConnected();
isAdmin();

if ($_SERVER["REQUEST_METHOD"] == "POST") $method = $_POST;
else $method = $_GET;


switch ($method["choisir"]) {
    case 'select':

        $stmt = $bdd->query("SELECT id_user, firstname, lastname, email, admin FROM users");

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(["success" => true, "users" => $users]);
        break;

    case 'select_id':
        if (!isset($method["user_id"]) || empty(trim($method["user_id"]))) {
            echo json_encode(["success" => false, "error" => "Id manquant"]);
            die;
        }

        $stmt = $bdd->prepare("SELECT id_user, firstname, lastname, email FROM users WHERE id_user = ?");
        $stmt->execute([$method["user_id"]]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(["success" => true, "user" => $user]);
        break;

    case 'update':

        if (!isset($method["firstname"], $method["lastname"], $method["email"], $method["user_id"]) || empty(trim($method["firstname"])) || empty(trim($method["lastname"])) || empty(trim($method["email"])) || empty(trim($method["user_id"]))) {
            echo json_encode(["success" => false, "error" => $method]);
            die;
        }

        $regex = "/^[a-zA-Z0-9-+._]+@[a-zA-Z0-9-]{2,}\.[a-zA-Z]{2,}$/";

        if (!preg_match($regex, $method["email"])) {

            echo json_encode(["success" => false, "error" => "Email ne correspond pas au format"]);
            die;
        }

        $stmt = $bdd->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id_user = :user_id");
        $stmt->bindValue(":firstname", $method["firstname"]);
        $stmt->bindValue(":lastname", $method["lastname"]);
        $stmt->bindValue(":email", $method["email"]);
        $stmt->bindValue(":user_id", $method["user_id"]);;

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => $bdd->errorInfo()]);
        }


        break;

    case 'adminchoisir':

        $stmt = $bdd->prepare("select admin from users where id_user= :id");
        $stmt->bindvalue(":id", $_SESSION["user_id"]);
        $stmt->execute();
        $current_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$current_user['admin']) {
            echo json_encode((["success" => false]));
        }

        if (!isset($method["id_user"]) ||  empty(trim($method["id_user"]))) {
            echo json_encode(["success" => false, "error" => "Données manquantes"]);
            die;
        }
        $stmt = $bdd->prepare("select admin from users where id_user= :id");
        $stmt->bindvalue(":id", $method["id_user"]);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $adminString = $user['admin'] ? " 0" : " 1";
        $stmt = $bdd->prepare("update users set admin = $adminString WHERE id_user = :id");
        $stmt->bindvalue(":id", $method["id_user"]);
        $stmt->execute();

        echo json_encode((["success" => true]));
};
