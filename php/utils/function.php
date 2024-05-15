<?php

session_start();
function isConnected()
{
    // Si la clé connected n'existe pas dans la superglobale SESSION alors :
    if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {
        return false;
    } else {
        return true;
    }
}

function isConnected2()
{
    // Si la clé connected n'existe pas dans la superglobale SESSION alors :
    if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) {
        echo json_encode(["success" => false, "error" => "Vous n'êtes pas connecté"]);
        die;
    }
}

function isAdmin()
{
    // Si la clé admin n'existe pas dans la superglobale SESSION alors:
    if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != "1") {
        echo json_encode(["success" => false, "error" => "Vous n'êtes pas autorisé"]);
        die;
    }
}

function upload($file)
{
    if (isset($file["image"]["name"])) {
        $filename = $file["image"]["name"];

        $location = __DIR__ . "/../../assets/product/$filename";
        $extension = pathinfo($location, PATHINFO_EXTENSION);
        $extension = strtolower($extension);

        $valid_extensions = ["jpg", "png", "gif", "jpeg"];
        if (in_array($extension, $valid_extensions)) {
            if (move_uploaded_file($file["image"]["tmp_name"], $location)) return $filename;
            else return false;
        } else return false;
    } else return false;
}
