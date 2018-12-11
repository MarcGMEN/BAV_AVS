<?php

/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/

function return_countByEtat()
{
    return countByEtat();
}


function return_list_marques()
{
    $tabMarques = ['TREK','SCOTT','CANNONDALE','GITANE','PEUGEOT','MERCIER','SUNN','GT','EXS','CERVELO','BIANCHI',
        'COLNAGO','KUOTA','BH','BMC','BTWIN','DECATHLON','CANYON','CKT','COMMENCAL','DIAMONDBACK','GIANT','KONA',
        'KTM','MBK','MERIDA','ORBEA','PINARELLO','RIDLEY','SPECIALIZED','TIME','WILLIER','LOOK'];
    $tabRetour = array_merge($tabMarques, get_marques());
    $tabRetour=array_unique($tabRetour);
    sort($tabRetour);
    return $tabRetour ;
}

function return_list_modeles($marque)
{
	$tabRetour=get_modelesByMarques(strtoupper($marque));
	sort($tabRetour);
    return $tabRetour ;
}


function return_oneFicheByCode($id)
{
    $row = getOneFicheByCode($id, $_COOKIE['NUMERO_BAV']);
    if ($row) {
        $row['obj_date_depot_FR'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date_depot'], true));
    }
    return $row;
}

function return_oneFicheByIdModif($id)
{
    $row = getOneFicheByIdModif($id);
    if ($row) {
        $row['obj_date_depot_FR'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date_depot'], true));
    }
    return $row;
}

function return_oneFiche($id)
{
    $row = getOneFiche($id);
    if ($row) {
        $row['obj_date_depot_FR'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date_depot'], true));
    }
    return $row;
}


function action_createFiche($data)
{
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN=$infoAppli['ADMIN'];
    $TABLE=$infoAppli['TABLE'];
    $CLIENT=$infoAppli['CLIENT'];

    extract($GLOBALS);
    $retour="";
    try {
        // creation du client, avec test si pas deja connu
        $tabObj =tabToObject(string2Tab(utf8_encode($data)), "obj");
        $tabCli =tabToObject(string2Tab(utf8_encode($data)), "cli");
        makeClient($tabCli);
        
        $tabObj['obj_id_vendeur']=$tabCli['cli_id'];
    
        // TODO : insert fiche
        $tabObj['obj_id']=0;

        // creation du numero
        if ($ADMIN || $TABLE) {
            makeNumeroFiche(700, $tabObj);
            $tabObj['obj_etat'] = 'STOCK';
            $tabObj['obj_prix_vente']=$tabObj['obj_prix_depot'];
            $tabObj['obj_date_depot']=date('y-m-d h:m:s');
        } else {
            makeNumeroFiche(5000, $tabObj);
            $tabObj['lien_confirm']=$CFG_URL."/Actions/rest.php?a=C&id=".$tabObj['obj_id_modif'];
        
            if ($tabObj['obj_prix_depot'] == "") {
                $tabObj['obj_prix_depot']='____.__';
            }
            $titreMel="Confirmation du dépôt de la Bourse Aux Vélos";
            $message = makeMessage($titreMel, array_merge($tabObj, $tabCli), "mel_enregistrement.html");
        }
        
        $tabObj['obj_numero_bav']=$_COOKIE['NUMERO_BAV'];
//        print_r($tabObj);
        $tabObj['obj_id']=insertFiche($tabObj);

        if ($ADMIN || $TABLE) {
            $retour=array();
            //$retour['message'] = "OK pour creation de ".$tabObj['obj_numero'];
            $retour['id']=$tabObj['obj_id'];
        } else {
            $retour = sendMail($titreMel, $tabCli['cli_emel'], $message);
        }
    } catch (Exception $e) {
        return "ERREUR ".$e->getMessage();
    }
    return $retour;
}


function action_deleteFiche($id)
{
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN=$infoAppli['ADMIN'];
    $TABLE=$infoAppli['TABLE'];
    $CLIENT=$infoAppli['CLIENT'];
    
    extract($GLOBALS);

    deleteFiche($id);
}

function action_makePDF($id)
{
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN=$infoAppli['ADMIN'];
    $TABLE=$infoAppli['TABLE'];
    $CLIENT=$infoAppli['CLIENT'];

    extract($GLOBALS);

    $fiche = getOneFiche($id);
    $client = getOneClient($fiche['obj_id_vendeur']);

    $tabPlus['titre'] = $par['titre'];
    $tabPlus['URL'] = $CFG_URL;

    if ($fiche['obj_prix_vente'] != $fiche['obj_prix_depot']) {
        $fiche['obj_prix_depot']="<s>".$fiche['obj_prix_depot']." €</s><span style='color:RED'>".$fiche['obj_prix_vente']."</span>";
    }

    if ($fiche['obj_id_acheteur'] != null) {
        $acheteur = getOneClient($fiche['obj_id_acheteur']);
        $client['cli_com']=($client['cli_taux_com']*$fiche['obj_prix_vente']/100) > 100 ? 100 :
            ($client['cli_taux_com']*$fiche['obj_prix_vente']/100);
    } else {
        $acheteur=[];
        $fiche['obj_prix_vente']="<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
        $client['cli_com']="<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>";
    }

    // todo : acheteur
    // prix de vente, date de vente
        
    $filePDF = html2pdf(array_merge($fiche, $client, $acheteur, $tabPlus), "fiche_depot.html", "Fiche_" . $fiche['obj_numero']);

    return $CFG_URL.$filePDF;
}

function action_mail()
{
    /*$headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";*/
    //$headers .= "Content-Transfer-Encoding:8bit \n";
    /*$headers .= "From: avs.vtt@gmail.com\r\n";
    $headers .= "Reply-To: avs.vtt@gmail.com\r\n";
*/
    $titreMel="Confirmation du dépôt de la Bourse Aux Vélos";
    echo sendMailTEST($titreMel, "marc.garces@free.fr", "coucou sendMailTéééééàààéààçàèèôöEST");
    return sendMail($titreMel, "braillou@gmail.com", "coucou sendMail", "/BAV/out/PDF/Fiche_700.pdf");
}
function action_confirmeFiche($obj)
{
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN=$infoAppli['ADMIN'];
    $TABLE=$infoAppli['TABLE'];
    $CLIENT=$infoAppli['CLIENT'];

    if ($ADMIN || $TABLE) {
        $fiche =string2Tab(utf8_encode($obj));
        $fiche['obj_etat']=$fiche['obj_etat_new'];
        unset($fiche['obj_etat_new']);

        makeNumeroFiche(700, $fiche);
        
        updateFiche($fiche);
    }
    return $fiche;
}
function action_changeEtatFiche($obj)
{
    $infoAppli = return_infoAppli();
    // droit = ADMIN+TABLE+CLIENT
    $ADMIN=$infoAppli['ADMIN'];
    $TABLE=$infoAppli['TABLE'];
    $CLIENT=$infoAppli['CLIENT'];

    if ($ADMIN || $TABLE) {
        $fiche =string2Tab(utf8_encode($obj));
        $fiche['obj_etat']=$fiche['obj_etat_new'];
        unset($fiche['obj_etat_new']);
    
        if ($fiche['obj_etat'] == 'CONFIRME') {
            makeNumeroFiche(700, $fiche);
        } elseif ($fiche['obj_etat'] == 'STOCK') {
            $fiche['obj_prix_vente']=$fiche['obj_prix_depot'];
            $fiche['obj_date_depot']=date('y-m-d h:m:s');
        } elseif ($fiche['obj_etat'] == 'VENDU') {
            $fiche['obj_date_vente']=date('y-m-d h:m:s');
        } elseif ($fiche['obj_etat'] == 'RENDU' || $fiche['obj_etat'] == 'PAYE') {
            $fiche['obj_date_retour']=date('y-m-d h:m:s');
        }
        //print_r($fiche);
        updateFiche($fiche);
    }
    return $fiche;
}

function action_vendFiche($data)
{
    $fiche =tabToObject(string2Tab(utf8_encode($data)), "obj");
    $client =tabToObject(string2Tab(utf8_encode($data)), "cli");
    
    makeClient($client);
    
    $fiche['obj_etat']=$fiche['obj_etat_new'];
    unset($fiche['obj_etat_new']);
        
    $fiche['obj_id_acheteur']=$client['cli_id'];
    $fiche['obj_date_vente']=date('y-m-d h:m:s');
    if (updateFiche($fiche)) {
        return $fiche;
    } else {
        return "Oups problème de mise a jour";
    }
}

function action_updateFiche($data)
{
    $fiche =tabToObject(string2Tab(utf8_encode($data)), "obj");
    $client =tabToObject(string2Tab(utf8_encode($data)), "cli");
    
    makeClient($client);
        
    $fiche['obj_id_vendeur']=$client['cli_id'];
    if (updateFiche($fiche)) {
        return $fiche;
    } else {
        return "Oups problème de mise a jour";
    }
}

function action_insertFiche($obj)
{
    $tab =string2Tab($obj);
    insertFiche($tab);
    return true;
}
