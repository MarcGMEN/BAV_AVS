<?php
$time_start = microtime(true);

require_once "Commun/commun_functions.php";
require_once "Repository/base_repository.php";
require_once "Repository/parametre_repository.php";
require_once "AJAX/parametre_AJAX.php";
require_once "Commun/connect.php";
require_once "Commun/Sajax.php";
require_once "config.ini";


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
	<TITLE>BAV 2019</TITLE>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" lang="fr" content="web 2.0, association">
	<meta name="description" lang="fr" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<META NAME="Author" LANG="fr" CONTENT="romael">
	<link REL="SHORTCUT ICON" HREF="Images/BAV.png">

	<LINK HREF='style.css' REL='stylesheet' TYPE='text/css' >

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
	 crossorigin="anonymous">
	 
	<!--  GOOGLE MAP -->
	<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script> -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	 crossorigin="anonymous">
	<script src="JS/modal.js" type="text/javascript"></script>
	<script src="JS/cookies.js" type="text/javascript"></script>
	<script src="JS/fenetre.js" type="text/javascript"></script>
	<script src="JS/commun.js" type="text/javascript"></script>
	<script src="JS/index.js" type="text/javascript"></script>

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
		var TABLE = <?=$infAppli['TABLE'] ? 1 : 0?>;
		var ADMIN = <?=$infAppli['ADMIN'] ? 1 : 0?>;
		var CLIENT = <?=$infAppli['CLIENT'] ? 1 : 0?>;
		var modePage = '<?=$GET_modePage?>';

		function initIndex() {}

		function setStartSaisie(cStartSaisie) {
			startSaisie = cStartSaisie;
			enteteSaisie();
			pageSaisie();
		}

		// recuperation des donnees de la BAV
		function setParamValIndex(val) {
			getElement("mode").innerHTML = modePage + "-" + CLIENT + "-" + TABLE + "-" + ADMIN +
				"; id=<?=$GET_id?>";
		}

		function setParamVal(val) {
			setParamValIndex(val);
		}

		function display_retour_test(val) {
			console.log(val);
		}

		function confirmModalTest() {
			setTimeout(function() {
				closeModal();
			}, 1000);
		}

		function display_openPDF(val) {
			console.log(val);
			window.open(val, '_blank');
		}

		function goTo(page = 'accueil.php', modePage = '', id = null, message = '') {
			document.formNavigation.action = 'index.php';
			document.formNavigation.page.value = page
			document.formNavigation.modePage.value = modePage;
			document.formNavigation.message.value = message;
			document.formNavigation.id.value = id;
			document.formNavigation.submit();
		}
	</script>

</head>


<BODY class="parent" LANG="fr-FR" onload="initIndex();initEntete();initPage()" onunload="unloadPage()">
	<form name=formNavigation method=post>
		<input type=hidden name=page value="">
		<input type=hidden name=modePage value="">
		<input type=hidden name=id value="">
		<input type=hidden name=message value="">
	</form>
	<A name="top"></A>
	<div width="95%" cellspacing="0" cellpadding="0" class=PAGE>
		<div class="entete">
			<?include('genericPages/entete.php');  ?>
		</div>
		<div class="FENETRE_PRINCIPALE">
			<?print_r($infAppli);?>
			<div class="TEXTE_FEN">
				MODE:<?=$GET_modePage?>; ID:<?=$GET_id?>;</span>
				<?echo "go to page [".$GET_page."]";?>
				<?include('pages/'.$GET_page);?>
				<!-- Trigger/Open The Modal -->
			</div>
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
						<br /><br />
						<div id="modalText"></div>
						<br /><br />
						<div id="modalAction"></div>
					</form>
				</div>
			</div>

		</div>
		<div class="pied">
			<?include('genericPages/pied.php');?>
		</div>
	</div>
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