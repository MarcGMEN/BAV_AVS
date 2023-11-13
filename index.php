<?php
require_once "Commun/connect.php";
require_once "Commun/commun_functions.php";
require_once "Repository/base_repository.php";
require_once "Repository/parametre_repository.php";
require_once "Repository/actu_repository.php";
require_once "Repository/counter_access_repository.php";
require_once "AJAX/parametre_AJAX.php";
require_once "Commun/Sajax.php";
require_once "config.ini";

$time_start = microtime(true);

error_reporting(E_ERROR);
if (!isset($GET_page)) {
	$GET_page = "bav.php";
}

/*if ($GET_page != "stat.php") {
	$_COOKIE['par_numero_bav_stat']="";
	setcookie('par_numero_bav_stat', null) ;
}*/


// debut des tabIndex pour les ecrans;
$tabindex = 1;

$infAppli = return_infoAppli();

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
	<TITLE>Bourse aux 1000 vélos</TITLE>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" lang="fr" content="web 2.0, association">
	<meta name="description" lang="fr" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<META NAME="Author" LANG="fr" CONTENT="romael">
	<link REL="SHORTCUT ICON" HREF="Images/BAV_2020.png">

	<LINK HREF='style.css' REL='stylesheet' TYPE='text/css'>


	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

	<link rel="stylesheet" href="editor.css" />
	<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />


	<!--  GOOGLE MAP -->
	<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
	<script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'></script>
	<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
	<script src="JS/geoPosition.js"></script>
	<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
	

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="JS/modal.js" type="text/javascript"></script>
	<script src="JS/cookies.js" type="text/javascript"></script>
	<script src="JS/fenetre.js" type="text/javascript"></script>
	<script src="JS/commun.js" type="text/javascript"></script>
	<script src="JS/index.js" type="text/javascript"></script>

	<script src="ckeditor/ckeditor.js"></script>
	<!-- <script src="JS/calendrier.js" type="text/javascript"></script> -->
	<!-- <script src="JS/fileIO.js" type="text/javascript"></script> -->
	<!--  POUR le gestion des couleurs -->
	<!-- <script type="text/javascript" src="JS/jscolor.js"></script> -->

	<?php  // inclusion pour SAJAX
	?>
	<!-- <script type="text/javascript" src="JS/sajax/json_stringify.js"></script>
	<script type="text/javascript" src="JS/sajax/json_parse.js"></script>
	<script type="text/javascript" src="JS/sajax/sajax.js"></script>  -->
	<!-- MODE DEV -->
	<? //sajax_show_javascript(); ?> 
	<!-- MODE PROD -->
	<? sajax_show_javascript("JS/sajax.js");?> 

	<script type="text/javascript">
		var startSaisie = false;
		var ADMIN = <?= $infAppli['ADMIN'] ? 1 : 0 ?>;
		var CLIENT = <?= $infAppli['CLIENT'] ? 1 : 0 ?>;
		var BAV_ENCOURS = <?= $infAppli['bav_en_cours'] ? 1 : 0 ?>;
		

		// date d'ouverture du depot
		var DATE_J1 = <?= $infAppli['date_j1'] ?>;
		var DATE_J2 = <?= $infAppli['date_j2'] ?>;

		var NB_MODIF = <?= $infAppli['NB_MODIF'] ?>;
		var modePage = '<?= $GET_modePage ?>';
		var id = '<?= $GET_id ?>';
		var type = '<?= $GET_type ?>';

		function initIndex() {
			if (id != "" && (modePage == 'restF' || modePage == 'restC' || modePage == 'restV')) {
				searchSuiteRest(id, modePage, type);
				var stateObj = {
					foo: "bar"
				};
				history.pushState(stateObj, "", "index.php");
			} else if (<?= $infAppli['ADMIN'] ? 1 : 0 ?> == 0) {
				x_add_counter_action("<?= $GET_page ?>", modePage, type, display_rien);
			}
		}
	</script>

</head>

<body class="parent" LANG="fr-FR" onload="initIndex();initEntete();initPage()" onunload="unloadPage()">
	<form name="formNavigation" method="get">
		<input type="hidden" name="page" value="">
		<input type="hidden" name="modePage" value="">
		<input type="hidden" name="id" value="">
		<input type="hidden" name="message" value="">
	</form>

	<div cellspacing="0" cellpadding="0" class="PAGE">
		<div class="entete">
			<header>
				<? include('genericPages/entete.php');  ?>
			</header>
		</div>
		<div class="FENETRE_PRINCIPALE">
			<main>
			
				<div class="TEXTE_FEN">
					<br/>
					<!--<MODE:<?= $GET_modePage ?>; ID:<?= $GET_id ?>;</span>
				<? echo "go to page [" . $GET_page . "]"; ?>-->
					<? include('pages/' . $GET_page); ?>
					<!-- Trigger/Open The Modal -->
				</div>
				<div id="myModal" class="modal">
					<!-- Modal content -->
					<div class="modal-content" id="id-modal-content">
						<form name="modalForm" method="POST" onsubmit="return submitFormModal()" action="">
							<table width="100%" class="BH_MODAL" id="id_bh_modal">
								<tr>
									<td width="95%" id='modalTitre'></td>
									<td width="5%" id="modalClose"></td>
								</tr>
							</table>
							<div id="modalText"></div>
							<br />
							<div id="modalAction"></div>
						</form>
					</div>
				</div>
			</main>
		</div>
		<br/>
		<div class="pied">
			<? include('genericPages/pied.php'); ?>
		</div>
	</div>
</body>
<?if (isset($GET_message) && trim($GET_message) != '') {?>
	<script>
		console.log("message <?= $GET_message ?>");
		alertModalInfo('<?= $GET_message ?>');
	</script>
<? } ?>
</html>