<?php

// Paramètre de connéxion à la base de données.
$host = "localhost"; // XAMPP 
$username = "root"; // Utilisateur root
$password = ""; // Mot de passe 
$dbname = "project-e-commerce"; // le nom de ma base de données.


try {
    // Avec les différents paramètres je crée une connexion à ma base de données.
    $bdd = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configuration de mode d'affichage des erreurs.
    return $bdd;
} catch (ErrorException $e) {
    $message = "Erreur PDO avec le message : " . $e->getMessage();
    die($message);
}
