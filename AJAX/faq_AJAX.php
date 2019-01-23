<?php

/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/

function return_oneFaq($id)
{
    $row = getOneFaq($id);
    return $row;
}


function action_createFaq($data)
{
   
}

function action_deleteFaq($id)
{
    deleteFaq($id);
}

function action_updateFaq($data)
{
    $faq =tabToObject(string2Tab($data), "faq");
        
    try {
        updateFaq($faq);
        return $faq;
    } catch (Exception $e) {
        return "ERREUR ".$e->getMessage();
    }
}

function action_insertFaq($obj)
{
    $tab =string2Tab($obj);
    insertFaq($tab);
    return true;
}


function return_faqs($selection, $approved = 1)
{
    return getFaqs($selection, $approved);
}
