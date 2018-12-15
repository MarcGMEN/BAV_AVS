<?php
    $tabNav = [
        'venir.php'=>'Contacts' ,
        'bav.php'=>'La Bourse' ,
        'animation.php'=>'Animation' ,
        'reglement.php'=>'Reglement' ,
        'faq.php'=>'F.A.Q.' ,
        'statistiques.php'=>'Statistiques' ,
        'presse.php'=>'Presse' ,
        'ventes.php'=>'Ventes' ,
        'telechargements.php'=>'Telechargement'
    ];?>
    
    <?
    foreach ($tabNav as $key => $val) {
        if ($GET_page == $key) {
            $className="navigationSel";
        } else {
            $className="";
        }
        ?>
        <span class="link navigation <?=$className?>" 
            onclick="goTo('<?=$key?>', null, null, null)" ><?=$val?>
        </span>
    <?} ?>