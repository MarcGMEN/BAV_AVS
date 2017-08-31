<?
require "../Functions/commun_functions.php";
require "../Commun/connect.php";
require "../Commun/mail.php";

$page_src = "location:../index.php?1=1";
$date = date("Y-m-d H:i:s");
$message="";
//print_r($_POST);
error_reporting(E_ALL);
/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "ficheCreation") {
  $page_src .= "&page=fiche.php&numeroFiche=".$_POST['numeroFiche']."&action=new";
}

/*****************************************************/	
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "ficheVisu") {
  $page_src .= "&page=fiche.php&numeroFiche=".$_POST['numeroFiche']."&action=visu";
}

if (isset($_POST['lAction']) && $_POST['lAction'] == "clients") {
  $page_src .= "&page=clients.php";
}

if (isset($_POST['lAction']) && $_POST['lAction'] == "stock") {
  $page_src .= "&page=stock.php";
}

if (isset($_POST['lAction']) && $_POST['lAction'] == "mailing") {
	$page_src .= "&page=mailing.php";
}


mysql_close($id_db);

header($page_src);