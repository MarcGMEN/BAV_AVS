<?
function getOne($id, $table, $cleId)
{
    $row = null;
    if (isset($id)) {
        $requete2 = " SELECT * from $table ";
        $requete2 .= " where $cleId = '" . $id."'";
        return $GLOBALS['MYSQLI']->query($requete2)->fetch_assoc();
    }
    return null;
}

function getAll($table, $nameId)
{

    $requete2 = " SELECT * from $table ";
    $resultat = $GLOBALS['MYSQLI']->query($requete2);
    $tab=array();
    while ($row = $resultat->fetch_assoc()) {
        $tab[$row[$nameId]]=$row;
    }
    return $tab;
}
?>
