<? $idRamdom = rand(1000, 9999); ?>
<script>
	var idClient = '<?= $GET_id ?>';
	// pour rendre le champ nom du client unique

	var idRamdom = "<?= $idRamdom ?>";
	var modePage = '<?= $GET_modePage ?>';
	var anneeBav = '<?= $infAppli['numero_bav'] ?>';
</script>

<script src="JS/clientV2.js" type="text/javascript"></script>

<h3 class="titreFiche">Votre compte</h3>
<!-- <div id=lesFiches style="visibility: hidden;" />-->
<div class="alert alert-info">
	<fieldset class=client>
		<legend class=titreFiche>Vos Coordonnées</legend>
		<form name="clientForm" method="POST" action="#" onsubmit="return submitFormClient(this)">
			<input type=hidden name=cli_id />
			<input type=hidden name=cli_id_modif />
			<div class="row">
				<div class="col-sm-6 col-md-6 col-xs-6">
					<span class="titrow col-md-3 col-sm-3 col-xs-6">Emel</span>
					<span class="tabInput col-md-9 col-sm-12 col-xs-12">
						<span id='cli_emel'></span>
					</span>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-6">
					<span class="titrow  col-md-3 col-sm-3 col-xs-6">Nom/prénom <span title="Obligatoire">*</span></span>
					<span class="tabInput col-md-9 col-sm-9 col-xs-12">
						<? if ($GET_modePage != 'modif') { ?>
							<span id='cli_nom'></span>
						<? } else { ?>
							<input type=text name='cli_nom' tabindex=<?= $tabindex++ ?> size="50" maxlength="100" required onkeyup="setStartSaisie(true);" />
						<? } ?>
					</span>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-6">
					<span class="titrow  col-md-3 col-sm-3 col-xs-6">Adresse</span>
					<span class="tabInput col-md-9 col-sm-9 col-xs-12">
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
							<input type=text name="cli_ville" size=40 maxlength='100' tabindex=<?= $tabindex++ ?> placeholder="Ville" onkeyup="setStartSaisie(true)" />
						<? } ?>
					</span>
				</div>
				<!--<div class="col-sm-6 col-md-6 col-xs-6">
				<div id="map">&nbsp;
				</div>
			</div>-->
				<div class="col-sm-6 col-md-6 col-xs-6">
					<span class="titrow  col-md-3 col-sm-3 col-xs-6">Téléphone</span>
					<span class="tabInput col-md-9 col-sm-9 col-xs-12">
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
			<br />
			<? if ($GET_modePage == 'modif') { ?>
				<div class="row fiche">
					<div class="col-sm-6 col-md-6 col-xs-6 btnAction" id="tdBtnAction">
						<input type='submit' name="buttonValideFiche" value="Enregistrer" tabindex=<?= $tabindex++ ?> disabled>
						</button>
					</div>
					<div class="col-sm-6 col-md-6 col-xs-3 btnAction">
						<input type=button value="Annuler" onclick='goToPOST("clientV2.php","",this.form.cli_id_modif.value,"")' tabindex=<?= $tabindex++ ?>>
					</div>
				</div>
			<? } else { ?>
				<div class="row fiche">
					<div class="col-sm-12 col-md-12 col-xs-12 btnAction" id="tdBtnAction">
						<button name="buttonValideFiche" tabindex=<?= $tabindex++ ?> onclick='goToPOST("clientV2.php","modif",this.form.cli_id_modif.value,"")'>Modifier</button>
					</div>
				</div>
			<? } ?>
		</form>
	</fieldset>
</div>

<div class="row">
	<div class="col-sm-12 col-md-12 col-xs-12 alert alert-info maskMobile" id='aideImpression' style="display:none;"> 
		<h5><b>⚠ N'oubliez pas d'imprimer votre fiche de dépôt avant de venir en cliquant sur l'icone :📇</b></h5>
	</div>
</div>
<table width="100%" >
	<tr>
		<td class="tittab" width=7%>
			<span id='tri_numero' onclick="triColonne('obj_numero')" class="sortable">No&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td class="maskmobile tittab" width=10%>
			<span id='tri_type' onclick="triColonne('obj_type')" class="sortable">Type&nbsp;&nbsp;&nbsp;</span>
			&nbsp;
		</td>
		<td class="maskmobile tittab" width=10%>
			<span id='tri_public' onclick="triColonne('obj_public')" class="sortable">Public&nbsp;&nbsp;&nbsp;</span>
			&nbsp;
		</td>
		<td class="tittab" width=30%>
			<span id='tri_marque' onclick="triColonne('obj_marque')" class="sortable">Marque&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td class="maskmobile tittab" width=10%>
			<span id='tri_couleur' onclick="triColonne('obj_couleur')" class="sortable">Couleur&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td class="tittab" width=10%>
			<span class="sortable" id='tri_prix_vente' onclick="triColonne('obj_prix_vente')">
				Prix&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td class="tittab" width=12%>
			<span id='tri_etat' onclick="triColonne('obj_etat')" class="sortable">Etat&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td class="tittab" >
			Actions</span>
		</td>
	</tr>
</table>
<div class="row">
	<div class="col-sm-12 col-md-12 col-xs-12">
		<div class="col-sm-4 col-md-4 col-xs-4">
			<h3>Vos dépôts</h3>
		</div>
		<div class="col-sm-8 col-md-8 col-xs-8">
			<!-- Pas d'accès avec la BAV en cours -->
			<!-- fin CLIENT a 17h -->
			<? if ($infAppli['CLIENT'] == 1 || $infAppli['ADMIN'] == 1 || $GET_modePage == "createTEST") { ?>
				<h3><input type=button value="Ajouter un dépôt ➕" onclick="addDepot(document.clientForm.cli_id_modif.value)" /></h3>
			<? } ?>
		<!-- </div>
		<div class="col-sm-6 col-md-6 col-xs-0 alert alert-info maskMobile" id='aideImpression' style="display:none;"> 
			<h5><b>⚠ N'oubliez pas d'imprimer votre fiche de dépôt avant de venir en cliquant sur l'icone :📇</b></h5>
		</div> -->
		</div>
	</div>
</div>
<div id=fiches></div>
<!-- uniquement dans les dates de la bav -->
<div class="row">
	<div class="col-sm-12 col-md-12 col-xs-12">
		<div class="col-sm-4 col-md-4 col-xs-4">
			<h3>Vos achats</h3>
		</div>
		<div class="col-sm-8 col-md-8 col-xs-8">
			&nbsp;
		</div>
	</div>
</div>
<div id=fichesA></div>