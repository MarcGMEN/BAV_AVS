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
    'bav.php' => [
        'libelle' => 'La Bourse',
    ],
    'animations.php' => [
        'libelle' => 'Animations',
    ],
    'reglement.php' => [
        'libelle' => 'Réglement',
    ],
    'faq.php' => [
        'libelle' => 'F.A.Q.',
    ],
    'venir.php' => [
        'libelle' => 'Contacts',
    ],
    'presse.php' => [
        'libelle' => 'Presse',
    ],
];

if ($infAppli['NB_MODIF'] == 1) {
    $tabClientPlus = [
        'stock-client.php' => [
            'libelle' => 'Parc',
        ],
    ];
    $tabNavAll = array_merge($tabNavAll, $tabClientPlus);
}

$tabNavAdm = [];

if ($infAppli['ADMIN']) {
    $tabNavAdm = [
        'fiche.php' => [
            'libelle' => 'Déposer',
            'mode' => 'create',
        ],
        'saisieExpress.php' => [
            'libelle' => 'Création',
            'class' => 'maskMobileBlock',
        ],
        'stock.php' => [
            'libelle' => 'Stock',
        ],
        'stock-client.php' => [
            'libelle' => 'Parc',
        ],
        'clients.php' => [
            'libelle' => 'Clients',
        ],
        'stat.php' => [
            'libelle' => 'Stats',
        ],
        'sousMenuAdmin' => [
            'libelle' => 'Admin',
            'class' => 'maskMobileBlock',
            'sousMenu' => [
                'import.php' => [
                    'libelle' => 'Import Gros Client',
                    'class' => 'maskMobileBlock',
                ],
                'editFiche.php' => [
                    'libelle' => 'Edit HTML',
                    'class' => 'maskMobileBlock',
                ],
                'parametre.php' => [
                    'libelle' => 'Paramètres',
                    'class' => 'maskMobileBlock',
                ],
            ],
        ],
    ];
} elseif ($infAppli['TABLE']) {
    $tabNavAdm = [
        'fiche.php' => [
            'libelle' => '<img src="Images/new.png" width=15pt/> Déposer',
            'mode' => 'create',
        ],
        'saisieExpress.php' => [
            'libelle' => 'Création Express',
            'class' => 'maskMobileBlock',
        ],
        'stock.php' => [
            'libelle' => 'Stock',
        ],
        'stock-client.php' => [
            'libelle' => 'Parc',
        ],
        'clients.php' => [
            'libelle' => 'Clients',
        ],
    ];
} elseif ($infAppli['CLIENT']) {
    $tabNavAdm = [
        'fiche.php' => [
            'libelle' => '<img src="Images/new.png" width=15pt/> Déposer',
            'mode' => 'create',
        ],
    ];
}
$tabNav = array_merge($tabNavAll, $tabNavAdm);
?>

<div class="menuNavigation" id="IDmenuNavigation">
    <div class="row col-md-12" style="width:100%">
        <?php
        foreach ($tabNav as $key => $val) {
            if ($GET_page == $key) {
                $className = 'navigationSel';
            } else {
                $className = '';
            }
            $ext = explode('.', $key);
            if ($ext[1] == '') {
                ?>
                <span class="link <?= $val['class']; ?> navigation <?= $className; ?>" id="lib_ss<?= $key; ?>" onclick="inverseDisplay('ss<?= $key; ?>')">
                    <?= $val['libelle']; ?>
                    <img src="Images/arrow.gif" />
                    <div id="ss<?= $key; ?>" class="SSMENU" style="display:none; position:absolute;width:200px">
                       
                        <?php foreach ($val['sousMenu'] as $keyS => $valS) {
                    if ($GET_page == $keyS) {
                        $classNameS = 'ssnavigationSel'; ?>
                                <script>
                                    getElement('lib_ss<?= $key; ?>').className += " navigationSel";
                                </script>
                            <?php
                    } else {
                        $classNameS = '';
                    } ?>
                            <div class="col-sm-12 col-md-12 col-xs-12 link <?= $valS['class']; ?> ssnavigation <?= $classNameS; ?> " onclick="goTo('<?= $keyS; ?>', '<?= $valS['mode']; ?>', null, null)">- <?= $valS['libelle']; ?></div>
                        <?php
                } ?>
                        
                    </div>
                </span>
            <?php
            } else {
                ?>
                <span class="link <?= $val['class']; ?> navigation <?= $className; ?> " onclick="goTo('<?= $key; ?>', '<?= $val['mode']; ?>', null, null)"><?= $val['libelle']; ?></span>
        <?php
            }
        } ?>
    </div>
</div>