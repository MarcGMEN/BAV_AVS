<?php

/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/
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

function return_oneFicheByCode($id)
{
    $row = getOneFicheByCode($id);
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
        $tabData=string2Tab(utf8_encode($data));

        $tabCli = extract'cli';
        $tabObj = extract'obj';
        makeClient($tabCli);
        $tabObj=string2Tab(utf8_encode($objStr));
        
        $tabObj['obj_id_vendeur']=$tabCli['cli_id'];
    
        // TODO : insert fiche
        $tabObj['obj_id']=0;

        // creation du numero
        if ($ADMIN || $TABLE) {
            makeNumeroFiche(700, $tabObj);
            $tabObj['obj_etat'] = 'STOCK';
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
        $tabObj['obj_id']=insertFiche($tabObj);

        if ($ADMIN || $TABLE) {
            $retour=array();
            $retour['message'] = "OK pour creation de ".$tabObj['obj_numero'];
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

    $tabPlus['titre'] = "BAV";
    $tabPlus['URL'] = $CFG_URL;

    $filePDF = html2pdf(array_merge($fiche, $client, $tabPlus), "fiche_depot.html", "Fiche_" . $fiche['obj_numero']);

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
    
        if ($fiche['obj_etat'] == 'STOCK') {
            $fiche['obj_prix_vente']=$fiche['obj_prix_depot'];
        }
        
        if ($fiche['obj_etat'] == 'VENDU') {
            $fiche['obj_date_vente']=date('y-m-d h:m:s');
        }
        if ($fiche['obj_etat'] == 'RENDU' || $fiche['obj_etat'] == 'PAYE') {
            $fiche['obj_date_retour']=date('y-m-d h:m:s');
        }
        //print_r($fiche);
        updateFiche($fiche);
    }
    return $fiche;
}

function action_updateFiche($obj, $cli)
{
    $fiche =string2Tab(utf8_encode($obj));
    $client =string2Tab(utf8_encode($cli));
    
    makeClient($client);
        
    $fiche['obj_id_vendeur']=$client['cli_id'];
    if (updateFiche($fiche)) {
        return $fiche;
    }
    else {
        return "Oups problème de mise a jour";
    }

    
}

function action_insertFiche($obj)
{
    $tab =string2Tab($obj);
    insertFiche($tab);
    return true;
}
