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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="JS/fenetre.js" type="text/javascript"></script>
	<script src="JS/cookies.js" type="text/javascript"></script>
	<script src="JS/commun.js" type="text/javascript"></script>

	
	
	<?php  // inclusion pour SAJAX
	?>
	<!-- <script type="text/javascript" src="JS/sajax/json_stringify.js"></script>
	<script type="text/javascript" src="JS/sajax/json_parse.js"></script>
	<script type="text/javascript" src="JS/sajax/sajax.js"></script>  -->
	<!-- MODE DEV -->
	<? sajax_show_javascript(); ?> 
	<!-- MODE PROD -->
	<? //sajax_show_javascript("JS/sajax.js");?> 

	<script type="text/javascript">
		var startSaisie = false;
		var ADMIN = <?= $infAppli['ADMIN'] ? 1 : 0 ?>;
		var CLIENT = <?= $infAppli['CLIENT'] ? 1 : 0 ?>;
		var BAV_ENCOURS = <?= $infAppli['bav_en_cours'] ? 1 : 0 ?>;
		var dateFinClient = '<?= $infAppli['dateFinClient'] ?>';

		// date d'ouverture du depot
		var DATE_J1 = <?= $infAppli['date_j1'] ?>;
		var DATE_J2 = <?= $infAppli['date_j2'] ?>;

		var NB_MODIF = <?= $infAppli['NB_MODIF'] ?>;
		var BASE_INFO = <?= $infAppli['base_info'] ?>;
		var modePage = '<?= $GET_modePage ?>';
		var id = '<?= $GET_id ?>';
		var type = '<?= $GET_type ?>';

		function initIndex() {
			x_return_countByEtat(display_counter);
		}

		function display_counter(val) {
			console.log(val);
			 var totalVente = 0
	        totalFiche = 0;
    	    if (val['STOCK']) {
        	    totalFiche += parseInt(val['STOCK']);
	        }
    	    if (val['VENDU']) {
        	    totalFiche += parseInt(val['VENDU']);
            	totalVente += parseInt(val['VENDU']);
	        }
    	    if (val['RENDU']) {
        	    totalFiche += parseInt(val['RENDU']);
	        }	
    	    if (val['PAYE']) {
        	    totalFiche += parseInt(val['PAYE']);
	            totalVente += parseInt(val['PAYE']);
        	}

        	val['TOTAL'] = totalFiche;

	        var statVendu = parseInt((totalVente / totalFiche) * 100) + "%";
    	    val['VENDU'] = totalVente+ " <span style='font-size:0.3em'>("+statVendu+")</span>";
			display_formulaire(val,null);
		}
	</script>

</head>

<body class="parent" LANG="fr-FR" onload="initIndex()">
	<div class="BH_CADRE" cellspacing="0" cellpadding="0">
		<div class="TITRE_FENETRE_PRINCIPALE" style='background-color:#00b7cd'>
			<br/>
			<? $titreFen = retraitAccent($infAppli['titre']); 
			echo $titreFen;?>
			</br/></br/>
			Compteurs
			</br/>&nbsp;
		</div>
	</div>
	<? if (!$infAppli['bav_en_cours']) {?>
	<div class="row same-height">
		<div class="col-xs-4 col-sm-3 col-md-3 cptTitre" >
			Pré-dépôt
		</div>
		<div class="col-xs-8 col-sm-9 col-md-9 cptGRAND" id=CONFIRME></div>
	</div>
	<? } ?>
	<? if ($infAppli['bav_en_cours']) {?>
	<div class="row same-height">
		<div class="col-xs-4 col-sm-3 col-md-3 cptTitre" >
			Stock
		</div>
		<div class="col-xs-8 col-sm-9 col-md-9 cptGRAND" id=TOTAL></div>
	</div>
	<div class="row same-height">
		<div class="col-xs-4 col-sm-3 col-md-3 cptTitre VENDU" >
			Vendu
		</div>
		<div class="col-xs-8 col-sm-9 col-md-9 cptGRAND VENDU" id=VENDU></div>
	</div>
	<? }?>
</body>
</html>