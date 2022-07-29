<?php $idRamdom = rand(1000, 9999);
$maxFiche=2001;
?>

<script>
	var idRamdom = "<?= $idRamdom ?>";
	var theId='<?=$_GET['id']?>';
	var maxFiche = "<?= $maxFiche ?>";
</script>
<script src="JS/saisieExpress.js" type="text/javascript"></script>


<form action="#" name="searchFormFiche" 
		onsubmit='x_return_oneFicheByCode(this.numeroFiche.value, display_ficheN); return false'>
	<input type="text" name="numeroFiche" 
		size="6" maxlength="4" title="Saisisez le numéro de fiche" 
		placeholder="N° fiche" id="inputSearch" 
		style='background-color:LIGHTGREEN;font-weight: bold;width:10%' 
		tabindex=1
	 	onblur="x_return_oneFicheByCode(document.searchFormFiche.numeroFiche.value, display_ficheN)" />
	<i id="loupe" class="fas fa-search link " 
	onclick="x_return_oneFicheByCode(document.searchFormFiche.numeroFiche.value, display_ficheN)"></i>
</form>

<form name="formSaisieExpress" onsubmit="return submitForm()">

	<table width='100%' border=0 >
		<tr>
			<td class='tittab' width=5%>No</td>
			<td class='tittab' width=10%>Type</td>
			<td class='tittab' width=10%>Marque</td>
			<td class='tittab' width=35%>Couleur</td>
			<td class='tittab' width=10%></td>
			<td class='tittab' width=10%>Etat</td>
			<td class='tittab' width=10%>Actions</td>
		</tr>
		<tr>
			<td class="tittab" rowspan=3>
				<span style="font-size:2em" id="obj_numero"></span>
				<input type="hidden" name="obj_numero">
				<input type="hidden" name="obj_id">
				<input type="hidden" name="cli_id">
			</td>
			<td>
				<select name='obj_type' tabindex=2 disabled required >
				</select>
			</td>
			<td>
				<input type=text list="listMarques"  disabled  name="obj_marque_<?= $idRamdom ?>" size=30 maxlength="50" 
					tabindex=3 style="text-transform:uppercase" placeholder="Marque du vélo"  />
				<datalist id="listMarques"></datalist>
			</td>
			<td>
				<input type=text name="obj_couleur" size=20 maxlength="30" disabled tabindex=4
					style="text-transform:uppercase" placeholder="Couleurs dominantes"  />
			</td>
			<td>
			</td>
			<td id="obj_etat" rowspan=3 class="tittab" style="text-align:center;vertical-align:middle">
			</td>
			<td rowspan=3 class="tittab" style="text-align:center;vertical-align:middle">
				<button id="but_action" tabindex=<?= $tabindex+8 ?>
					onsubmit="this.form.action.value='new'" onclick="this.form.action.value='new'"></button>
				<input type="hidden" name="action" value="new">
				<button id="but_action2" tabindex=<?= $tabindex+9 ?>
					onsubmit="this.form.action.value='new2'" onclick="this.form.action.value='new2'"></button>
				<button id="but_actionAno" tabindex=<?= $tabindex+10 ?> class="error"
					onsubmit="this.form.action.value='newAno'" onclick="this.form.action.value='newAno'"></button>
				<input type="hidden" name="obj_etat">
				<input type="hidden" name="obj_etat_new">
				<input type="hidden" name="obj_etat_new2">
				<input type="hidden" name="obj_etat_newAno">
			</td>
		</tr>
		<tr>
			<td class='tittab' width=10%>Prix vente</td>
			<td class='tittab' width=55% colspan=3>Vendeur</td>
		</tr><tr>
			<td>
				<input type=number name="obj_prix_vente" disabled size=5 maxlength="10" tabindex=5
					title="Prix vente" required step="0.1" placeholder="00.00" min=1 />&nbsp;&#8364;
			</td>
			<!--<td>
				<input type=email name='cli_emel' disabled  tabindex=6 
					size="50" maxlength="100" 
					placeholder="E-mail"
					onblur='searchByMel(this.value)' list="listVendeur">
				<datalist id="listVendeur"></datalist>
			</td>-->
			<td colspan=2>
				<input type=text name='cli_nom_<?= $idRamdom ?>'disabled  tabindex=6
					placeholder="Nom et prénom"
					size="50" maxlength="100" required 
					onblur='searchByName(this.value)' list="listVendeurName">
				<datalist id="listVendeurName"></datalist>
			</td>
			<td>
				<input type=text name='cli_code_postal' 
					placeholder="Code postal"
					disabled  tabindex=<7 size="7" maxlength="5" >
			</td>
			
		</tr>
	</table>
</form>
<br/>
<table width='100%'>
	<tr>
		<td class='tittab' width=12%>Action</td>
		<td class='tittab' width=5%>No</td>
		<td class='tittab' width=10%>Type</td>
		<td class='tittab' width=10%>Prix vente</td>
		<td class='tittab' width=50%>Vendeur</td>
		<td class='tittab' width=10%>Etat</td>
		<td class='tittab' width=3%></td>
	</tr>
</table>
<div style="overflow-y: scroll; height: 50%; max-height: 30vw ">
<form name=formTabSaisie onSubmit='return false'>
	<table width='100%' id='tableFiches' >
		<?php for ($index = 1; $index < $maxFiche; $index++) { ?>
			<tr class='tabl0' id="tr_<?= $index ?>">
				<td width=13% id="action_<?= $index ?>"></td>
				<td width=5% id="numero_<?= $index ?>" onclick="x_return_oneFicheByCode('<?= $index ?>', display_fiche)"><span style="color: GREEN"><?= $index ?></span>
				</td>
				<td width=10% id="type_<?= $index ?>"></td>
				<td width=10% id="prix_vente_<?= $index ?>"></td>
				<td width=50% id="vendeur_<?= $index ?>"></td>
				<td width=10% id="etat_<?= $index ?>"></td>
				<td width=1% id="zoom_<?= $index ?>"></td>
			</tr>
		<?php } ?>
	</table>
</form>
</div>