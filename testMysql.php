<pre>
<?php

require_once "config.ini";
try {
// $mysqli = mysqli_connect('db2463.1and1.fr','dbo326893785','randovtt' , 'db326893785');
$mysqli = mysqli_connect('localhost','bav','AVS44b@v!' , 'BAV');
echo $_SERVER['SERVER_NAME'];
// $mysqli = mysqli_connect('localhost','','' , 'bav');
print_r("mysqli =");
print_r($mysqli);
if (mysqli_connect_errno($mysqli)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}
$requete2 = " select * from bav_objet ";
$resultat = $mysqli->query($requete2);
$tab = array();
if ($row = $resultat->fetch_assoc()) {
    $newId=hash_hmac('md5', $row['obj_numero']."2019",'avs44'    );
    echo $row['obj_id']." => ".$row['obj_id_modif']." ==> ".$newId."<br/>";
    // if (!$mysqli->query("update bav_objet set obj_id_modif = '$newId' where obj_id = ".$row['obj_id'])) {
    //     echo $GLOBALS['mysqli']->error;
    // }
    $adresse="http://avs44.com/bourseauxvelos/index.php?modePage=restF&id=" . $row['obj_id_modif'];

}
$resultat->close();
echo "<A href='$adresse'>$adresse</A>";
echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$adresse&choe=UTF-8' title='Link to Google.com' />";
}
catch (Exception $e) {
    print_r($e);
}

?>
</pre>


