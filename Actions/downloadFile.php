<?php

require_once "../Commun/commun_functions.php";
require_once "../Commun/connect.php";
require_once "../config.ini";

$message = "";

if ($_FILES['file']["error"] == 0) {
//    $dataFile = file_get_contents($_FILES['file']['tmp_name']);
    try {
        move_uploaded_file($_FILES['file']['tmp_name'], "../downloads/" . $_FILES['file']['name']);
    } catch (Exception $e) {
        $message = $e->getMessage();
    }

} else {
    switch ($_FILES['file']["error"]) {
        case UPLOAD_ERR_INI_SIZE:
            $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
            break;
        case UPLOAD_ERR_PARTIAL:
            $message = "The uploaded file was only partially uploaded";
            break;
        case UPLOAD_ERR_NO_FILE:
            $message = "No file was uploaded";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $message = "Missing a temporary folder";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $message = "Failed to write file to disk";
            break;
        case UPLOAD_ERR_EXTENSION:
            $message = "File upload stopped by extension";
            break;

        default:
            $message = "Erreur d'upload inconnue [" . $_FILES['file']["error"] . "]";
            break;
    }
}

$page_src = "location:../index.php?page=downloads.php&message=" . addslashes($message);
header($page_src);
