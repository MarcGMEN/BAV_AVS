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
    $faq = tabToObject(string2Tab($data), "faq");

    try {
        updateFaq($faq);
        return $faq;
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}

function action_insertFaq($obj)
{
    $tab = string2Tab($obj);
    insertFaq($tab);

    sendMail("BAV FAQ", "bourse1000velos@avs44.com", "<html><body>Ajout d'un nouveau message dans la FAQ.<br/>" . addslashes(rtrim($tab['act_text'])) . "<body></html>");

    return true;
}


function return_faqs($selection, $approved = 1)
{
    return getFaqs($selection, $approved);
}
