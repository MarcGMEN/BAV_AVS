<?php
sajax_export(
    "return_enum",
    "get_publiHtml",
    "return_list_unique",
    "action_makePDFFromHtml",
    "return_html",
    "save_html",
    "whatYourName",
    "return_restant",
    "action_menage"
);

//export de toutes les fonction AJAX des modules
$tabFile = searchFiles("AJAX", "_exportAJAX.php");
foreach ($tabFile as $val) {
    include $val;
}
