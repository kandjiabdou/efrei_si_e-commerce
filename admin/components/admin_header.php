<?php

error_reporting(-1);
require_once("../../php/utils/cnx.database.php");
require_once("../../php/utils/function.php");
// je vérifie si il y'a une session active:si la session est null alors je demarre une session.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
isConnected();

// Je vérifie si l'utilisateur connecté est admin ou pas.
if ($_SESSION["admin"] == 0) {
    header("Location: ../home/");
}
