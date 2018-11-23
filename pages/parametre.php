<script>
	function initPage() {
		x_return_allParametre(display_parametres);
		getElement("par_numero_bav").focus();
		modePage="select";
		// getElement('mode').innerHTML=modePage;
	}

	var modePage="select";
	function display_parametres(val) {

		var repr="<table width='90%'><tr >";
		repr+="<td class='tittab' width=5% >No BAV</td>";
		repr+="<td class='tittab' width=45% >Titre</td>";
		repr+="<td class='tittab' width=15% >Taux Com</td>";
		repr+="<td class='tittab' width=15% >Tarif Depot</td>";
		repr+="<td class='tittab' width=10% >Debut client</td>";
		repr+="<td class='tittab' width=10% >Debut table</td>";
		for (index in val) {
			repr+="<tr class='tabl0 link' onclick=\"getOne(\'"+val[index]['par_numero_bav']+"\')\">";
			repr+="<td width=5% >";
			repr+=val[index]['par_numero_bav'];
			repr+="</td>";
			repr+="<td width=45% >";
			repr+=val[index]['par_titre'];
			repr+="</td>";
			repr+="<td width=15% >";
			repr+=val[index]['par_taux_1']+"%, "+val[index]['par_taux_2']+"%, "+val[index]['par_taux_3']+"%"
			repr+="</td>";
			repr+="<td width=15% >";
			repr+=val[index]['par_prix_depot_1']+"€, "+val[index]['par_prix_depot_2']+"€, "+val[index]['par_prix_depot_3']+"€"
			repr+="</td>";
			
			repr+="<td width=10% >";
			repr+=val[index]['par_client_date_debut_FR'];
			repr+="</td>";
			repr+="<td width=10% >";
			repr+=val[index]['par_table_date_debut_FR'];
			repr+="</td>";
			repr+="</tr>";
		}
		repr+="</table>";

		getElement('tab_parametres').innerHTML=repr;
	}
	
	function unloadPage() {
		
	}

	function getOne(id) {
		x_return_oneParametre(id, display_parametre);
	}

	function display_parametre(val) {
		document.parametreForm.reset();
        display_formulaire(val,document.parametreForm);
		disableDisplay('parametres');
		enableDisplay('parametre');
		modePage="modification";
		document.parametreForm.par_numero_bav.disabled=true;
		getElement('mode').innerHTML=modePage;
	}

	function modeCreation() {
		document.parametreForm.reset();
		disableDisplay('parametres');
		enableDisplay('parametre');
		modePage="creation";
		document.parametreForm.par_numero_bav.disabled=false;
		getElement('mode').innerHTML=modePage;
	}

	function fermerCRUD() {
		suite=true;
		if (startSaisie) {
			if (alertModalConfirm("Vous avez des modifications en cours <br/><br/><br/><br/>!<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>dd<br/><br/><br/><br/><br/><br/><br/>coucou ")) {
			//if (confirm("Vous avez des modifications en cours ! ")) {
				setStartSaisie(false);
			}
			else {
				suite=false;
			}
		}

		/*if (suite) {
			disableDisplay('parametre');
			enableDisplay('parametres');
			modePage="select";
			//getElement('mode').innerHTML=modePage;
		}*/
		
	}

	// validation de la fiche
	function valider(laForm) {
        // console.log("modePage : "+modePage);
		// comparaison date
		var debClient = laForm.par_client_date_debut.value;
		var finClient = laForm.par_client_date_fin.value;

		if( (new Date(debClient).getTime() > new Date(finClient).getTime()))
    	{
			laForm.par_client_date_debut.setCustomValidity("Date de début doit être après la date de fin");
			return false;
		}

		// comparaison date
		var debTable = laForm.par_table_date_debut.value;
		var finTable = laForm.par_table_date_fin.value;

		if( (new Date(debTable).getTime() > new Date(finTable).getTime()))
    	{
			laForm.par_table_date_debut.setCustomValidity("Date de début doit être après la date de fin");
			return false;
		}

		// TODO :  appel insert, ou modif
		// creation d'un tableau de style object javacript
		par = recup_formulaire(laForm, 'par');
		if (modePage == 'modification') {
			x_action_updateParametre(tabToString(par),display_update);
		}
		if (modePage=='creation') {
			x_action_insertParametre(tabToString(par),display_update);
		}
		
		return false;
	}

	function display_update(val) {
        if (val == 1) {
            x_return_allParametre(display_parametres);
            setStartSaisie(false);
            fermerCRUD();
		}
		else { 
			alertModalError(val);
		}
	}
</script>

<div id="parametres">
	<h3 class="tittab1">Liste des parametres
		<span class="tittab1" style='align-content: right'>
			<button height="100%" onclick="modeCreation()">
				<span class="fas fa-plus-square"></span>&nbsp;Creation<br />
			</button>
		</span>
	</h3>
	<div id="tab_parametres">
	</div>
</div>
<div id="parametre" style="display:none">
	<form name="parametreForm" method="POST" action="" onsubmit='return valider(document.parametreForm)'>
		<fieldset class=fiche>
			<legend class=titreFiche>Parametre<small><div id="mode"></div></small></legend>
			<table width=100% cellpadding=2 cellspacing=2>
				<tr>
					<td class="titrow" width=15%>Numero BAV <span title="Obligatoire">*<span></td>
					<td class="tabl0" width=35%>
						<input type=number name="par_numero_bav" id="par_numero_bav" size=4 min=2010 max=2100 tabindex=<?=$tabindex++?>
						placeholder="numéro BAV (année)" onkeyup="setStartSaisie(true);"
						required/>
						<span id="par_numero_bav_err" class="error"></span>
					</td>
					<td width=15%></td>
					<td width=35%></td>
					</td>
				</tr>
				<tr>
					<td class="titrow">Titre <span title="Obligatoire">*<span></td>
					<td class="tabl0">
						<input name="par_titre" size=70 maxlength="100" tabindex=<?=$tabindex++?>
						placeholder="titre BAV" onkeyup="setStartSaisie(true);" required/>
					</td>
				</tr>
				<tr>
					<td class="titrow">Taux <span title="Obligatoire">*<span></td>
					<td class="tabl0">
						<input type=number name="par_taux_1" size=3 tabindex=<?=$tabindex++?>
						placeholder="Taux 1" onkeyup="setStartSaisie(true);"
						required min=1 max=100 />%
						<span id="PAR_TAUX_1" class="error"></span>
						&nbsp;&nbsp;
						<input type=number name="par_taux_2" size=3 tabindex=<?=$tabindex++?>
						placeholder="Taux 2" onkeyup="setStartSaisie(true);"
						min=0 max=100 />%
						&nbsp;&nbsp;
						<input type=number name="par_taux_3" size=3 tabindex=<?=$tabindex++?>
						placeholder="Taux 3" onkeyup="setStartSaisie(true);"
						min=0 max=100 />%
					</td>
				</tr>
				<tr>
					<td class="titrow">Depot <span title="Obligatoire">*<span></td>
					<td class="tabl0">
						<input type=number name="par_prix_depot_1" tabindex=<?=$tabindex++?>
						placeholder="00.0" onkeyup="setStartSaisie(true);"
						required min=1 max=10 size=2/>&#8364;
						&nbsp;&nbsp;
						<input type=number name="par_prix_depot_2" tabindex=<?=$tabindex++?>
						placeholder="00.0" onkeyup="setStartSaisie(true);"
						min=0 max=10 size=2/>&#8364;
						&nbsp;&nbsp;
						<input type=number name="par_prix_depot_3" tabindex=<?=$tabindex++?>
						placeholder="00.0" onkeyup="setStartSaisie(true);"
						min=0 max=10 size=2 />&#8364;
					</td>
				</tr>
				<tr>
					<td class="titrow">Date Client <span title="Obligatoire">*<span></td>
					<td class="tabl0">
						<input type=date name="par_client_date_debut" size=15 maxlength="15" tabindex=<?=$tabindex++?>
						onkeyup="setStartSaisie(true);" required min="<?=date('Y-m-d')?>"
						max="2030-12-31"/>
						&nbsp;&nbsp;
						<input type=date name="par_client_date_fin" tabindex=<?=$tabindex++?>
						onkeyup="setStartSaisie(true);" required min="<?=date('Y-m-d')?>"
						max="2030-12-31"/>
					</td>
				</tr>
				<tr>
					<td class="titrow">Date Table <span title="Obligatoire">*<span></td>
					<td class="tabl0">
						<input type=date name="par_table_date_debut" tabindex=<?=$tabindex++?>
						onkeyup="setStartSaisie(true);" required min="<?=date('Y-m-d')?>"
						max="2030-12-31"/>
						&nbsp;&nbsp;
						<input type=date name="par_table_date_fin" size=15 maxlength="15" tabindex=<?=$tabindex++?>
						onkeyup="setStartSaisie(true);" required min="<?=date('Y-m-d')?>"
						max="2030-12-31"/>
					</td>
				</tr>
				<tr>
					<td class="titrow">IPs Table <span title="Obligatoire">*<span></td>
					<td class="tabl0">
						<input type=text name="par_table_id_mac" size=50 maxlength="600" tabindex=<?=$tabindex++?>
						placeholder="Adresse ips pour accés table, séparé d'une virgule" onkeyup="setStartSaisie(true);"
						required value="localhost, 127:0:0:1, ::1"/>
					</td>
				</tr>
			</table>
			<br />

			<table width=100% class=fiche>
				<tr>
					<td width=50% align=center>
						<button name=buttonValideAcheteur tabindex=<?=$tabindex++?>>Valider</button>
					</td>
					<td width=50% align=center>
						<input type=button value="Fermer" onclick="fermerCRUD()" onkeypress="fermerCRUD()"
						 tabindex=<?=$tabindex++?> >
					</td>
				</tr>
			</table>
	</form>
</div>