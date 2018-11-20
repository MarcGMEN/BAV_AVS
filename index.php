<?php
$time_start = microtime(true);

require_once "Commun/commun_functions.php";
require_once "Commun/connect.php";
require_once "Commun/Sajax.php";

error_reporting(E_ERROR);
if (!isset($_GET['page'])) {
	$_GET['page']="accueil.php";
}

// debut des tabIndex pour les ecrans;
$tabindex=1;

if (!isset($_COOKIE['NUMERO_BAV'])) {
	setcookie('NUMERO_BAV', 2019, time() + (86400 * 30), "/"); // 86400 = 1 day
}

// init ajax
$sajax_request_type = "POST";
$sajax_debug_mode = true;

sajax_init("AJAX/AJAX.php");
// inclusion des exports pour le module membre, incontournable
include "AJAX/exportAJAX.php";

sajax_handle_client_request();
?>
<html>
<head>
<TITLE>BAV 2019</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" lang="fr" content="web 2.0, association">
<meta name="description" lang="fr" content="">
<META NAME="Author" LANG="fr" CONTENT="romael">
<link REL="SHORTCUT ICON" HREF="Images/BAV.png">
<LINK HREF='style.css' REL='stylesheet' TYPE='text/css'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" 
	integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<!--  GOOGLE MAP -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script> -->


<script src="JS/modal.js" type="text/javascript"></script>
<script src="JS/cookies.js" type="text/javascript"></script>
<script src="JS/fenetre.js" type="text/javascript"></script>
<script src="JS/commun.js" type="text/javascript"></script>
<!-- <script src="JS/calendrier.js" type="text/javascript"></script> -->
<!-- <script src="JS/fileIO.js" type="text/javascript"></script> -->
<!--  POUR le gestion des couleurs -->
<script type="text/javascript" src="JS/jscolor.js"></script>

<?php  // inclusion pour SAJAX?>
<!-- <script type="text/javascript" src="JS/sajax/json_stringify.js"></script>
<script type="text/javascript" src="JS/sajax/json_parse.js"></script>
<script type="text/javascript" src="JS/sajax/sajax.js"></script>  -->

<? sajax_show_javascript();?> -->

<script type="text/javascript" >
	startSaisie=false; 
  function initIndex() {
	initModal();
  } 

	function setStartSaisie(cStartSaisie)  {
		startSaisie=cStartSaisie;
		enteteSaisie();
	}

</script> 
	
</head>
<BODY class="parent" LANG="fr-FR" onload="initIndex();initEntete();initPage()" onunload="unloadPage()" >
<center>
<A name="top"></A>
<table width="95%" height="100%" cellspacing="0" cellpadding="0" class="PAGE" border=0 id="ecran" >
	<tr >
			<td class="entete" colspan="6" height="15%" id="entete" >
			  <?include('genericPages/entete.php');  ?>
			</td>
		</tr>
		<tr >
			<td class="FENETRE_PRINCIPALE"  id="page" >
			<!-- Trigger/Open The Modal -->
				<button id="myBtn">Open Modal</button>
				<div id="myModal" class="modal">
					<!-- Modal content -->	
					<div class="modal-content"> -->
  						<span class="close">X&times;</span>
  						<p>Some text in the Modal..</p>
					</div>
				</div>
				<?echo "go to page [".$_GET['page']."]";?>
				<?include('pages/'.$_GET['page']);?>
				
			</td>
		</tr>
		<tr height="2%">
			<td class="pied" colspan="6" height="2%" valign="bottom" >
			  <?include('genericPages/pied.php');?>
			</td>
		</tr>
</table>

</center>
<?if (isset($_GET['message']) && $_GET['message'] != "") {?>
	<script>window.alert("<?=$_GET['message']?>");</script>
<? }?>
	<!-- insertion d'un commentaire -->
</body>
</html>

