<?php

function makeEntete($titre)
{
    extract($GLOBALS);
    $subject = "$CFG_MAIL_SUJET : $titre";
    $messageMail=file_get_contents(dirname(__FILE__)."/../html/entete_mail.html");
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


function makePied()
{
    extract($GLOBALS);
    $messageMail="";
    
    
    $messageMail.=file_get_contents(dirname(__FILE__)."/../html/pied_mail.html");
    $messageMail=str_replace("--NOM_SITE--", $CFG_NOM, $messageMail);
    $messageMail=str_replace("--ADR_SITE--", $CFG_URL, $messageMail);
    $messageMail=str_replace("--URL--", $CFG_URL, $messageMail);

    return  $messageMail;
}

function sendMailTEST($titre, $toMail, $message, $pieceJointe = null)
{
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "Content-Transfer-Encoding:8bit \r\n";
    $headers .= "From: avs.vtt@gmail.com\r\n";
    $headers .= "Reply-To: avs.vtt@gmail.com\r\n";
    return mail($toMail, $titre, stripslashes($message), $headers);
}
/**
 * @param $actu
 */
function sendMail($titre, $toMail, $messageMail, $pieceJointe = null, $bcc=false)
{
    //extract($GLOBALS);
    $erreur="";
    $boundary = md5(uniqid(time()));
    /* Pour envoyer un mail au format HTML, vous pouvez configurer le type Content-type. */
    $headers  = "MIME-Version: 1.0\r\n";
    if ($pieceJointe != null) {
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
    } else {
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
    }
    $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
    //$headers .= "X-Priority: 1 \n";
    /* D'autres en-têtes */
    $headers .= "From: <bourse1000velos@avs44.com>\r\n";
    $headers .= "Reply-To: <bourse1000velos@avs44.com>\r\n";
    if ($bcc) {
        $headers .= "Bcc: <bourse1000velos@avs44.com>\r\n";
    }
    /* et hop, à la poste */
    try {
        $message="";
        if ($pieceJointe != null) {
            $message  = "--$boundary \n";
            $message .= "Content-type: text/html; charset=utf-8\r\n";
            //$message .= "Content-Transfer-Encoding:8bit \n";
        }
        $message.=$messageMail;
        if ($pieceJointe != null) {
            $file_name =basename($pieceJointe);
            $typepiecejointe = filetype($_SERVER['DOCUMENT_ROOT'].$pieceJointe);
            $data = chunk_split(base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'].$pieceJointe)));
            $message .= "\r\n--$boundary\r\n";
            $message .= "Content-Type: $typepiecejointe; name=\"$file_name\" \r\n";
            $message .= "Content-Transfer-Encoding: base64 \n";
            $message .= "Content-Disposition: attachment; filename=\"$file_name\" \r\n";
            $message .= "\r\n";
            $message .= $data."\r\n";
            $message .= "\r\n";
            $message .= "--".$boundary."--\r\n";
        }
        //error_clear_last();
        if (!mail($toMail, $titre, stripslashes($message), $headers)) {
            file_put_contents(dirname(__FILE__)."/../mail.html", stripslashes($messageMail));
            error_log("Pb sur mail pour : ".$toMail);
        } else {
            //$erreur="Mail envoi ok a [$toMail]";
            error_log("Mail envoi ok a [$toMail]");
            $erreur=1;
        }
        return $erreur;
    } catch (Exception $e) {
        return "Exception sur mail ".$toMail." => ".$e->getMessage();
    }
}
