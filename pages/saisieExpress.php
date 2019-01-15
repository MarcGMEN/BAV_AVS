<?$idRamdom = rand(1000, 9999);?>
<script>
	var idRamdom = "<?=$idRamdom?>";

	function initPage() {
		x_return_fiches_express(display_fiches);
		document.formSaisieExpress.obj_numero.focus();
	}
	function display_fiches(val) {
		
        for (index in val) {
			if (!isNaN(index))  {
				
				getElement("numero_"+val[index]['obj_numero']).innerHTML=val[index]['obj_numero'];
				getElement("prix_vente_"+val[index]['obj_numero']).innerHTML=val[index]['obj_prix_vente'];
				getElement("vendeur_"+val[index]['obj_numero']).innerHTML=val[index]['cli_nom'];
				getElement("etat_"+val[index]['obj_numero']).innerHTML=val[index]['obj_etat'];
				
				getElement("tr_"+val[index]['obj_numero']).onclick="goTo(\"fiche.php\",\"modif\",val[index]['obj_id'])";
				getElement("tr_"+val[index]['obj_numero']).className+=" link";

				if (val[index]['obj_etat'] == "STOCK") {
					getElement("tr_"+val[index]['obj_numero']).style.background="ORANGE";
					getElement("tr_"+val[index]['obj_numero']).style.color="BLACK";
				}
				else if (val[index]['obj_etat'] == "VENDU") {
					getElement("tr_"+val[index]['obj_numero']).style.background="GREEN";
					getElement("tr_"+val[index]['obj_numero']).style.color="BLACK";
				}
				else if (val[index]['obj_etat'] == "PAYE") {
					getElement("tr_"+val[index]['obj_numero']).style.background="DARKGREEN";
					getElement("tr_"+val[index]['obj_numero']).style.color="WHITE";
				}
				else if (val[index]['obj_etat'] == "RENDU") {
            		getElement("tr_"+val[index]['obj_numero']).style.background="DARKGREEN";
					getElement("tr_"+val[index]['obj_numero']).style.color="WHITE";
				}

			}
		}
		
	}

	function display_fiche(val) {
		document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).disabled=false;
		document.formSaisieExpress.obj_prix_vente.disabled=false;
			
		if (val instanceof Object) {
			getElement("but_action2").style.display='none';
			getElement("but_action").innerHTML="TERMINER";
            val['obj_etat_new']="STOCK";
			if (val['obj_etat'] == "STOCK") {
				getElement("but_action").innerHTML="VENDU";
				getElement("but_action2").style.display='block';
				getElement("but_action2").innerHTML="RENDU";
				val['obj_etat_new']="VENDU";
			}
			else if (val['obj_etat'] == "VENDU") {
				getElement("but_action").innerHTML="PAYER";
				val['obj_etat_new']="PAYE";
			}
			else if (val['obj_etat'] == "PAYE") {
				getElement("but_action").disabled=true;
				if (!ADMIN) {
					document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).disabled=true;
					document.formSaisieExpress.obj_prix_vente.disabled=true;
				}
				val['obj_etat_new']="";
			}
			else if (val['obj_etat'] == "RENDU") {
				getElement("but_action").disabled=true;
				if (!ADMIN) {
					document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).disabled=true;
					document.formSaisieExpress.obj_prix_vente.disabled=true;
				}
				val['obj_etat_new']="";
			}
			
			display_formulaire(val, document.formSaisieExpress);
			
			x_return_oneClient(val['obj_id_vendeur'], display_infoClientVendeur);
		} else {
			val = Array();
			val['obj_prix_vente']="";
			//val['cli_nom_'+idRamdom]="";
			val['obj_etat_new']="STOCK";
			val['obj_etat']="INIT";
			val['obj_id']="";
			//val['cli_id']="";
			display_formulaire(val, document.formSaisieExpress);
			getElement("but_action2").style.display='none';
			getElement("but_action").innerHTML="CREER";
		}
	}
	
	function display_infoClientVendeur(val) {
		if (val instanceof Object) 
		{
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
		else if (tabObj['obj_etat_new'] != '') {
            console.log("etat => "+tabObj['obj_etat_new']);
			x_action_changeEtatFiche(tabToString(tabObj), display_fin_create);
        }
		document.formSaisieExpress.obj_numero.value="";
		display_fiche(null);
        return false;
	}

	function display_fin_create(val) {
		x_return_fiches_express(display_fiches);
		document.formSaisieExpress.obj_numero.focus();
	}
	function unloadPage() {}

</script>


<form name="formSaisieExpress" onsubmit="return submitForm()">

	<table width='100%'>
		<tr>
			<td class='tittab' width=10%>No</td>
			<td class='tittab' width=15%>Prix vente</td>
			<td class='tittab' width=45%>Vendeur</td>
			<td class='tittab' width=10%>Etat</td>
			<td class='tittab' width=10%>Action</td>

		</tr>
		<tr>
			<td>
				<input type="number" name="obj_numero" required onblur="x_return_oneFicheByCode(this.value, display_fiche)"
				 tabindex=<?=$tabindex++?> >
				 <span id="obj_id" ></span>
				 <input type="hidden" name="obj_id"  >
			</td>
			<td>
				<input type=number name="obj_prix_vente" size=5 maxlength="10" tabindex=<?=$tabindex++?>
				title="Prix vente" required step="0.1"
				placeholder="00.00"/>&nbsp;&#8364;</td>
			<td><input type=text name='cli_nom_<?=$idRamdom?>' tabindex=<?=$tabindex++?>
				size="50" maxlength="100" required 
				onblur='x_return_oneClientByName(this.value, display_infoClientVendeur)' 
				list="listVendeur"
				onkeyup='x_return_listClientByName(this.value, display_listVendeur)'>
				<datalist id="listVendeur"></datalist>
				<span id="cli_id" ></span>
				<input type="hidden" name="cli_id"  >
			</td>
			<td id="obj_etat"></td>

			<td>
					<button id="but_action" tabindex=<?=$tabindex++?>></button>
					<button id="but_action2" tabindex=<?=$tabindex++?> onclick="document.formSaisieExpress.obj_etat_new.value='RENDU'"></button>
					<input type="hidden" name="obj_etat"  >
					<input type="hidden" name="obj_etat_new"  >
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
		<td class='tittab' width=20%>Etat</td>
	</tr>
	<? for ($index = 1; $index<1500; $index++) {?>
	<tr class='tabl0' id="tr_<?=$index?>">
		<td id="numero_<?=$index?>"><span style="color: GREEN"><?=$index?></span>
		</td>
		<td id="prix_vente_<?=$index?>"></td>
		<td id="vendeur_<?=$index?>"></td>
		<td id="etat_<?=$index?>"></td>
	</tr>
	<?}?>
</table>