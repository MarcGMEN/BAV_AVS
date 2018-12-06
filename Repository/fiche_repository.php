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
    } else {
        throw new Exception("Pb d'update' [$req]".mysqli_error());
    }
    
    return $tab;
}
function getAllFiche()
{
    return getAll("bav_objet", "obj_id");
}

function getOneFiche($id)
{
    return getOne($id, "bav_objet", "obj_id");
}

function makeNumeroFiche($base, &$objet)
{
    $objet['obj_numero']=getFicheLibre($base);
    // creation de idmodif
    $objet['obj_id_modif']=substr(hash_hmac('md5', $objet['obj_numero'], 'avs44'+$_COOKIE['NUMERO_BAV']), 0, 5);
}

function getFicheLibre($base)
{
    $row = null;
    $query = " SELECT obj_numero from bav_objet where obj_numero >= $base and obj_numero_bav = ".
        $_COOKIE['NUMERO_BAV']." order by obj_numero";
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
    } else {
        throw new Exception("Pb d'update' [$req]".mysqli_error());
    }
    return $base;
}


/**
 * recherche de la fiche par code
 */
function getOneFicheByCode($id, $numeroBAV)
{
    $row = null;
    if (isset($id)) {
        $requete2 = " SELECT * from bav_objet ";
        $requete2 .= " where obj_numero = '" . $id."'";
        $requete2 .= " and  obj_numero_bav = '" . $numeroBAV."'";
        $row=$GLOBALS['mysqli']->query($requete2)->fetch_assoc();
    }
    return $row;
}

/**
 * recherche de la fiche par code
 */
function getOneFicheByIdModif($id)
{
    return getOne($id, "bav_objet", "obj_id_modif");
}


function updateFiche($obj)
{
    return update('bav_objet', $obj, "obj_id");
}

function insertFiche($obj)
{
    return insert('bav_objet', $obj);
}

function deleteFiche($id)
{
    return delete('bav_objet', $id, "obj_id");
}
