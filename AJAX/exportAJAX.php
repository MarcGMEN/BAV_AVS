<?php
sajax_export();

//export de toutes les fonction AJAX des modules
$tabFile = searchFiles("AJAX", "_exportAJAX.php");
foreach ($tabFile as $val) {
    include $val;
}
?>