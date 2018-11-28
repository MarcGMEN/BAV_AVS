<?php
/**
 * retourne les marques dans la liste des object
 */

function get_marques()
{
    $query = "SELECT obj_marque from bav_objet group by obj_marque";
    $tab=array();
    if ($result = $GLOBALS['mysqli']->query($query)) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++]=strtoupper($row['obj_marque']);
        }
        $result->close();
    }
    
    return $tab;
}
function getAllFiche()
{
    return getAll( "bav_objet", "obj_id");
}

function getOneFiche($id)
{
    return getOne($id,  "bav_objet", "obj_id");
}

function getFicheLibre($base)
{
    $row = null;
    $query = " SELECT obj_numero from bav_objet where obj_numero >= $base order by obj_numero";
    if ($result = $GLOBALS['mysqli']->query($query)) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            if ($row['obj_numero'] != $base) {
                break;
            }
            $base++;
        }
        $result->close();
    }
    return $base;
}


/**
 * recherche de la fiche par code
 */
function getOneFicheByCode($id)
{
    return  getOne($id,  "bav_objet", "obj_numero");
}

/**
 * recherche de la fiche par code
 */
function getOneFicheByIdModif($id)
{
    return getOne($id,  "bav_objet", "obj_id_modif");
}


function updateFiche($obj)
{
    return update('bav_objet', $obj, "obj_id");
}

function insertFiche($obj)
{
    return insert('bav_objet', $obj);
}
