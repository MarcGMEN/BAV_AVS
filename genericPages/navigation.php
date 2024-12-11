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
$today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
// print_r($infAppli);
$tabNavAll = [
    'news.php' => [
        'libelle' => 'News',
    ],
    'bav.php' => [
        'libelle' => 'La Bourse',
    ],
    'animations.php' => [
        'libelle' => 'Animations',
        'notif' => "ANIM"
    ],
    'reglements.php' => [
        'libelle' => 'Réglements',
        'mode' => 'B',
    ],
    'faq.php' => [
        'libelle' => 'F.A.Q.',
        'notif' => "FAQ"
    ],
    // 'venir.php' => [
    //     'libelle' => 'Contacts',
    // ],
    'presse.php' => [
        'libelle' => 'Presse',
        'notif' => "PRESSE"
    ],
    'avis.php' => [
        'libelle' => 'Avis'
    ],


];

$tabNavAdm = [];

if ($infAppli['ADMIN']) {
    $tabNavAdm = [
        'stock-client.php' => [
            'libelle' => 'Les vélos'
        ],
        'avis.php' => [
            'libelle' => 'Avis'
        ],
        'SPACE' => [
            'libelle' => '&nbsp;&nbsp;&nbsp;',
        ],

        'saisieExpress.php' => [
            'libelle' => 'Gestion fiches',
            'class' => 'maskMobileBlock',
        ],
        'stock.php' => [
            'libelle' => 'Stock',
        ],
        'stock-client.php' => [
            'libelle' => 'Les vélos'
        ],
        'clients.php' => [
            'libelle' => 'Clients',
        ],
        'sousMenuAdmin' => [
            'libelle' => 'Admin',
            'class' => 'sousMenu',
            'sousMenu' => [
                'import.php' => [
                    'libelle' => 'Import Client',
                    'class' => 'maskMobileBlock',
                ],
                'editFiche.php' => [
                    'libelle' => 'Editions',
                    'class' => 'maskMobileBlock',
                ],
                'parametre.php' => [
                    'libelle' => 'Paramètres',
                    'class' => 'maskMobileBlock',
                ],
                'creneau.php' => [
                    'libelle' => 'Créneaux'
                ],
                'stat.php' => [
                    'libelle' => 'Stats',
                ],
                'statSite.php' => [
                    'libelle' => 'Stat Access',
                    'class' => 'maskMobileBlock'
                ],
                'pre_depot.php' => [
                    'libelle' => 'Pré-déposer pour TEST',
                    'mode' => 'create',
                ],
                'downloads.php' => [
                    'libelle' => 'Downloads',
                    'class' => 'maskMobileBlock'
                ],
            ],
        ],
    ];
} elseif ($infAppli['CLIENT']) {
    $tabNavAdm = [
        'stock-client.php' => [
            'libelle' => 'Les vélos'
        ],
        // 'SPACE0' => [s
        //     'libelle' => '🟡🟡',
        // ],
        'pre_depot.php' => [
            'libelle' => '<span class="PRE-DEPOT" >Pour pré-déposer.</span>',
            'mode' => 'create',
        ],
        // 'SPACE1' => [
        //     'libelle' => '🟡🟡',
        // ],
        // 'STOCK-CLIENT.PHP' => [
        //     'LIBELLE' => 'LES VÉLOS'
        // ],
    ];
} elseif ($infAppli['bav_en_cours'] || $infAppli['date_j1'] == $today) {
    $tabNavAdm = [
        'stock-client.php' => [
            'libelle' => 'Les vélos'
        ],
        'pre_depot.php' => [
            'libelle' => '<span class="PRE-DEPOT" >Pour suivre vos ventes.</span>',
            'mode' => '',
        ],
        'avis.php' => [
            'libelle' => 'Avis'
        ],
    ];
}

if (isset($_COOKIE['CAFFARD_BAV']) &&  !$infAppli['ADMIN']) {
    $tabNavAdm = [
        'stock-client.php' => [
            'libelle' => 'Les vélos'
        ]
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
            $notif = 0;
            if (isset($val['notif']) && actusRecente($val['notif'])) {
                $notif = 1;
            }
            if (startsWith($key, "SPACE")) { ?>
                <?= $val['libelle']; ?>
                <? } else {
                $ext = explode('.', $key);
                if ($ext[1] == '') { ?>
                    <span class="link <?= $val['class']; ?> navigation <?= $className; ?>" id="lib_ss<?= $key; ?>" onclick="inverseDisplay('ss<?= $key; ?>')">
                        <?= $val['libelle']; ?>
                        <img src="Images/arrow.gif" />
                        <div id="ss<?= $key; ?>" class="SSMENU" style="display:none; position:absolute">

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
                } else { ?>
                    <span class="link <?= $val['class']; ?> navigation <?= $className; ?> " onclick="goTo('<?= $key; ?>', '<?= $val['mode']; ?>', null, null)">
                        <?= $val['libelle'];
                        if ($notif) {
                            echo "<img src='Images/notif.png' width=15pt title='Nouveau post' alt='new post'>";
                        } ?>
                    </span>
        <?php }
            }
        } ?>
    </div>
</div>