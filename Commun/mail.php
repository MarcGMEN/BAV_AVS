<?php
function makeEntete($titre)
{
    extract($GLOBALS);
    $subject = "$CFG_MAIL_SUJET : $titre";
    $messageMail=file_get_contents("../html/entete_mail.html");
    $messageMail=str_replace("--TITRE--", $titre, $messageMail);
    $messageMail=str_replace("--STYLE_CSS--", $CFG_URL."/styleMail.css", $messageMail);

    return  $messageMail;
}

function makeMessage($titre, $data, $fileHTML)
{
    extract($GLOBALS);
    $messageMail="";

    $messageMail.=makeEntete($titre);
    $messageMail.=makeCorps($data, $fileHTML);
    $messageMail.=makePied($titre);
    
    return  $messageMail;
}

function makeCorps($data, $fileHTML)
{
    extract($GLOBALS);
    $messageMail="";

    $messageMail.=file_get_contents("../html/$fileHTML");
    foreach ($data as $key => $val) {
        //echo "publipost de $key avec $val\n";
        $messageMail=str_replace("--$key--", $val, $messageMail);
    }
    
    return  $messageMail;
}

function makePied()
{
    extract($GLOBALS);
    $messageMail="";
    
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
            file_put_contents("../mail.html", stripslashes($messageMail));
            $erreur = "Pb sur mail pour : ".$to;
        } else {
            $erreur="mail envoi ok a [$to]";
        }
        echo $erreur;
        return $erreur;
    } catch (Exception $e) {
        return "Exception sur mail ".$to." => ".$e->getMessage();
    }
}
