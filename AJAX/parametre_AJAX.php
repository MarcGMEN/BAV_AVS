<?php

/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/

function return_oneParametre($id)
{
    $row = getOneParemetre($id);
    if ($row) {
        $row['par_client_date_debut_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_client_date_debut'], true));
        $row['par_client_date_fin_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_client_date_fin'], true));

        $row['par_table_date_debut_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_table_date_debut'], true));
        $row['par_table_date_fin_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_table_date_fin'], true));

    }
    return $row;
}

function return_allParametre()
{
    if (!function_exists('getAllParametre')) {
        echo "on trouve pas getAllParametre";
    }
    $tab = getAllParametre();
    foreach ($tab as $key => $row) {
        $tab[$key]['par_client_date_debut_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_client_date_debut'], true));
        $tab[$key]['par_client_date_fin_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_client_date_fin'], true));

        $tab[$key]['par_table_date_debut_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_table_date_debut'], true));
        $tab[$key]['par_table_date_fin_FR'] = utf8_encode(formateDateMYSQLtoFR($row['par_table_date_fin'], true));
    }
    return $tab;
}

function updateParametre($obj)
{
    // TODO : test cohérence object
    updateParametre($obj);
}
