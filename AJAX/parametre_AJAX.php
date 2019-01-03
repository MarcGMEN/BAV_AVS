<?php

/**************************************/
/**************************************/
/* PARAMETRE */
/**************************************/
/**************************************/

/**
 * return des infos de la BAV
 * titre : titre de la BAV
 * TABLE, ADMIN pour les droits
 * message : message d'information
 */
function return_infoAppli()
{
    $infos=array();
    
    $ipLu= $_SERVER['REMOTE_ADDR'];
    $numBAV=$_COOKIE['NUMERO_BAV'];
    $par = return_oneParametre($numBAV);

    $tabIpsAdmin=explode(",", $par['par_admin_id_mac']);
    $today=time();
    $infos['CLIENT']=0;
    $infos['TABLE']=0;
    $infos['ADMIN']=0;
    $infos['NB_MODIF']=$par['par_nb_modif'];
    //  print_r(strtotime($par['par_table_date_debut'])." < $today < ".strtotime($par['par_table_date_fin']));
    if (strtotime($par['par_client_date_debut']) < $today && $today < strtotime($par['par_client_date_fin'])) {
        $infos['CLIENT']=1;
    }
    if (strtotime($par['par_table_date_debut']) < $today && $today < strtotime($par['par_table_date_fin'])) {
        $tabIps=explode(",", $par['par_table_id_mac']);
        foreach ($tabIps as $ipOk) {
            //        print_r(trim($ipOk)." == ".trim($ipLu));
            if (trim($ipOk) == trim($ipLu)) {
                $infos['TABLE']=1;
                break;
            }
        }
        $infos['message']="Cloture le ".$par['par_table_date_fin_FR'];
    } else {
        $infos['message']="Session pas encore ouverte";
    }

    foreach ($tabIpsAdmin as $ipOk) {
        if (trim($ipOk) == trim($ipLu)) {
            //print_r(trim($ipOk)." == ".trim($ipLu));
            $infos['ADMIN']=1;
            break;
        }
    }
    $infos['titre']=$par['par_titre'];

    return $infos;
}


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

function action_updateParametre($obj)
{
    $tab =string2Tab($obj);
    // // TODO : test cohérence object
    updateParametre($tab);

    return true;
}

function action_insertParametre($obj)
{
    $tab =string2Tab($obj);
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
    $param = return_oneParametre($_COOKIE['NUMERO_BAV']);

    $tabTaux[1]=$param["par_taux_1"];
    $tabTaux[2]=$param["par_taux_2"];
    $tabTaux[3]=$param["par_taux_3"];
    
    return $tabTaux;
}

function return_depotsBAV()
{
    $param = return_oneParametre($_COOKIE['NUMERO_BAV']);

    $tabDepot[1]=$param["par_prix_depot_1"];
    $tabDepot[2]=$param["par_prix_depot_2"];
    $tabDepot[3]=$param["par_prix_depot_3"];
    
    return $tabDepot;
}
