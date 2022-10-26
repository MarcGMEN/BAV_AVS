<?php
function getAllCounterAction()
{
    return getAll('bav_counter_access', 'cas_numero_bav');
}

function getOneCounterAction($id)
{
    return getOne($id, 'bav_counter_access', 'cas_id');
}

function countByPage($numBav)
{
    $requete2 = "SELECT count(*) cpt, cas_page from bav_counter_access where cas_numero_bav = '$numBav'";
    $requete2 .= " group by cas_page ";

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$row['cas_page']] = $row['cpt'];
        }
        $result->close();
    } else {
        throw new Exception("getClients' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

function getByTree($numBav)
{
    $requete2 = "SELECT * from bav_counter_access where cas_numero_bav = '$numBav' order by cas_date";

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            if ($row['cas_os']== "Android" || $row['cas_os']== "iPhone") {
                $row['cas_os']="tel";
            }
            else {
                $row['cas_os']="ordi";
            }
            if ($row['cas_mode_page'] != "") {
                if ($row['cas_type'] != "") {
                    $tab[$row['cas_page']][$row['cas_mode_page']][$row['cas_type']]['OS_'.$row['cas_os']][$row['cas_date']]++;
                } else {
                    $tab[$row['cas_page']][$row['cas_mode_page']]['OS_'.$row['cas_os']][$row['cas_date']]++;
                }
            } else {
                $tab[$row['cas_page']]['OS_'.$row['cas_os']][$row['cas_date']]++;
            }
            // $tab[$row['cas_page']] = array(
            //         'cpt' => $tab[$row['cas_page']]['cpt'] + 1,
            //         $row['cas_modepage'] => array(
            //             'cpt' => $tab[$row['cas_page']][$row['cas_modepage']]['cpt'] + 1,
            //             $row['cas_type'] => array(
            //                 'cpt' => $tab[$row['cas_page']][$row['cas_modepage']][$row['cas_type']]['cpt'] + 1,
            //                 $row['cas_os'] => array(
            //                     'cpt' => $tab[$row['cas_page']][$row['cas_modepage']][$row['cas_type']][$row['cas_os']]['cpt'] + 1,

            //                     $row['cas_navigateur'] => array(
            //                         'cpt' => $tab[$row['cas_page']][$row['cas_modepage']][$row['cas_type']][$row['cas_os']][$row['cas_navigateur']]['cpt'] + 1,

            //                         $row['cas_date'] => array(
            //                             'cpt' => $tab[$row['cas_page']][$row['cas_modepage']][$row['cas_type']][$row['cas_os']][$row['cas_navigateur']][$row['cas_date']]['cpt'] + 1
            //                         )
            //                     )
            //                 )
            //             )
            //         )
            // );
        }
        $result->close();
    } else {
        throw new Exception("getClients' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}
function getByDay($numBav)
{
    $requete2 = "SELECT * from bav_counter_access where cas_numero_bav = '$numBav' order by cas_date";

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {

            if ($row['cas_mode_page'] != "") {
                if ($row['cas_type'] != "") {
                    $tab[$row['cas_page']][$row['cas_mode_page']][$row['cas_type']][$row['cas_os']][$row['cas_navigateur']][$row['cas_date']]++;
                } else {
                    $tab[$row['cas_page']][$row['cas_mode_page']][$row['cas_os']][$row['cas_navigateur']][$row['cas_date']]++;
                }
            } else {
                $tab[$row['cas_page']][$row['cas_os']][$row['cas_navigateur']][$row['cas_date']]++;
            }
        }
        $result->close();
    } else {
        throw new Exception("getClients' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}



function updateCounterAction($obj)
{
    return update('bav_counter_access', $obj, "cas_id");
}

function insertCounterAction($obj)
{
    return insert('bav_counter_access', $obj);
}

function deleteCounterAction($obj)
{
    return delete('bav_counter_access', $obj, "cas_id");
}
