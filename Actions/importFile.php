<?php

require_once "../Commun/commun_functions.php";
require_once "../Commun/connect.php";
require_once "../config.ini";
require_once "../Repository/base_repository.php";
require_once "../Repository/parametre_repository.php";
require_once "../Repository/fiche_repository.php";
require_once "../AJAX/parametre_AJAX.php";
require_once "../AJAX/AJAX.php";
require_once "../Repository/fiche_repository.php";
require_once "../Repository/client_repository.php";
require_once "../Commun/Sajax.php";
require_once "../Commun/mail.php";
require_once "../Commun/html2pdf.php";

$par = return_infoAppli();
$tabType = return_enum('bav_objet', 'obj_type');
$tabPublic = return_enum('bav_objet', 'obj_public');
$tabPratique =  return_enum('bav_objet', 'obj_pratique');
// Check if image file is a actual image or fake image
if (isset($_POST['cli_id']) && $_POST['cli_id'] != '') {
    if ($_FILES['file']["error"] == 0) {
        $nbFiche = 0;
        $nbFicheKo = 0;
        $noligne = 1;
        $dataFile = file_get_contents($_FILES['file']['tmp_name']);
        $tabData = explode("\n", $dataFile);
        $fiche = array();
        $textePlus = "";
        $textePlusKo = "";
        foreach ($tabData as $ligne) {
            $fiche = array();
            $fiche['obj_numero_bav'] = $par['numero_bav'];
            if (strlen(trim($ligne)) > 0) {
                $val = explode("|", $ligne);

                if (sizeof($val) == 11) {
                    if ($val[0] != 'Type') {
                        try {
                            if (array_search($val[0], $tabType)) {
                                $fiche['obj_type'] = $val[0];
                            } else {
                                $fiche['obj_type'] = "Autre";
                            }
                            if (array_search($val[1], $tabPublic)) {
                                $fiche['obj_public'] = $val[1];
                            } else {
                                $fiche['obj_public'] = "Autre";
                            }
                            if (array_search($val[2], $tabPratique)) {
                                $fiche['obj_pratique'] = $val[2];
                            } else {
                                $fiche['obj_pratique'] = "Autre";
                            }
                            $fiche['obj_marque'] = strtoupper($val[3]);
                            $fiche['obj_modele'] = strtoupper($val[4]);
                            $fiche['obj_couleur'] = strtoupper($val[5]);
                            $fiche['obj_date_achat'] = $val[6];
                            $fiche['obj_prix_achat'] = $val[7];
                            $fiche['obj_taille'] = $val[8];
                            $fiche['obj_description'] = $val[9];
                            $fiche['obj_prix_depot'] = $val[10];
                            
                            makeNumeroFiche($_POST['base'], $fiche);
                            $fiche['obj_etat'] = 'CONFIRME';

                            $fiche['obj_id_vendeur'] = $_POST['cli_id'];

                            insertFiche($fiche);
                            $nbFiche++;
                            $textePlus .= $fiche['obj_numero'] . ",";
                        } catch (Exception $e) {
                            $nbFicheKo++;
                            $textePlusKo .= "$noLigne (" . $e->getMessage() . "),";
                        }
                    }
                } else {
                    $nbFicheKo++;
                    $textePlusKo .= "$noLigne (Nombre de champ incorrect " . sizeof($val) . " != 11),";
                }
                $noLigne++;
            }
        }
        $message = "Création de $nbFiche fiche(s) [" . $textePlus . "]";
        if ($nbFicheKo > 0) {
            $message .= ", avec [" . $nbFicheKo . "] erreur sur les lignes : $textePlusKo";
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
} else {
    $message = "Client non renseigné.";
}
$page_src = "location:../index.php?page=import.php&message=" . addslashes($message);
header($page_src);
