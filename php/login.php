<?php
error_reporting(-1);
require_once("../php/utils/cnx.database.php");


if (!isset($_POST["email"], $_POST["pwd"])) {
    echo json_encode(["success" => false, "error" => "Données introuvables"]);
    die;
}
if (empty(trim($_POST["email"])) || empty(trim($_POST["pwd"]))) {
    echo json_encode(["success" => false, "error" => "Données vides"]);
    die;
}
$stmt = $bdd->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$_POST["email"]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


if ($user && password_verify($_POST["pwd"], $user["pwd"])) { // Si l'authentification est réçu, je demarre une session
    session_start();
    $_SESSION["connected"] = true; // l'utilisateur est connecté 
    $_SESSION["user_id"] = $user["id_user"]; // l'id de l'utilisateur 
    $_SESSION["admin"] = $user["admin"];    // l'id de l'admi

    unset($user["pwd"]); // supprimer le mot de passe / sécurité / en réponse Json le mdp n'est pas inclus
    echo json_encode(["success" => true, "user" => $user]);
} else {
    $_SESSION = []; // En cas de l'echec de l'authentification,user non trouvé dans la BDD ou mot de passe incorrect , la session est reinitialisé en supprimant les informations stocké dans  $_session. en detruisant la session. et j'envoie une réponse json success false.
    if (session_status() !== PHP_SESSION_NONE) {
        session_destroy();
    }
    echo json_encode(["success" => false, "error" => "Aucun utilisateur"]);
}
