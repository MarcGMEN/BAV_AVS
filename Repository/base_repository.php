<?php
/*
       NOT_NULL_FLAG = 1
       PRI_KEY_FLAG = 2
       UNIQUE_KEY_FLAG = 4
       BLOB_FLAG = 16
       UNSIGNED_FLAG = 32
       ZEROFILL_FLAG = 64
       BINARY_FLAG = 128
       ENUM_FLAG = 256
       AUTO_INCREMENT_FLAG = 512
       TIMESTAMP_FLAG = 1024
       SET_FLAG = 2048
       NUM_FLAG = 32768
       PART_KEY_FLAG = 16384
       GROUP_FLAG = 32768
       UNIQUE_FLAG = 65536
*/
function map_field_type_to_bind_type($field_type)
{
    switch ($field_type) {
        case MYSQLI_TYPE_DECIMAL:
        case MYSQLI_TYPE_NEWDECIMAL:
        case MYSQLI_TYPE_FLOAT:
        case MYSQLI_TYPE_DOUBLE:
            return 'd';

        case MYSQLI_TYPE_BIT:
        case MYSQLI_TYPE_TINY:
        case MYSQLI_TYPE_SHORT:
        case MYSQLI_TYPE_LONG:
        case MYSQLI_TYPE_LONGLONG:
        case MYSQLI_TYPE_INT24:
        case MYSQLI_TYPE_YEAR:
        case MYSQLI_TYPE_ENUM:
            return 'i';

        case MYSQLI_TYPE_TIMESTAMP:
        case MYSQLI_TYPE_DATE:
        case MYSQLI_TYPE_TIME:
        case MYSQLI_TYPE_DATETIME:
        case MYSQLI_TYPE_NEWDATE:
        case MYSQLI_TYPE_INTERVAL:
        case MYSQLI_TYPE_SET:
        case MYSQLI_TYPE_VAR_STRING:
        case MYSQLI_TYPE_STRING:
        case MYSQLI_TYPE_CHAR:
        case MYSQLI_TYPE_GEOMETRY:
            return 's';

        case MYSQLI_TYPE_TINY_BLOB:
        case MYSQLI_TYPE_MEDIUM_BLOB:
        case MYSQLI_TYPE_LONG_BLOB:
        case MYSQLI_TYPE_BLOB:
            return 'b';

        default:
            trigger_error("unknown type: $field_type");
            return 's';
    }
}

function infoTable($table)
{
    $query = "SELECT * from $table";
    $tab=array();
    if ($result = $GLOBALS['mysqli']->query($query)) {
        /* Récupère les informations d'un champ pour toutes les colonnes */
        $finfo = $result->fetch_fields();
        foreach ($finfo as $val) {
            $tab[$val->name]=$val;
            $tab[$val->name]->type=map_field_type_to_bind_type($val->type);
        }
    }
    $result->close();
    return $tab;
}

/**
 * retourne les valeurs d'un enum d'une table
 */
function recupEnumToArray($table, $champ)
{
    // recupearation des datas de la colonne.
    $result = $GLOBALS['mysqli']->query("SHOW COLUMNS FROM $table LIKE '$champ'");
    if ($result) {
        $row = $result->fetch_assoc();
        $tab =  explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row['Type']));
        return $tab;
    } else {
        throw new Exception("Pb getEnumValues ".mysqli_error());
    }
}

function listUnique($table, $champ, $sel = null)
{
    $query = "SELECT $champ from $table  ";
    if ($sel) {
        $query .= " where $champ like '%$sel%' ";
    }
    $query .= " group by $champ order by $champ";
    //echo $query;
    $tab=array();
    if ($result = $GLOBALS['mysqli']->query($query)) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++]=strtoupper($row[$champ]);
        }
        $result->close();
    } else {
        throw new Exception("listUnique' [$query]".mysqli_error());
    }
    return $tab;
}

function recupValToArray($table, $champ, $search)
{
    $tabRet=array();
    $index=1;
    $query_EnumList = "SELECT '$champ' from $table where $champ like '%$search%' group by $champ order by $champ ";
    $EnumList = mysql_query($query_EnumList) or die(mysql_error());
    while ($row_EnumList = mysql_fetch_assoc($EnumList)) {
        $tabRet[$index++]=$row_EnumList[$champ];
    }
    return $tabRet;
}

function getOne($id, $table, $cleId)
{
    $row = null;
    if (isset($id)) {
        $requete2 = " SELECT * from $table ";
        $requete2 .= " where $cleId = '" . $id."'";
        if ($res=$GLOBALS['mysqli']->query($requete2)) {
            $row = $res->fetch_assoc();
        } else {
            throw new Exception("getOne' [$requete2]".mysqli_error());
        }
    }
    else {
        throw new Exception("getOne' Pas de connection ");
        
    }
    return $row;
}

function getAll($table, $nameId)
{
    $requete2 = " SELECT * from $table ";
    $resultat = $GLOBALS['mysqli']->query($requete2);
    $tab=array();
    while ($row = $resultat->fetch_assoc()) {
        $tab[$row[$nameId]]=$row;
    }
    $resultat->close();
    return $tab;
}


function update($table, $obj, $cleId)
{
    $descTable=infoTable($table);
    $req = "update $table set ";
    // todo : fr sur les champs sauf cleID
    $virgule="";
    foreach ($obj as $key => $val) {
    }
    foreach ($obj as $key => $val) {
        if ($key != $cleId) {
            if ($descTable[$key]) {
                $guillemet="";
                if ($descTable[$key]->type== "s" || $descTable[$key]->type == "b") {
                    $guillemet="'";
                } elseif (strlen($val) == 0) {
                    $val=0;
                }
                $req .= $virgule.$key." = $guillemet".addslashes($val)."$guillemet";
                $virgule=" , ";
            }
        }
    }
    $req .= " where $cleId = '".$obj[$cleId]."'";
    //echo $req;
    if (!$GLOBALS['mysqli']->query($req)) {
        throw new Exception("Pb d'update' [$req]".mysqli_error());
    }
}

function insert($table, $obj)
{
    $descTable=infoTable($table);
    $req = "insert into $table (";
    $virgule="";
    foreach ($obj as $key => $val) {
        if ($descTable[$key]) {
            $req .= $virgule.$key;
            $virgule=" , ";
        }
    }
    $req.=") values (";
    $virgule="";
    foreach ($obj as $key => $val) {
        if ($descTable[$key]) {
            $guillemet="";
            if ($descTable[$key]->type== "s" || $descTable[$key]->type == "b") {
                $guillemet="'";
            } elseif (strlen($val) == 0) {
                $val=0;
            }
            $req .= $virgule."$guillemet".addslashes($val)."$guillemet";
            $virgule=" , ";
        }
    }
    $req.=")";
    //cho $req;
    
    if (!$GLOBALS['mysqli']->query($req)) {
        throw new Exception("Pb d'insert' [$req]".error_get_last()['message']);
    }
    return $GLOBALS['mysqli']->insert_id;
}

function delete($table, $id, $cleId)
{
    $req = "delete from $table ";
    $req .= " where $cleId = ".$id;
    if (!$GLOBALS['mysqli']->query($req)) {
        throw new Exception("Pb d'update' [$req]".mysqli_error());
    }
    return true;
}
