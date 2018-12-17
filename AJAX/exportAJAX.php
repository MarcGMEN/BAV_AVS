<?php
sajax_export("return_enum", "get_publiHtml", "return_list_unique");

//export de toutes les fonction AJAX des modules
$tabFile = searchFiles("AJAX", "_exportAJAX.php");
foreach ($tabFile as $val) {
    include $val;
}
?>