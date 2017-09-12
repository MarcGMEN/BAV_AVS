<?php
function makeEntete($titre)
{
    extract($GLOBALS);
    $subject = "$CFG_MAIL_SUJET : $titre";
    $messageMail=file_get_contents("../html/entete_mail.html");
    $messageMail=str_replace("--TITRE--", $titre, $messageMail);
    $messageMail=str_replace("--STYLE_CSS--", $CFG_URL."/style.css", $messageMail);

    return  $messageMail;
}

function makePied($isNewsletter=false)
{
    extract($GLOBALS);
    $messageMail="";
    
    if ($isNewsletter) {
        $module='newsletter';
        $rubModule=return_rubriqueFromModule($module);
        $idrub=$rubModule['rub_id'];
        $unsubscribe=$CFG_URL;
        $unsubscribe.="/";
        $unsubscribe.=makeURL_GET(array("mod" => $module,"rub" => $idrub,"option" => ""), "idnews=". $isNewsletter);
        $messageMail=file_get_contents("../html/pied_newsletter_mail.html");
    
        $messageMail=str_replace("--UNSCRIBE--", $unsubscribe, $messageMail);
    }
    
    $messageMail.=file_get_contents("../html/pied_mail.html");
    $messageMail=str_replace("--NOM_SITE--", $CFG_NOM, $messageMail);
    $messageMail=str_replace("--ADR_SITE--", $CFG_URL, $messageMail);

    return  $messageMail;
}

/**
 * @param $actu
 */
function sendMail($to, $messageMail, $annee)
{
    extract($GLOBALS);
    $erreur="";
    
    /* Pour envoyer un mail au format HTML, vous pouvez configurer le type Content-type. */
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    /* D'autres en-têtes */
    //$headers .= "To: marc.garces@tele2.fr\r\n";
    $headers .= "To: ".$to."\r\n";
    $headers .= "From: avs.vtt@gmail.com\r\n";
    // 	$headers .= "From: romael.website@free.fr\r\n";
    $headers .= "Reply-To: avs.vtt@gmail.com\r\n";
    /* et hop, à la poste */
    try {
        if (!mail($to, "Bourse aux Velos $annee", stripslashes($messageMail), $headers)) {
            $erreur = "Pb sur mail pour : ".$to;
        } else {
            //$erreur="mail envoi ok a [$to]";
        }
        
        return $erreur;
    } catch (Exception $e) {
        return "Exception sur mail ".$to." => ".$e->getMessage();
    }
}
