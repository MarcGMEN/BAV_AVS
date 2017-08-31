<?
require "../Functions/commun_functions.php";
require "../Commun/connect.php";
require "../Commun/mail.php";
require "../Functions/mailing_functions.php";

//print_r($_POST);
error_reporting(E_ALL);

$page_src = "location:../index.php?page=mailing.php&message=".$_POST['lAction'];
$date = date("Y-m-d H:i:s");
$message="";


/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "mailing") {
	foreach ( return_mailingAEnvoyer () as $mel ) {
		envoiMailing($_POST['texteMail'], $mel);
		sleep(2);
	}
	$page_src = "location:../index.php?page=mailing.php&message=Envoi terminé";
}

if (isset($_POST['lAction']) && $_POST['lAction'] == "testEMel") {
	$res = envoiMailing($_POST['texteMail'], $_POST['testEMel']);
	if ($res != "") {
		$page_src ="location:../index.php?page=mailing.php&message=$res";
	}
	else {
		$page_src ="location:../index.php?page=mailing.php&message=Test Ok sur ".$_POST['testEMel'];
	}
}


mysql_close($id_db);

header($page_src);