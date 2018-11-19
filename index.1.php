<?php
$time_start = microtime(true);

require_once "Include/commun_functions.php";
require_once "Commun/connect.php";
require_once "Commun/Sajax.php";
error_reporting(E_ERROR);

if (!isset($GET_option)) {
    $GET_option="";
}

if (!isset($GET_page)) {
    $GET_page="accueil.php";
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
<TITLE>BAV 2015</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="keywords" lang="fr" content="web 2.0, association">
<meta name="description" lang="fr" content="">
<META NAME="Author" LANG="fr" CONTENT="romael">
<link REL="SHORTCUT ICON" HREF="Icones/BAV.png">
<LINK HREF='style.css' REL='stylesheet' TYPE='text/css'>

<script src="JS/cookies.js" type="text/javascript"></script>
<script src="JS/fenetre.js" type="text/javascript"></script>
<script src="JS/commun.js" type="text/javascript"></script>
<!-- <script src="JS/calendrier.js" type="text/javascript"></script> -->
<!-- <script src="JS/fileIO.js" type="text/javascript"></script> -->

<?php
// recuperation des modules
$test=array_search($GET_mod, $CFG_MODULE_MAP);
if (is_numeric($test) || (!is_array($CFG_MODULE_MAP) && $GET_mod == $CFG_MODULE_MAP)) { ?>
<!--  GOOGLE MAP -->
<!--  <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?//$CFG_KEY_GM?>" type="text/javascript"></script>-->
<!-- <script src="JS/geolocalisation.js" type="text/javascript"></script> -->
<!-- <script src="http://gmaps-utility-library.googlecode.com/svn/trunk/markermanager/release/src/markermanager.js"></script> -->
<?php
}?>
<!--  POUR le gestion des couleurs -->
<script type="text/javascript" src="JS/jscolor.js"></script>

<?php  // inclusion pour SAJAX?>
<script type="text/javascript" src="JS/sajax/json_stringify.js"></script>
<script type="text/javascript" src="JS/sajax/json_parse.js"></script>
<script type="text/javascript" src="JS/sajax/sajax.js"></script> 

<?sajax_show_javascript();?>
  
<script type="text/javascript" >
  function initIndex() {
  } 
  </script> 
</head>
<BODY class="parent" LANG="fr-FR" onload="initIndex();initEntete();initPage()" onunload="unloadPage()">
<center>
<A name="top"></A>
<table width="100%" height="100%" cellspacing="0" cellpadding="0" class="PAGE" border=1 id="ecran" >
	<tr >
			<td class="entete" colspan="6" height="15%" id="entete" >
			  <?include('genericPages/entete.php');  ?>
			</td>
		</tr>
		<tr >
			<td class="FENETRE_PRINCIPALE"  id="page" >
			<?include('pages/'.$GET_page);?>
			</td>
		</tr>
		<tr height="2%">
			<td class="pied" colspan="6" height="2%" valign="bottom" >
			  <?include('genericPages/pied.php');?>
			</td>
		</tr>
</table>

</center>
  <?//mysql_close($id_db);
    if (isset($GET_message) && $GET_message != "") {
        ?>
	<script>window.alert("<?=$GET_message?>");</script>
  <?}?>
	<!-- insertion d'un commentaire -->
</body>
</html>

