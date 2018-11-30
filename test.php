<pre>
<?php 
require_once "Commun/mail.php";

$mail_to = "marc.garces@free.fr"; //Destinataire
$from_mail = "marc.garces@free.fr"; //Expediteur
$from_name = "Nom"; //Votre nom, ou nom du site
$reply_to = "marc.garces@free.fr"; //Adresse de réponse
$subject = "Objet du mail";
$file_name = "Fiche_700.pdf";

//echo $_SERVER['DOCUMENT_ROOT'];
$path = $_SERVER['DOCUMENT_ROOT']."/BAV/out/PDF/";
//echo $path.$file_name;
$typepiecejointe = filetype($path.$file_name);
print_r($path.$file_name." -> ".$typepiecejointe);
$data = chunk_split(base64_encode(file_get_contents($path.$file_name)));
//Génération du séparateur
$boundary = md5(uniqid(time()));
$entete = "From: $from_mail \n";
$entete .= "Reply-to: $from_mail \n";
$entete .= "MIME-Version: 1.0 \n";
$entete .= "Content-Type: multipart/mixed; boundary=\"$boundary\" \n";
$entete .= " \n";
$message  = "--$boundary \n";
$message .= "Content-Type: text/html; charset=\"iso-8859-1\" \n";
$message .= "Content-Transfer-Encoding:8bit \n";
$message .= "\n";
$message .= "Bonjour,<br />Veuillez trouver ci-joint le bon de commande<br/>Cordialement";
$message .= "\n";
$message .= "--$boundary \n";
$message .= "Content-Type: $typepiecejointe; name=\"$file_name\" \n";
$message .= "Content-Transfer-Encoding: base64 \n";
$message .= "Content-Disposition: attachment; filename=\"$file_name\" \n";
$message .= "\n";
$message .= $data."\n";
$message .= "\n";
$message .= "--".$boundary."--";
/*print_r($entete);
$success= mail($mail_to, $subject, $message, $entete);
if (!$success) {
    print_r(error_get_last());
}
*/
$message = makeMessage("test", null, "mel_enregistrement.html");
echo "<hr/>";
print_r(sendMail("test sendmail", "marc.garces@free.fr", $message));
?>
</pre>
