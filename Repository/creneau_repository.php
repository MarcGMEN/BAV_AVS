<?php
function getAllCreneaux()
{
    extract($GLOBALS);
    $requete2 = "SELECT * from bav_creneau ";
    $requete2 .= " where cre_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " order by cre_debut";
    // echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {

            $oldDebut = dateMysqlInt(str_replace("T", " ", $row['cre_debut']) . ":00");
            $oldFin = dateMysqlInt(str_replace("T", " ", $row['cre_fin']) . ":00");
            $row['delta'] = ($oldFin - $oldDebut) / 60;
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getAll' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

function getNbForCreneauxParFiche($numero)
{
    extract($GLOBALS);

    $classeurSearch = getClasseur($numero);

    $tabClasseur = getNbForCreneauxParClasseur();

    return $tabClasseur[$classeurSearch];

}

function getNbForCreneauxParClasseur()
{
    extract($GLOBALS);
    $requete2 = "SELECT obj_numero, bav_creneau.* from bav_creneau join bav_client on cli_id_cre = cre_id ";
    $requete2 .= " join bav_objet on obj_id_vendeur = cli_id ";
    $requete2 .= " where cre_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " and obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " and obj_numero >= " . $GLOBALS['INFO_APPLI']['base_info'];
    // echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $classeur = getClasseur($row['obj_numero']);

            $oldDebut = dateMysqlInt(str_replace("T", " ", $row['cre_debut']) . ":00");
            $oldFin = dateMysqlInt(str_replace("T", " ", $row['cre_fin']) . ":00");
            if (!isset($tab[$classeur][$row['cre_id']])) {
                $tab[$classeur][$row['cre_id']]['cpt'] = 0;
            }
            $tab[$classeur][$row['cre_id']]['max_tps'] = ($oldFin - $oldDebut) / 60;
            $tab[$classeur][$row['cre_id']]['max_nb'] = ($oldFin - $oldDebut) / 60 / $GLOBALS['INFO_APPLI']['temps_depot'];
            $tab[$classeur][$row['cre_id']]['cpt']++;
            $tab[$classeur][$row['cre_id']]['numero'][] += $row['obj_numero'];
            $tab[$classeur]['numero_deb'] = $GLOBALS['INFO_APPLI']['base_info'] + $GLOBALS['INFO_APPLI']['NB_MODIF'] * ($classeur - 1);
        }
        foreach ($tab as $clas => $cre) {
            // error_log($cre);

            foreach ($cre as $numCre => $tabClass) {
                if (is_array($tabClass)) {
                    $tab[$clas][$numCre]['charge_tps'] = intval($tabClass['cpt']) * $GLOBALS['INFO_APPLI']['temps_depot'];
                }
            }
        }
        $result->close();
    } else {
        throw new Exception("getNbForCreneauxParClasseur' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

function getNbForCreneauxParClasseurReel()
{
    extract($GLOBALS);

    $tabCre = [];
    foreach (getAllCreneaux() as $cre) {
        $tabCre[$cre['cre_id']]['deb'] = dateMysqlInt(str_replace("T", " ", $cre['cre_debut']) . ":00");
        $tabCre[$cre['cre_id']]['fin'] = dateMysqlInt(str_replace("T", " ", $cre['cre_fin']) . ":00");
    }

    $requete2 = "SELECT obj_numero, obj_date_depot ";
    $requete2 .= " from  bav_objet ";
    $requete2 .= " where obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " and obj_numero >= " . $GLOBALS['INFO_APPLI']['base_info'];
    // echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $classeur = getClasseur($row['obj_numero']);
            error_log($row['obj_date_depot']);
            // recherche du creneau
            $dateDepot = dateMysqlInt($row['obj_date_depot']);
            $theIdCre = 0;
            $oldFin=0;
            $oldDebut=0;
            foreach ($tabCre as $idCre => $dates) {
                if ($dateDepot >= $dates['deb'] && $dateDepot <= $dates['fin']) {
                    $theIdCre = $idCre;
                    $oldDebut = $dates['deb'];
                    //dateMysqlInt(str_replace("T", " ", $cre['cre_debut']) . ":00");
                    $oldFin = $dates['fin'];
                    //dateMysqlInt(str_replace("T", " ", $cre['cre_fin']) . ":00");
                    break;
                }
            }
            if ($theIdCre) {
                if (!isset($tab[$classeur][$theIdCre])) {
                    $tab[$classeur][$theIdCre]['cpt'] = 0;
                }
                $tab[$classeur][$theIdCre]['cpt']++;
                $tab[$classeur]['numero_deb'] = $GLOBALS['INFO_APPLI']['base_info'] + $GLOBALS['INFO_APPLI']['NB_MODIF'] * ($classeur - 1);
                $tab[$classeur][$theIdCre]['max_nb'] = ($oldFin - $oldDebut) / 60 / $GLOBALS['INFO_APPLI']['temps_depot'];
            }
        }
        foreach ($tab as $clas => $cre) {
            // error_log($cre);
            // print_r($cre);
            foreach ($cre as $numCre => $tabClass) {
                if (is_array($tabClass)) {
                    $tab[$clas][$numCre]['charge_tps'] = intval($tabClass['cpt']) * $GLOBALS['INFO_APPLI']['temps_depot'];
                }
            }
        }
        $result->close();
    } else {
        throw new Exception("getNbForCreneauxParClasseur' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

function getClasseur($numero) {
    extract($GLOBALS);
    return intval(($numero - $GLOBALS['INFO_APPLI']['base_info']) / $GLOBALS['INFO_APPLI']['NB_MODIF']) + 1;
}

function getInitCreneauxParClasseur()
{
    extract($GLOBALS);

    $requete2 = "SELECT obj_numero ";
    $requete2 .= " from  bav_objet ";
    $requete2 .= " where obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " and obj_numero >= " . $GLOBALS['INFO_APPLI']['base_info'];
    // echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $classeur = getClasseur($row['obj_numero']);
            // recherche du creneau
            if (!isset($tab[$classeur])) {
                foreach (getAllCreneaux() as $cre) {
                    $tab[$classeur][$cre['cre_id']]['cpt'] = 0;
                    $oldDebut = dateMysqlInt(str_replace("T", " ", $cre['cre_debut']) . ":00");
                    $oldFin = dateMysqlInt(str_replace("T", " ", $cre['cre_fin']) . ":00");

                    $tab[$classeur][$cre['cre_id']]['max_nb'] = ($oldFin - $oldDebut) / 60 / $GLOBALS['INFO_APPLI']['temps_depot'];
                    
                }
                
                $tab[$classeur]['numero_deb'] = $GLOBALS['INFO_APPLI']['base_info'] + $GLOBALS['INFO_APPLI']['NB_MODIF'] * ($classeur - 1);
                $tab[$classeur]['cpt']=0;
               
            }
            $tab[$classeur]['cpt']++;
        }

        $result->close();
    } else {
        throw new Exception("getNbForCreneauxParClasseur' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

function getNbForCreneaux()
{
    extract($GLOBALS);

    $requete2 = "SELECT count(*) cpt, cre_id from bav_creneau join bav_client on cli_id_cre = cre_id ";
    $requete2 .= " join bav_objet on obj_id_vendeur = cli_id ";
    $requete2 .= " where cre_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " and obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " and obj_numero >= " . $GLOBALS['INFO_APPLI']['base_info'];
    $requete2 .= " group by cre_id";
    // echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$row['cre_id']]['cpt'] = $row['cpt'];
            $tab[$row['cre_id']]['charge'] = $row['cpt'] * 9 * $GLOBALS['INFO_APPLI']['temps_depot'];
        }
        $result->close();
    } else {
        throw new Exception("getNbForCreneaux' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

function updateCreneau($obj)
{
    if ($obj == "") {
        return "update impossible sans id";
    } else {
        return update('bav_creneau', $obj, "cre_id");
    }
}

function insertCreneau($obj)
{
    $obj['cre_numero_bav'] = $GLOBALS['INFO_APPLI']['numero_bav'];
    return insert("bav_creneau", $obj);
}

function deleteCreneau($id)
{
    return delete("bav_creneau", $id, "cre_id");
}
