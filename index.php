<?php
$time_start = microtime(true);

require_once "Commun/commun_functions.php";
require_once "Commun/connect.php";
require_once "Commun/Sajax.php";

error_reporting(E_ERROR);
if (!isset($GET_page)) {
	$GET_page="accueil.php";
}

// debut des tabIndex pour les ecrans;
$tabindex=1;

if (!isset($_COOKIE['NUMERO_BAV'])) {
	setcookie('NUMERO_BAV', date('Y'), time() + (86400 * 30), "/"); // 86400 = 1 day
	$_COOKIE['NUMERO_BAV']=date('Y');
}

// init ajax
$sajax_request_type = "POST";
$sajax_debug_mode = false;

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
			integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
	 		crossorigin="anonymous">
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

	<? sajax_show_javascript();?>

	<script type="text/javascript">
		startSaisie = false;

		function initIndex() {
		}

		function setStartSaisie(cStartSaisie) {
			startSaisie = cStartSaisie;
			enteteSaisie();
			pageSaisie();
		}

		var modePage='<?=$GET_modePage?>';
		// recuperation des donnees de la BAV
		function setParamValIndex(val) {
			getElement("mode").innerHTML=modePage+"-"+CLIENT+"-"+TABLE+"-"+ADMIN+ "; id=<?=$GET_id?>";
		}

		function setParamVal(val) {
            setParamValIndex(val);
		}

		function display_retour_test(val) {
            console.log(val);
		}
		function confirmModalTest() {
            setTimeout(function() {closeModal();},1000);
		}
	</script>

</head>

<BODY class="parent" LANG="fr-FR" onload="initIndex();initEntete();initPage()" onunload="unloadPage()">
	<center>
		<A name="top"></A>
		<table width="95%" height="100%" cellspacing="0" cellpadding="0" class="PAGE" border=0 id="ecran">
			<tr>
				<td class="entete" height="15%" id="entete">
					<?include('genericPages/entete.php');  ?>
				</td>
			</tr>
			<tr>
				<td class="FENETRE_PRINCIPALE" id="page">
					MODE: <span id="mode"></span> 
					<?echo "go to page [".$GET_page."]";?>
					<?include('pages/'.$GET_page);?>
					<!-- Trigger/Open The Modal -->
					<div id="myModal" class="modal">
						<!-- Modal content -->
						<div class="modal-content" id="id-modal-content"> 
							<form name="modalForm" method="POST" onsubmit="return submitFormModal()" action="">
								<table width=100% class="BH_MODAL" id="id_bh_modal">
									<tr>
										<td width="95%" id='modalTitre'></td>
										<td width="5%" id="modalClose"></td>
									</tr>
								</table>
								<br/><br/>
								<div id="modalText"></div>
								<br/><br/>
								<div id="modalAction"></div>
							</form>
						</div>
					</div>
				</td>
			</tr>
			<tr height="2%">
				<td class="pied" colspan="6" height="2%" valign="bottom">
					<?include('genericPages/pied.php');?>
				</td>
			</tr>
		</table>

	</center>	
</body>
<?
if (isset($GET_message) && trim($GET_message) != '') {
	?>

	<script> 
        console.log("message");
		alertModalInfo('<?=$GET_message?>');
	</script>
<?}?>

</html>