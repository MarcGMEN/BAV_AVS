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
    $tabRetour = array_merge($tabMarques, listUnique("bav_objet", "obj_marque"));
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
            $tabObj['obj_etat'] = 'INIT';
            makeNumeroFiche(5000, $tabObj);
            $tabPlus['lien_confirm']=$CFG_URL."/Actions/rest.php?a=C&id=".$tabObj['obj_id_modif'];
        
            if ($tabObj['obj_prix_depot'] == "") {
                $tabPlus['obj_prix_depot']='A renseigner le jour du dépôt dernier délai';
                $tabObj['obj_prix_depot'] == 0;
            } else {
                $tabPlus['obj_prix_depot']=$tabObj['obj_prix_depot']." €";
            }

            $tabPlus['titre'] = $infoAppli['titre'];

            $titreMel="Confirmation de votre dépôt à ".$infoAppli['titre'];
            $message = makeMessage($titreMel, array_merge($tabObj, $tabCli, $tabPlus), "mel_enregistrement.html");
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

    $numBAV=$_COOKIE['NUMERO_BAV'];
    $par = return_oneParametre($numBAV);

     // pas de data, on fait un objet vide
    if ($id) {
        $fiche = getOneFiche($id);
        $client = getOneClient($fiche['obj_id_vendeur']);
    } else {
        $client['cli_prix_depot']=$par['par_prix_depot_1'];
        $client['cli_nom']="";
        $client['cli_emel']="";
        $client['cli_adresse']="";
        $client['cli_adresse1']="";
        $client['cli_code_postal']="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $client['cli_ville']="";
        $client['cli_telephone']="";
        $client['cli_telephone_bis']="";
        $client['cli_taux_com']=$par['par_taux_1'];
        
        $fiche['obj_numero']="";
        $fiche['obj_type']="";
        $fiche['obj_public']="";
        $fiche['obj_pratique']="";
        $fiche['obj_marque']="";
        $fiche['obj_modele']="";
        $fiche['obj_couleur']="";
        $fiche['obj_accessoire']="";
        $fiche['obj_description']="Date d'achat:<br/>Prix d'achat :<br/>Taille :";
        $fiche['obj_prix_vente'] ="<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
        $fiche['obj_prix_depot'] ="<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
    }

    $tabPlus['titre'] = $par['par_titre'];
    $tabPlus['URL'] = $CFG_URL;


    if ($fiche['obj_prix_vente'] != $fiche['obj_prix_depot']) {
        $fiche['obj_prix_depot']="<s>".$fiche['obj_prix_depot']." €</s><span style='color:RED'>".$fiche['obj_prix_vente']."</span>";
    }

    $acheteur = array();
    if ($fiche['obj_id_acheteur'] != null && $fiche['obj_id_acheteur']  > 0) {
        $acheteur = getOneClient($fiche['obj_id_acheteur']);
        $client['cli_com']=($client['cli_taux_com']*$fiche['obj_prix_vente']/100) > 100 ? 100 :
            ($client['cli_taux_com']*$fiche['obj_prix_vente']/100);
    } else {
        $fiche['obj_prix_vente']="<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>";
        $client['cli_com']="<u style='color:blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>";
    }
   
    // todo  faire un fichier fiche + etiquette.
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


function return_fiches($tri, $sens, $selection)
{
    $tab = getFiches($tri, $sens, string2Tab(utf8_encode($selection)));

    $tab['total_vente']=0;
    foreach ($tab as $key => $val) {
        if ($val['obj_etat'] == "VENDU" || $val['obj_etat'] == "PAYE") {
            $tab['total_vente']+= $val['obj_prix_vente'];
        }
    }
    return $tab;
}
