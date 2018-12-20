<?php
    $tabNavAll = [
        'bav.php'=>[
            'libelle' => 'La Bourse' ],
        'animations.php'=>[
            'libelle' => 'Animations' ],
        'reglement.php'=>[
            'libelle' => 'Reglement' ],
        'faq.php'=>[
            'libelle' => 'F.A.Q.' ],
        'venir.php' => [
            'libelle' => 'Contacts' ],
        'presse.php'=>[
            'libelle' => 'Presse'],
    ];

    $tabNavAdm=[];

    if ($infAppli['TABLE'] || $infAppli['ADMIN']) {
        $tabNavAdm = [
            'fiche.php'=>[
                'libelle' => '<img src="Images/new.png" width=15pt/> Depot en ligne',
                'mode' => 'create'
            ],
            'parametre.php'=>[
                'libelle' => 'Parametre' ],
            'stock.php'=>[
                'libelle' => 'Stock'
            ],
            'clients.php'=>[
                'libelle' => 'Clients'
            ]
        ];
    } elseif ($infAppli['CLIENT']) {
        $tabNavAdm = [
            'fiche.php'=>[
                'libelle' => '<img src="Images/new.png" width=15pt/> Depot en ligne',
                'mode' => 'create'
            ]
        ];
    }
    $tabNav = array_merge($tabNavAll, $tabNavAdm);

    $tail = (int) (100 / sizeof($tabNav));
    ?>

<div class="row col-md-12" style="width:100%">

    <?
    foreach ($tabNav as $key => $val) {
        if ($GET_page == $key) {
            $className="navigationSel";
        } else {
            $className="";
        }
        ?>
    <span style="width:<?=$tail?>%" class="link navigation <?=$className?>"
        onclick="goTo('<?=$key?>', '<?=$val["mode"]?>', null, null)"><?=$val['libelle']?></span>
    <?} ?>
</div>