<?php

/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/

function return_oneActu($id)
{
    $row = getOneActu($id);
    return $row;
}


function action_createActu($data)
{
}

function action_deleteActu($id)
{
    deleteActu($id);
}

function action_updateActu($dataLc)
{
    $act =tabToObject(string2Tab($dataLc), "act");
        
    try {
        updateActu($act);
        return $act;
    } catch (Exception $e) {
        return "ERREUR ".$e->getMessage();
    }
}

function action_insertActu($obj, $type = "FAQ")
{
    $tab =string2Tab($obj);
    $tab['act_type']=$type;
    insertActu($tab);
    return true;
}

function action_insertActuPRESSE($obj)
{
    return action_insertActu($obj, "PRESSE");
}


function return_actus($selection, $approved = 1, $type = 'FAQ')
{
    return getActus($selection, $approved, $type);
}
