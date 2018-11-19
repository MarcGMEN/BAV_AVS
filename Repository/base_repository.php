<?
function getOne($id, $table)
{
    $row = null;
    if (isset($id)) {
        $requete2 = " SELECT * from $table ";
        $requete2 .= " where par_id = " . $id;
        // echo $requete2;
        $resultat = mysql_query($requete2);
        $row = mysql_fetch_array($resultat, MYSQL_ASSOC);
    }
    return $row;
}

function getAll($table, $nameId)
{
    $row = null;
    if (isset($id)) {
        $requete2 = " SELECT * from $table ";
        // echo $requete2;
        $resultat = mysql_query($requete2);
        $tab=array();
        while ($row = mysql_fetch_array($resultat, MYSQL_ASSOC)) {
            $tab[$nameId]=$rowSvg;
        }
    }
    return $tag;
}
?>