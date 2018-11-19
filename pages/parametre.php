<script>
	function initPage() {
		x_getAllParametre(display_parametres);
		getElement("par_numero_bav").focus();
	}
	var modePage=null;
	function display_parametres(val) {

		var repr="<table width='100%'>";
		for (index in val) {
			repr+="<tr class='tabl0 link' onclick=''>";
			repr+="<td width=40% >";
			repr+=val[index]['par_numero_bav'];
			repr+="</td>";
			repr+="<td width=25% >";
			repr+=val[index]['par_titre'];
			repr+="</td>";
			repr+="<td width=15% >";
			repr+=val[index]['par_client_date_debut'];
			repr+="</td>";
			repr+="</tr>";
		}
		repr+="</table>";

		getElement('tab_parametres').innerHTML=repr;
	}
	
	function unloadPage() {
		
	}

	function modeCreation() {
		disableDisplay('parametres');
		enableDisplay('parametre');
		modePage="creation";
	}
	function fermer() {
		disableDisplay('parametre');
		enableDisplay('parametres');
		modePage="select";
	}

	// validation de la fiche
	function valide(laForm) {
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
		
		return false;
	}
</script>

<div id="parametres" >
	<h3 class="tittab1">Liste des parametres
		<span class="tittab1" style='align-content: right'>
			<button height="100%" onclick="modeCreation()" > 
				<span class="fas fa-plus-square" ></span>&nbsp;Creation<br/>
			</button>
		</span>
	</h3>
	<div id="tab_parametres" >
	</div>
</div>
<div id="parametre" style="display:none" >
<form name="parametreForm" method="POST" action="Actions/AParametre.php" onsubmit='return valide(this)'>
<fieldset class=fiche>
	<legend class=titreFiche>Parametre</legend>
	<table width=100%  cellpadding=2 cellspacing=2 >
		<tr>
			<td class="titrow" width=15%>Numero BAV <span title="Obligatoire">*<span></td>
			<td class="tabl0" width=35%>
			<input type=text name="par_numero_bav" id="par_numero_bav" size=4 maxlength="10" tabindex=<?=$tabindex++?> 
						placeholder="numéro BAV (année)" onkeyup="setStartSaisie(true);" 
						required/>
					<span id="par_numero_bav_err" class="error"></span>
			</td>
			<td class="titrow" width=15%></td>
			<td class="tabl0" width=35% ></td>
			</td>
		</tr>
		<tr>
			<td class="titrow" >Titre <span title="Obligatoire">*<span></td>
			<td class="tabl0" >
			<input name="par_titre" size=70 maxlength="100" tabindex=<?=$tabindex++?> 
						placeholder="titre BAV" onkeyup="setStartSaisie(true);" required/>
			</td>
		</tr>
		<tr>
			<td class="titrow" >Taux <span title="Obligatoire">*<span></td>
			<td class="tabl0" >
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
			<td class="titrow" >Depot <span title="Obligatoire">*<span></td>
			<td class="tabl0" >
				<input type=number name="par_tarif_depot_1"  tabindex=<?=$tabindex++?> 
						placeholder="00.0" onkeyup="setStartSaisie(true);" 
						required min=1 max=10 size=2/>&#8364;
				&nbsp;&nbsp;
				<input type=number name="par_tarif_depot_2"  tabindex=<?=$tabindex++?> 
						placeholder="00.0" onkeyup="setStartSaisie(true);" 
						min=0 max=10 size=2/>&#8364;
				&nbsp;&nbsp;
				<input type=number name="par_tarif_depot_3"  tabindex=<?=$tabindex++?> 
						placeholder="00.0" onkeyup="setStartSaisie(true);" 
						min=0 max=10 size=2 />&#8364;
			</td>
		</tr>
		<tr>
			<td class="titrow" >Date Client <span title="Obligatoire">*<span></td>
			<td class="tabl0" >
				<input type=date name="par_client_date_debut" size=15 maxlength="15" tabindex=<?=$tabindex++?> 
						onkeyup="setStartSaisie(true);" required   min="<?=date('Y-m-d')?>" max="2030-12-31"/>
				&nbsp;&nbsp;
				<input type=date name="par_client_date_fin" 
						tabindex=<?=$tabindex++?> 
						onkeyup="setStartSaisie(true);" required   min="<?=date('Y-m-d')?>" max="2030-12-31"/>
			</td>
		</tr>
		<tr>
			<td class="titrow" >Date Table <span title="Obligatoire">*<span></td>
			<td class="tabl0" >
				<input type=date name="par_table_date_debut" tabindex=<?=$tabindex++?> 
					 onkeyup="setStartSaisie(true);" required min="<?=date('Y-m-d')?>" max="2030-12-31"/>
				&nbsp;&nbsp;
				<input type=date name="par_table_date_fin" size=15 maxlength="15" tabindex=<?=$tabindex++?> 
					 onkeyup="setStartSaisie(true);" required min="<?=date('Y-m-d')?>" max="2030-12-31"/>
			</td>
		</tr><tr>
			<td class="titrow" >IPs Table <span title="Obligatoire">*<span></td>
			<td class="tabl0" >
				<input type=text name="par_table_id_mac" size=50 maxlength="600" tabindex=<?=$tabindex++?> 
						placeholder="Adresse ips pour accés table, séparé d'une virgule" onkeyup="setStartSaisie(true);"
						required />
			</td>
		</tr>
	</table>
	<br />

	<table width=100% class=fiche>
		<tr>
			<td width=50% align=center><button 
				name=buttonValideAcheteur tabindex=<?=$tabindex++?> >Valider</button>
			</td>
			<td width=50% align=center><input type=button value="Fermer"
				onclick="fermer()"
				onkeypress="fermer()" 
				tabindex=<?=$tabindex++?> >
			</td>
		</tr>
	</table>
</form>
</div>
