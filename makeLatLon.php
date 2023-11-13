<pre>
<?php

require_once "config.ini";
try {
// $mysqli = mysqli_connect('db2463.1and1.fr','dbo326893785','randovtt' , 'db326893785');
$mysqli = mysqli_connect('localhost','bav','AVS44b@v!' , 'BAV');
echo $_SERVER['SERVER_NAME'];
// $mysqli = mysqli_connect('localhost','','' , 'bav');
// print_r("mysqli =");
// print_r($mysqli);
if (mysqli_connect_errno()) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}
$requete2 = " select * from bav_client";
$resultat = $mysqli->query($requete2);
$tab = array();
while ($row = $resultat->fetch_assoc()) {
        //print_r($row);
        $adresse=trim($row['cli_adresse'])." ".trim($row['cli_adresse'])." ".trim($row['cli_code_postal'])." ".trim($row['cli_ville']);
        
        get_lat_long($adresse);
        break;
}
$resultat->close();
// echo "<A href='$adresse'>$adresse</A>";
// echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$adresse&choe=UTF-8' title='Link to Google.com' />";
}
catch (Exception $e) {
    print_r($e);
}

#print_r(get_lat_long("44600"));

function get_lat_long($address){
    $region="france";
    $address = str_replace(" ", "+", $address);
    $apiKEY="AIzaSyABMdW__fbyBDjd0aBBCY_im7rejFftkDQ";
    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region&key=$apiKEY");
    $json = json_decode($json);

    print_r($json);

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    return $lat.','.$long;
}

?>
</pre>


