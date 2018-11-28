<?php
echo "<pre>";
print_r($_SERVER);
$mysqli = mysqli_connect('localhost','bav','AVS44BAV1200' , 'bav');
//$mysqli = mysql_connect('localhost','u58357168','randovtt' , 'db326893785');

if (mysqli_connect_errno($mysqli)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$result = $mysqli->query("SHOW COLUMNS FROM $table LIKE '$champ'");
    if ($result) {
        $row = $result->fetch_assoc();
        $tab =  explode("','", utf8_encode(preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row['Type'])));
        return $tab;
    } else {
        throw new Exception("Pb getEnumValues ".mysqli_error());
    }

echo "<pre>";
?>


