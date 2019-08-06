<pre>
<?php

echo date('d/m/Y e');
// $mysqli = mysqli_connect('db2463.1and1.fr','dbo326893785','randovtt' , 'db326893785',3306);
$mysqli = mysqli_connect('localhost','bav','AVS44b@v!' , 'BAV');
if (mysqli_connect_errno($mysqli)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}
print_r($mysqli);
$result = $mysqli->query("SHOW COLUMNS FROM bav_objet LIKE 'obj_public'");
if (mysqli_connect_errno($mysqli)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}
print_r($result);
echo "apres query";
if ($result) {
    $row = $result->fetch_assoc();
    $tab =  explode("','", utf8_encode(preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row['Type'])));
    print_r($tab);
} else {
    print_r(mysqli_error());
}
test();

function test()
{
    print_r($GLOBALS['mysqli']);
}
?>
</pre>


