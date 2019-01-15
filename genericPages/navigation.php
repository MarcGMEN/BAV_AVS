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

    $tabNavAdm=[];

    if ($infAppli['TABLE']) {
        $tabNavAdm = [
            'fiche.php'=>[
                'libelle' => '<img src="Images/new.png" width=15pt/> Dépôt en ligne',
                'mode' => 'create'
            ],
            'stock.php'=>[
                'libelle' => 'Stock'
            ],
            'clients.php'=>[
                'libelle' => 'Clients'
            ],
            'saisieExpress.php'=>[
                'libelle' => 'Saisie Express'
            ]
        ];
    } elseif ($infAppli['ADMIN']) {
        $tabNavAdm = [
            'fiche.php'=>[
                'libelle' => 'Dépôt en ligne',
                'mode' => 'create'
            ],
            'editFiche.php'=>[
                'libelle' => 'Edit HTML'
            ],
            'parametre.php'=>[
                'libelle' => 'Paramètres' ],
            'stock.php'=>[
                'libelle' => 'Stock'
            ],
            'clients.php'=>[
                'libelle' => 'Clients'
            ],
            'saisieExpress.php'=>[
                'libelle' => 'Saisie Express'
            ]
        ];
    } elseif ($infAppli['CLIENT']) {
        $tabNavAdm = [
            'fiche.php'=>[
                'libelle' => '<img src="Images/new.png" width=15pt/> Dépôt en ligne',
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
    <span class="link navigation <?=$className?> "
        onclick="goTo('<?=$key?>', '<?=$val["mode"]?>', null, null)"><?=$val['libelle']?></span>
    <?} ?>
</div>
    </div>