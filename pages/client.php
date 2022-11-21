<? $idRamdom = rand(1000, 9999); ?>
<? if ($infAppli['ADMIN']) {
	$GET_modePage = "modif";
} ?>
<script>
	var idClient = '<?= $GET_id ?>';
	// pour rendre le champ nom du client unique

	var idRamdom = "<?= $idRamdom ?>";
	var modePage = '<?= $GET_modePage ?>';
	var anneeBav='<?=$infAppli['numero_bav']?>';
</script>
<style type="text/css">
		#map {
			/* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
			height: 200px;
		}
	</style>

<script src="JS/client.js" type="text/javascript"></script>

<!-- <div id=lesFiches style="visibility: hidden;" />-->
<fieldset class=client>
	<legend class=titreFiche>Le client</legend>
	<form name="clientForm" method="POST" action="#" onsubmit="return submitForm(this)">
		<input type=hidden name=cli_id />
		<div class="row">
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Id</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<span id='cli_id_modif'></span>
				</span>
			</div>
			<div class="row">
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Emel <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<? if ($GET_modePage != 'modif') { ?>
						<span id='cli_emel'></span>
					<? } else { ?>
						<input type=email name='cli_emel' id="cli_emel" size="50" maxlength="100" 
							tabindex=<?= $tabindex++ ?> placeholder="aaaa.bbbb@ccc.dd" 
							onkeyup="setStartSaisie(true);" 
							onblur='searchByMel(this.value)' />
					<? } ?>
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Nom/prenom <span title="Obligatoire">*</span></span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<? if ($GET_modePage != 'modif') { ?>
						<span id='cli_nom'></span>
					<? } else { ?>
						<input type=text name='cli_nom' tabindex=<?= $tabindex++ ?> size="50" maxlength="100" required 
						onkeyup="setStartSaisie(true);" 
						onblur='searchByName(this.value)' />
					<? } ?>
				</span>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Adresse</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<? if ($GET_modePage != 'modif') { ?>
						<div id='cli_adresse'></div>
						<div id='cli_adresse1'></div>
						<div id='cli_code_postal'></div>
						<div id='cli_ville'></div>
					<? } else { ?>
						<input type=text name="cli_adresse" size=50 maxlength='100' tabindex=<?= $tabindex++ ?> placeholder="Adresse" onkeyup="setStartSaisie(true);" />
						<br />
						<input type=text name="cli_adresse1" size=50 maxlength='100' tabindex=<?= $tabindex++ ?> placeholder="Complement adresse" onkeyup="setStartSaisie(true);" />
						<br />
						<input type=text name="cli_code_postal" size=5 maxlength='10' tabindex=<?= $tabindex++ ?> placeholder="Code postal" onkeyup="setStartSaisie(true);" />
						<input type=text name="cli_ville" size=40 maxlength='100' tabindex=<?= $tabindex++ ?> placeholder="Ville" />
					<? } ?>
				</span>
			</div>
			<!--<div class="col-sm-6 col-md-6 col-xs-6">
				<div id="map">&nbsp;
				</div>
			</div>-->
			<div class="col-sm-6 col-md-6 col-xs-12">
				<span class="titrow  col-md-3 col-sm-3 col-xs-3">Telephone</span>
				<span class="tabInput col-md-9 col-sm-9 col-xs-9">
					<? if ($GET_modePage != 'modif') { ?>
						<div id='cli_telephone'></div>
						<div id='cli_telephone_bis'></div>
					<? } else { ?>
						<input type=text name='cli_telephone' size="15" maxlength="15" tabindex=<?= $tabindex++ ?> placeholder="Pour vous joindre durant la bourse" onkeyup="setStartSaisie(true);" title="Pour vous joindre durant la bourse" />
						<input type=text name='cli_telephone_bis' size="15" maxlength="15" tabindex=<?= $tabindex++ ?> placeholder="autre numéro" onkeyup="setStartSaisie(true);" title="autre numéro" />
					<? } ?>
				</span>
			</div>

		</div>
		<? if ($infAppli['ADMIN']) { ?>
			<div class="row">
				<!-- TODO : juste -->
				<div class="col-sm-6 col-md-6 col-xs-12">
					<span class="titrow  col-md-3 col-sm-3 col-xs-3">Taux commission</span>
					<span class="tabInput col-md-9 col-sm-9 col-xs-9">
						<? if ($GET_modePage != 'modif') { ?>
							<span id='cli_taux_com'></span>%
						<? } else { ?>
							<select name='cli_taux_com' tabindex=<?= $tabindex++ ?> onchange="setStartSaisie(true);"></select>%
						<? } ?>
					</span>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-12">
					<span class="titrow  col-md-3 col-sm-3 col-xs-3">Tarif Depot</span>
					<span class="tabInput col-md-9 col-sm-9 col-xs-9">
						<? if ($GET_modePage != 'modif') { ?>
							<span id='cli_prix_depot'></span>€
						<? } else { ?>
							<select name='cli_prix_depot' tabindex=<?= $tabindex++ ?> onchange="setStartSaisie(true);"></select>&#8364;
						<? } ?>
					</span>
				</div>
			</div>
		<? } ?>
		<br />
		<? if ($GET_modePage == 'modif') { ?>
			<div class="row fiche">
				<div class="col-sm-3 col-md-3 col-xs-3 btnAction" id="tdBtnAction">
					<button name="buttonValideFiche" tabindex=<?= $tabindex++ ?> disabled>Enregistrer
					</button>
				</div>
				<div class="col-sm-3 col-md-3 col-xs-3 btnAction">
					<input type=button value="Annuler" onclick="fermerCRUD()" tabindex=<?= $tabindex++ ?>>
				</div>
				<div class="col-sm-3 col-md-3 col-xs-3 btnAction" id="tdBtnSup">
					<input type=button value="Supprimer" name="buttonSupprimeFiche" onclick="supprimerClient(this.form.cli_id.value)" tabindex=<?= $tabindex++ ?> />
				</div>
				<? if ($infAppli['ADMIN']) { ?>
				<div class="col-sm-3 col-md-3 col-xs-3 btnAction" id="tdBtnFeuille">
					<input type=button value="Feuille commissions" name="buttonFeuilleFiche" onclick="fichesClient(this.form.cli_id.value)" tabindex=<?= $tabindex++ ?> />
				</div>
				<?}?>
			</div>
		<? } ?>
	</form>
</fieldset>
<? if ($infAppli['ADMIN']) { ?>
	<select id="annee_stat" onchange="changeNumeroBAV(this.value)"></select>
	<table width="100%" class="alert alert-info">
		<tr>
			<td width=12%>
				Nb
			</td>
			<td width=22%>Total</td>
			<td width=22%>Stock</td>
			<td width=22%>Vendu</td>
			<td width=22%>Paye</td>
		</tr>
		<tr>
			<td>
				<span id=totalfiches></span>
			</td>
			<td><b><span id=total_vente_depot>0.00</span> €</b></td>
			<td><b><span id=total_vente_stock>0.00</span> €</b></td>
			<td><b><span id=total_vente_vendu>0.00</span> €</b></td>
			<td><b><span id=total_vente_paye>0.00</span> €</b></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Dépôt </td>
			<td>Com en attente </td>
			<td>Com recu </td>

		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><b><span id=total_depot>0.00</span> €</b></td>
			<td><b><span id=total_com_vendu>0.00</span> €</b></td>
			<td><b><span id=total_com_paye>0.00</span> €</b></td>

		</tr>
	</table>
<? } ?>
<table width="100%">
	<tr>
		<td class="tittab" width=10%>
			<span id='obj_numero' onclick="triColonne('obj_numero')" class="sortable">No&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td class="maskmobile tittab" width=20%>
			<span id='obj_type' onclick="triColonne('obj_type')" class="sortable">Type&nbsp;&nbsp;&nbsp;</span>
			&nbsp;
		</td>
		<td class="maskmobile tittab" width=20%>
			<span id='obj_public' onclick="triColonne('obj_public')" class="sortable">Public&nbsp;&nbsp;&nbsp;</span>
			&nbsp;
		</td>
		<td class="tittab" width=30%>
			<span id='obj_marque' onclick="triColonne('obj_marque')" class="sortable">Marque&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td class="tittab" width=10%>
			<span class="sortable" id='obj_prix_vente' onclick="triColonne('obj_prix_vente')">
				Prix&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td class="tittab" width=10%>
			<span id='obj_etat' onclick="triColonne('obj_etat')" class="sortable">Etat&nbsp;&nbsp;&nbsp;</span>
		</td>
	</tr>
</table>
<h3>Ventes</h3>
<div id=fiches></div>
<hr />
<h3>Achats [nb : <span id=totalfichesA></span>]</h3>
<div id=fichesA></div>