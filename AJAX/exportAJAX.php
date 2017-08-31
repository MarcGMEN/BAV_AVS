<?php
sajax_export("return_numero_bav","return_numeros_bav","return_nb_fiche","return_nb_vendeur","return_nb_acheteur",
	"return_nb_vendu","return_nb_stock","return_nb_retour","return_nb_clients");

//export de toutes les fonction AJAX des modules
$tabFile=searchFiles("AJAX","_exportAJAX.php");
foreach ($tabFile as $val) {
  include $val;
}
?>