<?php
error_reporting(-1);
require_once("utils/cnx.database.php");
require_once("utils/function.php");

isConnected();
// isAdmin();

if ($_SERVER["REQUEST_METHOD"] == "POST") $method = $_POST;
else $method = $_GET;


switch ($method["choisir"]) {
    case 'select':

        $stmt = $bdd->query("SELECT id_category, name_category FROM categories");

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(["success" => true, "categories" => $categories]);
        break;

    case 'insert':

        if (!isset($method["name_category"]) || empty(trim($method["name_category"]))) {
            echo json_encode(["success" => false, "error" => "id_category manquant"]);
            die;
        }

        $stmt = $bdd->prepare("INSERT INTO categories(name_category) VALUE (:name_category) ; ");
        $stmt->bindValue(":name_category", $method["name_category"]);
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => $bdd->errorInfo()]);
        }


        break;

    case 'select_id':
        if (!isset($method["id_category"]) || empty(trim($method["id_category"]))) {
            echo json_encode(["success" => false, "error" => "id_category manquant"]);
            die;
        }

        $stmt = $bdd->prepare("SELECT id_category, name_category FROM categories WHERE id_category = ?");
        $stmt->execute([$method["id_category"]]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(["success" => true, "category" => $category]);
        break;

    case 'update':

        if (!isset($method["name_category"], $method["id_category"]) || empty(trim($method["name_category"]))) {
            echo json_encode(["success" => false, "error" => $method]);
            die;
        }

        $stmt = $bdd->prepare("UPDATE categories SET name_category = :name_category WHERE id_category = :id_category");
        $stmt->bindValue(":name_category", $method["name_category"]);
        $stmt->bindValue(":id_category", $method["id_category"]);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => $bdd->errorInfo()]);
        }

        break;

    case 'delete':

        if (!isset($method["id_category"]) || empty(trim($method["id_category"]))) {
            echo json_encode(["success" => false, "error" => $method]);
            die;
        }

        $stmt = $bdd->prepare("DELETE FROM categories  WHERE id_category = :id_category");
        $stmt->bindValue(":id_category", $method["id_category"]);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => $bdd->errorInfo()]);
        }

        break;
    default:

        echo json_encode(["success" => false, "error" => "Mauvaise requête"]);
        break;
}
