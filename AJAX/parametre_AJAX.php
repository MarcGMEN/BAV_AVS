<?php

/**************************************/
/**************************************/
/* PARAMETRE */
/**************************************/
/**************************************/

function return_oneParametre($id)
{
    try {
        return getOneParemetre($id);
    } catch (Exception $e) {
        echo "oups, pb: $e";
    }
}

function return_allParametre()
{
    if (!function_exists('getAllParametre')) {
        echo "on trouve pas getAllParametre";
    }
    $tab = getAllParametre();
    foreach ($tab as $key => $row) {
        $tab[$key]['par_client_date_debut_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_client_date_debut'], true));
        $tab[$key]['par_client_date_fin_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_client_date_fin'], true));

        $tab[$key]['par_client_date_debut_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_client_date_debut'], false));
        $tab[$key]['par_client_date_fin_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_client_date_fin'], false));

        $tab[$key]['par_date_debut_depot_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_date_debut_depot'], true));
        $tab[$key]['par_date_debut_vente_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_date_debut_vente'], true));
        $tab[$key]['par_date_fin_bav_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_date_fin_bav'], true));
    }   
    return $tab;
}

function action_updateParametre($obj)
{
    updateParametre(string2Tab($obj, true));
    return true;
}

function action_supprimeParametre($obj)
{
    $par = getOneParemetre($obj);
    if ($par['par_actif']== 1) {
        return "Suppression impossible d'une BAV active";
    }
    else if (sizeof(getAllParametre()) == 1) {
        return "Suppression impossible, il doir en rester une.";
    }
    try {
        deleteParametre($obj);
        return true;
    } catch (Exception $e) {
        return "[action_supprimeParametre] : $e";
    }
}


function action_insertParametre($obj)
{
    $tab = string2Tab($obj);
    if (!return_oneParametre($tab['par_numero_bav'])) {
        // recherche si deja présent
        // // TODO : test cohérence object
        insertParametre($tab);
        return true;
    } else {
        return "Numéro déjà présent..";
    }
}

function return_tauxBAV()
{
    $param = return_oneParametre($GLOBALS['INFO_APPLI']['numero_bav']);

    $tabTaux[1] = $param["par_taux_1"];
    $tabTaux[2] = $param["par_taux_2"];
    $tabTaux[3] = $param["par_taux_3"];

    return $tabTaux;
}

function return_depotsBAV()
{
    $param = return_oneParametre($GLOBALS['INFO_APPLI']['numero_bav']);

    $tabDepot[1] = $param["par_prix_depot_1"];
    $tabDepot[2] = $param["par_prix_depot_2"];
    $tabDepot[3] = $param["par_prix_depot_3"];

    return $tabDepot;
}
