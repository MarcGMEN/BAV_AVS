<?php
/**
 * retourne les marques dans la liste des object
 */
function get_marques()
{
    $query = "SELECT obj_marques from objet group by obj_marques";
    $tab=array();
    if ($result = $GLOBALS['MYSQLI']->query($query)) {
        $tab=array();
        $index=0;
        while ($row = $resultat->fetch_assoc()) {
            $tab[$index++]=strtoupper($row);
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

function getCountFiche()
{
    $row = null;
    $requete2 = " SELECT count(*) from objet ";
    $row=$GLOBALS['MYSQLI']->query($requete2)->fetch_assoc();
    return $row['count(*)'];
}


/**
 * recherche de la fiche par code
 */
function getOneFicheByCode($id)
{
    return getOne($id, "objet", "obj_numero");
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
