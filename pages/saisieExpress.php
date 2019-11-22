<? $idRamdom = rand(1000, 9999); ?>
<script>
	var idRamdom = "<?= $idRamdom ?>";
</script>
<script src="JS/saisieExpress.js" type="text/javascript"></script>

<form action="#" name="searchFormFiche" onsubmit='x_return_oneFicheByCode(this.numeroFiche.value, display_fiche); return false'>
	<input type="text" name="numeroFiche" size="8" maxlength="50" title="Saisisez le numéro de fiche" placeholder="N° fiche" id="inputSearch" style='background-color:LIGHTGREEN;font-weight: bold;width=10%' tabindex=<?= $tabindex++ ?> />
	<i id="loupe" class="fas fa-search link " onclick="x_return_oneFicheByCode(this.form.numeroFiche.value, display_fiche)"></i>
</form>

<form name="formSaisieExpress" onsubmit="return submitForm()">

	<table width='100%' border=0>
		<tr>
			<td class='tittab' width=10%>No</td>
			<td class='tittab' width=10%>Type</td>
			<td class='tittab' width=15%>Prix vente</td>
			<td class='tittab' width=45% colspan=3>Vendeur</td>
			<td class='tittab' width=10%>Etat</td>
			<td class='tittab' width=10%></td>
		</tr>
		<tr>
			<td class="tittab">
				<span id="obj_numero"></span>
				<input type="text" name="obj_numero">
				<input type="text" name="obj_id">
				<input type="text" name="cli_id">
			</td>
			<td>
			<select name='obj_type' tabindex=<?= $tabindex++ ?> disabled required >
					</select>
			</td>
			<td>
				<input type=number name="obj_prix_vente" disabled size=5 maxlength="10" tabindex=<?= $tabindex++ ?> 
					title="Prix vente" required step="0.1" placeholder="00.00" min=1 />&nbsp;&#8364;
			</td>
			<td>
				<input type=text name='cli_emel' disabled  tabindex=<?= $tabindex++ ?> 
					size="50" maxlength="100" 
					onblur='searchByMel(this.value)' list="listVendeur">
				<datalist id="listVendeur"></datalist>
			</td>
			<td>
				<input type=text name='cli_nom_<?= $idRamdom ?>'disabled  tabindex=<?= $tabindex++ ?> 
					size="50" maxlength="100" required 
					onblur='searchByName(this.value)' list="listVendeurName">
				<datalist id="listVendeurName"></datalist>
			</td>
			<td>
				<input type=text name='cli_code_postal' disabled  tabindex=<?= $tabindex++ ?> size="7" maxlength="5" >
			</td>
			<td id="obj_etat"></td>
			<td>
				<button id="but_action" tabindex=<?= $tabindex++ ?>
					onsubmit="this.form.action.value='new'" onclick="this.form.action.value='new'"></button>
				<input type="hidden" name="action" value="new">
				<button id="but_action2" tabindex=<?= $tabindex++ ?>
					onsubmit="this.form.action.value='new2'" onclick="this.form.action.value='new2'"></button>
				<button id="but_actionAno" tabindex=<?= $tabindex++ ?> class="error"
					onsubmit="this.form.action.value='newAno'" onclick="this.form.action.value='newAno'"></button>
				<input type="hidden" name="obj_etat">
				<input type="hidden" name="obj_etat_new">
				<input type="hidden" name="obj_etat_new2">
				<input type="hidden" name="obj_etat_newAno">
			</td>
		</tr>
	</table>
</form>
<br/>
<table width='100%'>
	<tr>
		<td class='tittab' width=10%>No</td>
		<td class='tittab' width=10%>Type</td>
		<td class='tittab' width=15%>Prix vente</td>
		<td class='tittab' width=45%>Vendeur</td>
		<td class='tittab' width=10%>Etat</td>
		<td class='tittab' width=10%></td>
	</tr>
</table>
<div style="overflow: scroll; height:50%">
	<table width='100%'>
		<? for ($index = 1; $index < 2000; $index++) { ?>
			<tr class='tabl0' id="tr_<?= $index ?>">
				<td width=10% id="numero_<?= $index ?>" onclick="x_return_oneFicheByCode('<?= $index ?>', display_fiche)"><span style="color: GREEN"><?= $index ?></span>
				</td>
				<td width=10% id="type_<?= $index ?>"></td>
				<td width=15% id="prix_vente_<?= $index ?>"></td>
				<td width=45% id="vendeur_<?= $index ?>"></td>
				<td width=10% id="etat_<?= $index ?>"></td>
				<td width=9% id="zoom_<?= $index ?>"></td>
			</tr>
		<? } ?>
	</table>
</div>