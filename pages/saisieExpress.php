<?$idRamdom = rand(1000, 9999);?>
<script>
	var idRamdom = "<?=$idRamdom?>";

	function initPage() {
		x_return_fiches_express(display_fiches);
		document.formSaisieExpress.obj_numero.focus();

		// chargement des taux
		x_return_tauxBAV(display_list_taux_com);
	    // chargement des depot
	    x_return_depotsBAV(display_list_prix_depot);
	}

	function display_list_taux_com(val) {
	    display_list_select(val,'cli_taux_com',document.formSaisieExpress);
	}

	function display_list_prix_depot(val) {
	    display_list_select(val,'cli_prix_depot',document.formSaisieExpress);
	}

	function display_fiches(val) {
		
        for (index in val) {
			if (!isNaN(index))  {
				
				getElement("numero_"+val[index]['obj_numero']).innerHTML=val[index]['obj_numero'];
				getElement("prix_vente_"+val[index]['obj_numero']).innerHTML=val[index]['obj_prix_vente'];
				getElement("vendeur_"+val[index]['obj_numero']).innerHTML=
                    val[index]['cli_nom']+" -- "+val[index]['cli_taux_com']+" % -- "+val[index]['cli_prix_depot']+" €";
				getElement("etat_"+val[index]['obj_numero']).innerHTML=val[index]['obj_etat'];
				
				getElement("zoom_"+val[index]['obj_numero']).innerHTML="<i class='link fas fa-search' onclick='goTo(\"fiche.php\",\"modif\","+val[index]['obj_id']+")'></i>";
				getElement("numero_"+val[index]['obj_numero']).className+=" link";

				getElement("tr_"+val[index]['obj_numero']).className="tabl0 "+val[index]['obj_etat'];
			}
		}
		
	}

	function display_fiche(val) {
		document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).disabled=false;
		document.formSaisieExpress.obj_prix_vente.disabled=false;
		document.formSaisieExpress.cli_prix_depot.disabled=false;
		document.formSaisieExpress.cli_taux_com.disabled=false;
		getElement("but_action").disabled=false;
		if (val['obj_etat']) {
			getElement("but_action2").style.display='none';
			getElement("but_action").innerHTML="TERMINER";
			
            val['obj_etat_new']="STOCK";
			if (val['obj_etat'] == "STOCK") {
				getElement("but_action").innerHTML="VENDU";
				getElement("but_action2").style.display='block';
				getElement("but_action2").innerHTML="RENDU";
				val['obj_etat_new']="VENDU";
				document.formSaisieExpress.cli_prix_depot.disabled=true;
				document.formSaisieExpress.cli_taux_com.disabled=true;

			}
			else if (val['obj_etat'] == "VENDU") {
				getElement("but_action").innerHTML="PAYER";
				val['obj_etat_new']="PAYE";
				document.formSaisieExpress.cli_prix_depot.disabled=true;
				document.formSaisieExpress.cli_taux_com.disabled=true;

			}
			else if (val['obj_etat'] == "PAYE") {
				getElement("but_action").disabled=true;
				document.formSaisieExpress.obj_prix_vente.disabled=true;
				document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).disabled=true;
				val['obj_etat_new']="";
			}
			else if (val['obj_etat'] == "RENDU") {
				getElement("but_action").disabled=true;
				document.formSaisieExpress.obj_prix_vente.disabled=true;
				document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).disabled=true;
				document.formSaisieExpress.cli_prix_depot.disabled=true;
				document.formSaisieExpress.cli_taux_com.disabled=true;
				val['obj_etat_new']="";
			}
			
			display_formulaire(val, document.formSaisieExpress);
			
			x_return_oneClient(val['obj_id_vendeur'], display_infoClientVendeur);
		} else {
			val['obj_prix_vente']="";
			val['obj_etat_new']="STOCK";
			val['obj_etat']="INIT";
			val['obj_id']="";
			
			//val['cli_id']="";
            console.log(val);
            if (document.formSaisieExpress.cli_id.value!='') {
                x_return_oneClient(document.formSaisieExpress.cli_id.value, display_infoClientVendeur);
			}	
			display_formulaire(val, document.formSaisieExpress);
			getElement("but_action2").style.display='none';
			getElement("but_action").innerHTML="CREER";
		}
	}
	
	function display_infoClientVendeur(val) {
		if (val instanceof Object) 
		{
            console.log(val);
			val['cli_nom_'+idRamdom]=val['cli_nom'];
		} else {
			val = Array();
			val['cli_id']="";
		}
		display_formulaire(val, document.formSaisieExpress);
	}

	function display_listVendeur(val)	{
        var list = getElement("listVendeur");
	    list.innerHTML="";
	    for (index in val) {
        	list.appendChild(new Option(val[index], val[index]));
		}
	}

	function submitForm() {
		var tabObj = recup_formulaire(document.formSaisieExpress, 'obj');
    	var tabCli = recup_formulaire(document.formSaisieExpress, 'cli');
    	tabCli['cli_nom'] = document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).value;
		delete tabCli['cli_nom_' + idRamdom];
		
		if (tabObj['obj_etat'] == 'INIT') {
            tabObj['obj_etat']="STOCK";
			var tabData = Object.assign({}, tabObj, tabCli);
			x_action_createFicheExpress(tabToString(tabData), display_fin_create);
		}
		else if (tabObj['obj_etat_new'] == 'VENDU') {
			x_get_publiHtml(tabToString(tabObj), 'modal_confirm_vendre.html', display_messageConfirmChangeEtatForm);
		}
        else if (tabObj['obj_etat_new'] != '') {
			console.log("etat => "+tabObj['obj_etat_new']);
			x_action_changeEtatFiche(tabToString(tabObj), display_fin_create);
        }
		//document.formSaisieExpress.obj_numero.value="";
       // val['obj_numero']="";
	//	display_fiche(val);
        return false;
	}

	function display_messageConfirmChangeEtatForm(val) {
	    alertModalConfirmForm(val);
	}
	/**click sur btn cofirm de modalEtatForm */
	function confirmModalForm() {
    	var tabAch = recup_formulaire(document.modalForm, 'ach');
    	for (i in tabAch) {
	        newKey = i.replace("ach_", "cli_");
        	tabAch[newKey] = tabAch[i];
        	delete tabAch[i];
    	}
    	var tabObjModal = recup_formulaire(document.modalForm, 'obj');

    	var tabObj = recup_formulaire(document.ficheForm, 'obj');
    	tabObj['obj_marque'] = document.ficheForm.elements.namedItem('obj_marque_' + idRamdom).value;
    	delete tabObj['obj_marque_' + idRamdom];

    	tabObj['obj_prix_vente'] = tabObjModal['obj_prix_vente'];

	    var tabData = Object.assign({}, tabObj, tabAch);
    	closeModal();
	    x_action_vendFiche(tabToString(tabData), display_fin_create);
	}


	function display_fin_create(val) {
		x_return_fiches_express(display_fiches);
		document.formSaisieExpress.obj_numero.focus();
		x_return_oneFicheByCode(document.formSaisieExpress.obj_numero.value, display_fiche)
	}
	function unloadPage() {}

</script>


<form name="formSaisieExpress" onsubmit="return submitForm()">

	<table width='100%'>
		<tr>
			<td class='tittab' width=10%>No</td>
			<td class='tittab' width=15%>Prix vente</td>
			<td class='tittab' width=45% colspan=4>Vendeur</td>
			<td class='tittab' width=10%>Etat</td>
			<td class='tittab' width=10% colspan=2>Action</td>

		</tr>
		<tr>
			<td>
				<input type="number" name="obj_numero" required onblur="x_return_oneFicheByCode(this.value, display_fiche)"
				 tabindex=<?=$tabindex++?> >
				<!--<span id="obj_id" ></span>-->
				<input type="hidden" name="obj_id">
			</td>
			<td>
				<input type=number name="obj_prix_vente" size=5 maxlength="10" tabindex=<?=$tabindex++?>
				title="Prix vente" required step="0.1"
				placeholder="00.00"/>&nbsp;&#8364;</td>
			<td>
				<input type=text name='cli_nom_<?=$idRamdom?>' tabindex=<?=$tabindex++?>
				size="50" maxlength="100" required
				onblur='x_return_oneClientByName(this.value, display_infoClientVendeur)'
				list="listVendeur"
				onkeyup='x_return_listClientByName(this.value, display_listVendeur)'>
				<datalist id="listVendeur"></datalist>
			</td>
			<td>
				<span id="cli_id"></span>
				<input type="hidden" name="cli_id">
			</td>
			<td>
				<select name='cli_taux_com' tabindex=<?=$tabindex++?> ></select>%
			</td>
			<td>
				<select name='cli_prix_depot' tabindex=<?=$tabindex++?> ></select>&#8364;
			</td>
			<td id="obj_etat"></td>
			<td>
				<button id="but_action" tabindex=<?=$tabindex++?>></button>
			</td>
			<td>
				<button id="but_action2" tabindex=<?=$tabindex++?>
					onclick="document.formSaisieExpress.obj_etat_new.value='RENDU'"></button>
				<input type="hidden" name="obj_etat">
				<input type="hidden" name="obj_etat_new">
			</td>
		</tr>
	</table>
</form>

<hr />

<table width='100%'>
	<tr>
		<td class='tittab' width=10%>No</td>
		<td class='tittab' width=15%>Prix vente</td>
		<td class='tittab' width=55%>Vendeur</td>
		<td class='tittab' width=10%>Etat</td>
		<td class='tittab' width=10%></td>
	</tr>
</table>
<div style="overflow: scroll; height:60%">
	<table width='100%'>
		<? for ($index = 1; $index<1500; $index++) {?>
		<tr class='tabl0' id="tr_<?=$index?>">
			<td width=10% id="numero_<?=$index?>" onclick="x_return_oneFicheByCode('<?=$index?>', display_fiche)"><span
				 style="color: GREEN"><?=$index?></span>
			</td>
			<td width=15% id="prix_vente_<?=$index?>"></td>
			<td width=55% id="vendeur_<?=$index?>"></td>
			<td width=10% id="etat_<?=$index?>"></td>
			<td width=9% id="zoom_<?=$index?>"></td>
		</tr>
		<?}?>
	</table>
</div>