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
    "action_menage",
    "add_counter_action",
    "delete_file",
    "add_cdp","return_lat_lon_cdp","return_all_lat_lon_cdp",
    "makeCarroussel"
);

// $pattern = preg_quote("function ", '/');
// // finalise the regular expression, matching the whole line
// $pattern = "/^$pattern.*\$/m";

// //export de toutes les fonction AJAX des modules
$tabFile = searchFiles("AJAX", "_exportAJAX.php");
// $tabFunction=array();
// $i=0;
foreach ($tabFile as $valFile) {
//     error_log($valFile);
//     $tabAJAX =file_get_contents($valFile);
//     if (preg_match_all($pattern, $tabAJAX, $matches)){
//         foreach (preg_replace("(function )","", $matches[0]) as $val) {
//             $tabVal=explode('(', $val);
//             error_log("add "+$tabVal[0]);
//             sajax_export($tabVal[0]);
//         }
//     }
// }
    include $valFile;
}
