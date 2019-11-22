<pre>
<?php


//$mysqli = mysqli_connect('db2463.1and1.fr','dbo326893785','randovtt' , 'db326893785');
$mysqli = mysqli_connect('localhost','bav','AVS44b@v!' , 'BAV');
if (mysqli_connect_errno($mysqli)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}
$requete2 = " select count(*), cli_nom
from bav_client 
group by cli_nom
having count(*) > 1; ";
$resultat = $mysqli->query($requete2);
$tab = array();
while ($row = $resultat->fetch_assoc()) {
    echo $row['cli_nom'];
    echo "<br/>";
    $requete3 = " select * from bav_client where cli_nom = '".$row['cli_nom']."'";
    $resultat3 = $mysqli->query($requete3);
    $idNew=0;
    while ($row3 = $resultat3->fetch_assoc()) {
        if ($idNew == 0) {
            $idNew=$row3['cli_id'];
        }
        else {
            echo "on remplace l'id ".$row3['cli_id']." par $idNew pour l'objet";
            echo "<br/>";
            $mysqli->query("update bav_objet set obj_id_vendeur = $idNew where obj_id_vendeur = ".$row3['cli_id']);
            $mysqli->query("update bav_objet set obj_id_acheteur = $idNew where obj_id_acheteur = ".$row3['cli_id']);
        }
    }
    $resultat3->close();
}
$resultat->close();
?>
</pre>


