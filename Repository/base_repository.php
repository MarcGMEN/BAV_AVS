<?

function infoTable($table)
{
    $query = "SELECT * from $table";
    $tab=array();
    if ($result = $GLOBALS['MYSQLI']->query($query)) {

        /* Récupère les informations d'un champ pour toutes les colonnes */
        $finfo = $result->fetch_fields();
        foreach ($finfo as $val) {
            $tab[$val->name]=$val->name;
            // printf("Name:     %s\n", $val->name);
            // printf("Table:    %s\n", $val->table);
            // printf("max. Len: %d\n", $val->max_length);
            // printf("Flags:    %d\n", $val->flags);
            // printf("Type:     %d\n\n", $val->name);
        }
    }
    $result->close();
    return $tab;
}

function getOne($id, $table, $cleId)
{
    $row = null;
    if (isset($id)) {
        $requete2 = " SELECT * from $table ";
        $requete2 .= " where $cleId = '" . $id."'";
        $row=$GLOBALS['MYSQLI']->query($requete2)->fetch_assoc();

    }
    return $row;
}

function getAll($table, $nameId)
{

    $requete2 = " SELECT * from $table ";
    $resultat = $GLOBALS['MYSQLI']->query($requete2);
    $tab=array();
    while ($row = $resultat->fetch_assoc()) {
        $tab[$row[$nameId]]=$row;
    }
    $resultat->close();
    return $tab;
}
?>
