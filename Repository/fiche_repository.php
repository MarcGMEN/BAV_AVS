<?php
/**
 * retourne les marques dans la liste des object
 */

function get_marques()
{
    $query = "SELECT obj_marque from objet group by obj_marque";
    $tab=array();
    if ($result = $GLOBALS['MYSQLI']->query($query)) {
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
    return getAll("objet", "obj_id");
}

function getOneFiche($id)
{
    return getOne($id, "objet", "obj_id");
}

function getFicheLibre($base)
{
    $row = null;
    $query = " SELECT obj_numero from objet where obj_numero >= $base order by obj_numero";
    if ($result = $GLOBALS['MYSQLI']->query($query)) {
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
    return  getOne($id, "objet", "obj_numero");
}

/**
 * recherche de la fiche par code
 */
function getOneFicheByIdModif($id)
{
    return getOne($id, "objet", "obj_id_modif");
}


function updateFiche($obj)
{
    return update('objet', $obj, "obj_id");
}

function insertFiche($obj)
{
    return insert('objet', $obj);
}
