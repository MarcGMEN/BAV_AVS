<?php
function getAllCounterAction()
{
    return getAll('bav_counter_access', 'cas_numero_bav');
}

function getOneCounterAction($id)
{
    return getOne($id, 'bav_counter_access', 'cas_id');
}

function getByAction($numBav)
{
    $requete2 = "SELECT count(*) cpt, cas_action from bav_counter_access where cas_numero_bav = '$numBav'";
    $requete2 .= " group by cas_action ";

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$row['cas_action']] = $row['cpt'];
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
