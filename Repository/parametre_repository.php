<?php
function getAllParametre()
{
    return getAll('bav_parametre', 'par_numero_bav');
}

function getOneParemetre($id)
{
    return getOne($id, 'bav_parametre', 'par_numero_bav');
}

/**
 * return des infos de la BAV
 * titre : titre de la BAV
 * ,ADMIN pour les droits
 * message : message d'information
 */
function return_infoAppli()
{
    $infos = array();

    $ipLu = $_SERVER['REMOTE_ADDR'];

    $par = return_parametreActif();

    $tabIpsAdmin = explode(",", $par['par_admin_id_mac']);
    $today = time();
    $infos['CLIENT'] = 0;
    $infos['ADMIN'] = $_COOKIE['AADD'] == $GLOBALS['PASS_ADMIN'] ? 1 : 0;
    $infos['NB_MODIF'] = $par['par_nb_modif'];
    //  print_r(strtotime($par['par_table_date_debut'])." < $today < ".strtotime($par['par_table_date_fin']));
    if (strtotime($par['par_client_date_debut']) < $today && $today < strtotime($par['par_client_date_fin'])) {
        $infos['CLIENT'] = 1;
    } else {
        $infos['message'] = "Session pas encore ouverte";
    }

    foreach ($tabIpsAdmin as $ipOk) {
        if (trim($ipOk) == trim($ipLu)) {
            //print_r(trim($ipOk)." == ".trim($ipLu));
            $infos['ADMIN'] = 1;
            break;
        }
    }
    $infos['numero_bav'] = $par['par_numero_BAV'];
    $infos['titre'] = $par['par_titre'];

    $infos['par_date_debut_depot_FR'] = utf8Encode(formateDateMYSQLtoFR($par['par_date_debut_depot'], true));
    $infos['par_date_debut_vente_FR'] = utf8Encode(formateDateMYSQLtoFR($par['par_date_debut_vente'], true));
    $infos['par_date_fin_bav_FR'] = utf8Encode(formateDateMYSQLtoFR($par['par_date_fin_bav'], true));
    
    $infos['date_j1'] = strtotime($par['par_date_debut_depot']);
    $infos['date_j2'] = strtotime($par['par_date_debut_vente']);
    $infos['date_j3'] = strtotime($par['par_date_fin_bav']);

    return $infos;
}

function return_parametreActif()
{
    try {
        $row = getParemetreActif();
        if ($row) {
            $row['par_client_date_debut_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_client_date_debut'], false));
            $row['par_client_date_fin_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_client_date_fin'], false));

            $row['par_table_date_debut_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_table_date_debut'], false));
            $row['par_table_date_fin_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_table_date_fin'], false));

            $row['par_date_debut_depot_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_date_debut_depot'], true));
            $row['par_date_debut_vente_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_date_debut_vente'], true));
            $row['par_date_fin_bav_FR'] = utf8Encode(formateDateMYSQLtoFR($row['par_date_fin_bav'], true));
        }
        return $row;
    } catch (Exception $e) {
        echo "oups, pb: $e";
    }
}

function getParemetreActif()
{
    $row = null;
    $requete2 = " SELECT * from bav_parametre ";
    $requete2 .= " where par_actif = 1 ";
    if ($res = $GLOBALS['mysqli']->query($requete2)) {
        $row = $res->fetch_assoc();
        // si pas actif, on recherche la derniere
        if (!$row) {
            $requete2 = " SELECT * from bav_parametre where par_date_debut_depot < CURDATE() order by par_date_debut_depot  desc ";
            if ($res = $GLOBALS['mysqli']->query($requete2)) {
                $row = $res->fetch_assoc();
                if (!$row) {
                    $requete2 = " SELECT * from bav_parametre where par_date_debut_depot => CURDATE() order by par_date_debut_depot asc ";
                    if ($res = $GLOBALS['mysqli']->query($requete2)) {
                        $row = $res->fetch_assoc();
                    } else {
                        throw new Exception("getParemetreActif' [$requete2]" . $GLOBALS['mysqli']->error);
                    }
                }
            } else {
                throw new Exception("getParemetreActif' [$requete2]" . $GLOBALS['mysqli']->error);
            }
        }
    } else {
        throw new Exception("getParemetreActif' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $row;
}

function updateParametre($obj)
{
    return update('bav_parametre', $obj, "par_numero_bav");
}

function insertParametre($obj)
{
    return insert('bav_parametre', $obj);
}

function deleteParametre($obj)
{
    return delete('bav_parametre', $obj, "par_numero_bav");
}
