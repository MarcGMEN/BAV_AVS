<script>
    function menuSel() {
        var x = getElement("IDmenuNavigation");
  if (x.className === "menuNavigation") {
    x.className += " responsive";
  } else {
    x.className = "menuNavigation";
  }
    }
</script>

<?php
   // print_r($infAppli);
    $tabNavAll = [
        'bav.php'=>[
            'libelle' => 'La Bourse' ],
        'animations.php'=>[
            'libelle' => 'Animations' ],
        'reglement.php'=>[
            'libelle' => 'Réglement' ],
        'faq.php'=>[
            'libelle' => 'F.A.Q.' ],
        'venir.php' => [
            'libelle' => 'Contacts' ],
        'presse.php'=>[
            'libelle' => 'Presse'],
    ];

    if ($infAppli['NB_MODIF'] == 1) {
        $tabClientPlus = [
            'stock-client.php' => [
                'libelle' => 'Parc'
            ]
        ]; 
        $tabNavAll= array_merge($tabNavAll, $tabClientPlus);
    }

    $tabNavAdm=[];

    if ($infAppli['ADMIN']) {
        $tabNavAdm = [
            'fiche.php'=>[
                'libelle' => 'Déposer',
                'mode' => 'create'
            ],
            'editFiche.php'=>[
                'libelle' => 'Edit HTML',
                'class' => 'maskMobileBlock'
            ],
            'parametre.php'=>[
                'libelle' => 'Paramètres',
                'class' => 'maskMobileBlock'
            ],
            'stock.php' => [
                'libelle' => 'Le Stock'
            ],
            'stock-client.php' => [
                'libelle' => 'Parc'
            ],
            'clients.php' => [
                'libelle' => 'Clients'
            ],
            'saisieExpress.php' => [
                'libelle' => 'Saisie Express',
                'class' => 'maskMobileBlock'
            ],
            'import.php' => [
                'libelle' => 'Import Gros Client',
                'class' => 'maskMobileBlock'
            ]
        ];
    } elseif ($infAppli['TABLE']) {
        $tabNavAdm = [
            'fiche.php'=>[
                'libelle' => '<img src="Images/new.png" width=15pt/> Déposer',
                'mode' => 'create'
            ],
            'stock.php'=>[
                'libelle' => 'Le Stock'
            ],
            'stock-client.php' => [
                'libelle' => 'Parc'
            ],
            'clients.php'=>[
                'libelle' => 'Clients'
            ],
            'saisieExpress.php'=>[
                'libelle' => 'Saisie Express',
                'class' => 'maskMobileBlock'
            ]
        ];
    } elseif ($infAppli['CLIENT']) {
        $tabNavAdm = [
            'fiche.php'=>[
                'libelle' => '<img src="Images/new.png" width=15pt/> Déposer',
                'mode' => 'create'
            ]
        ];
    }
    $tabNav = array_merge($tabNavAll, $tabNavAdm);
    ?>

<div  class="menuNavigation"  id="IDmenuNavigation" >
<div class="row col-md-12" style="width:100%">
    <?
    foreach ($tabNav as $key => $val) {
        if ($GET_page == $key) {
            $className="navigationSel";
        } else {
            $className="";
        }
        ?>
    <span class="link <?=$val['class']?> navigation <?=$className?> "
        onclick="goTo('<?=$key?>', '<?=$val["mode"]?>', null, null)"><?=$val['libelle']?></span>
    <?} ?>
</div>
    </div>