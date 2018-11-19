<?php
require_once "Repository/parametre_repository.php";

/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/

function return_oneParametre($id)
{
    $row = getOneParemetre($id);

    $row['par_client_date_debut_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_client_date_debut'], true));
    $row['par_client_date_fin_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_client_date_fin'], true));

    $row['par_table_date_debut_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_table_date_debut'], true));
    $row['par_table_date_fin_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_table_date_fin'], true));

    return $row;

}

function return_allParametre($id)
{
    $tab = getAllParemetre($id);

    foreach ($tab as $row => $key) {
        $tab[$key]['par_client_date_debut_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_client_date_debut'], true));
        $tab[$key]['par_client_date_fin_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_client_date_fin'], true));

        $tab[$key]['par_table_date_debut_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_table_date_debut'], true));
		$tab[$key]['par_table_date_fin_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_table_date_fin'], true));
    }
    return $tab;

}
?>