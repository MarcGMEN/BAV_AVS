<?php
$module = "mailing";

/*************************************/
/*************************************/
/* MAILING */
/*************************************/
function return_countMailing()
{
    return get_countMail();
}
function return_countMailingAEnvoyer()
{
    return get_countMailAEnvoyer();
}
function return_countMailingEnvoye()
{
    return get_countMailEnvoye();
}
function return_countMailingErreur()
{
    return get_countMailEnErreur();
}

function actionMailing($message, $nb)
{
    $index=1;
    $tab =return_mailingAEnvoyer($nb);
    foreach ($tab as $mel) {
        $ret = envoiMailing($message, $mel);
        if (++$index > $nb || $ret != "") {
            return "$ret";
        }
    }
}
function envoiMailing($message, $melTest)
{
    $ret = sendMail($melTest, $message, $_COOKIE["NUMERO_BAV"]);
    if ($ret == "") {
        valideEnvoi($melTest);
        return "";
    } else {
        badEnvoi($melTest, $ret);
        return $ret;
    }
}
function initMailing()
{
    if ($retMes = initEnvoi() != 0) {
        return "Erreur sur $retMes";
    } else {
        return "";
    }
}
function loadTexteMailing()
{
    return utf8_encode(file_get_contents("../html/texteBAV.html"));
}
