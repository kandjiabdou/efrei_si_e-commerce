<?php
error_reporting(-1); // Affichage de toutes les erreurs. 
require_once("../php/utils/cnx.database.php");
require("../php/utils/function.php");

// Vérification de la méthode.
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["success" => false, "error" => "Méthode non permise"]);
    die;
}
if (!isset($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["pwd"])) {
    echo json_encode(["success" => false, "error" => "Données introuvables"]);
    die;
}
if (
    empty(trim($_POST["firstname"])) ||
    empty(trim($_POST["lastname"])) ||
    empty(trim($_POST["email"])) ||
    empty(trim($_POST["pwd"]))
) {
    echo json_encode(["success" => false, "error" => "Données vides"]);
    die;
}

$regex = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9]{8,12}$/";
if (!preg_match($regex, $_POST["pwd"])) {
    echo json_encode(["success" => false, "error" => "Le mot de passe ne correspond pas au format"]);
    die;
}
$hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

$stmt = $bdd->prepare("INSERT INTO users(firstname,lastname, email, pwd) VALUES (:firstname, :lastname, :email, :pwd)");
$stmt->bindvalue(":firstname", htmlspecialchars($_POST["firstname"]));
$stmt->bindvalue(":lastname", htmlspecialchars($_POST["lastname"]));
$stmt->bindvalue(":email", htmlspecialchars($_POST["email"]));
$stmt->bindvalue(":pwd", $hash);
$stmt->execute();

if ($stmt->rowcount()) echo json_encode(["success" => true]);
else echo json_encode(["success" => false, "error" => "email déja existant"]);
