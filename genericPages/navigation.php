<?php
    $tabNav = [
        'pages/index.php'=>'Accueil' ,
        'pages/venir.php'=>'Venir' ,
        'pages/bav.php'=>'La Bourse' ,
        'pages/animation.php'=>'Animation' ,
        'pages/reglement.php'=>'Reglement' ,
        'pages/faq.php'=>'F.A.Q.' ,
        'pages/statistiques.php'=>'Statistiques' ,
        'pages/presse.php'=>'Presse' ,
        'pages/ventes.php'=>'Ventes' ,
        'pages/telechargements.php'=>'Téléchargement' ,
        'pages/contact.php'=>'Contact'
    ];?>
    
    <?
    foreach ($tabNav as $key => $val) {?>
        <span class="link navigation" onclick="goTo('<?=$key?>', null, null, null)" ><?=$val?></span>
    <?} ?>