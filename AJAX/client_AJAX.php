<?php

/**************************************/
/**************************************/
/* CLIENT */
/**************************************/
/**************************************/
function return_list_emel()
{
    return get_emel();
}

function return_oneClientByMel($id)
{
    $row = getOneClientByMel($id);
    if ($row) {
        //$row['obj_date'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date'], true));
    }
    return $row;
}



function return_oneClient($id)
{
    $row = getOneClient($id);
    if ($row) {
        //$row['obj_date'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date'], true));
    }
    return $row;
}

function action_updateClient($obj)
{
    $tab =string2Tab($obj);
    // // TODO : test cohérence object
    updateClient($tab);

    return true;
}

function action_insertClient($obj)
{
    $tab =string2Tab($obj);
    insertClient($tab);
    return true;
}

?>