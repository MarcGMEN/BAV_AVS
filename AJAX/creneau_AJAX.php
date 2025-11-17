<?php

/**************************************/
/**************************************/
/* CRENEAU */
/**************************************/
/**************************************/
function get_creneau($id)
{
    return getOne($id, "bav_creneau", "cre_id");
}
function addCreneau($debut, $fin)
{

    $newDebut = dateMysqlInt(str_replace("T", " ", $debut) . ":00");
    $newFin = dateMysqlInt(str_replace("T", " ", $fin) . ":00");
    // recherche des creneaux
    foreach (getAllCreneaux() as $creneau) {

        error_log($creneau['cre_debut'] . ":00");
        $oldDebut = dateMysqlInt(str_replace("T", " ", $creneau['cre_debut']) . ":00");
        $oldFin = dateMysqlInt(str_replace("T", " ", $creneau['cre_fin']) . ":00");

        if ($oldDebut < $newFin && $oldFin > $newDebut) {
            return "Creneau déjà présent.";
        }
    }

    $theCreneau['cre_debut'] = $debut;
    $theCreneau['cre_fin'] = $fin;

    insertCreneau($theCreneau);
}

function get_creneaux()
{
    return getAllCreneaux();
}

function delete_creneau($id)
{
    return deleteCreneau($id);
}


function get_count_creneaux()
{
    return getNbForCreneaux();
}

function get_count_creneaux_by_classeur()
{
    return getNbForCreneauxParClasseur();
}

function get_count_creneaux_by_classeur_reel()
{
    return  getNbForCreneauxParClasseurReel();
}

function get_init_creneaux_by_classeur()
{
    return  getInitCreneauxParClasseur();
}
function get_count_creneaux_for_fiche($numero)
{
    return getNbForCreneauxParFiche($numero);
}
