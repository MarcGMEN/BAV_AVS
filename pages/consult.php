<script>
	var idFiche = '<?= $GET_id ?>';
	var modePage = '<?= $GET_modePage ?>';

	function initPage() {
		if (idFiche) {
			x_return_oneFiche(idFiche, display_fiche);
		} else {
			goTo();
		}
	}

	function display_fiche(val) {
		if (val instanceof Object) {
			//console.log(val);
			if (val['obj_etat'] == "CONFIRME") {
				val['obj_prix_vente'] = val['obj_prix_depot'];
			}
			val['etat_str'] = val['obj_etat'];
			if (val['obj_etat'] == "STOCK") {
				val['etat_str'] = "<div class='alert alert-danger' style='font-size:20px'>Pas encore vendu</div>";
			}
			if (val['obj_etat'] == "VENDU" || val['obj_etat'] == "PAYE") {
				val['etat_str'] = "<div class='alert alert-success' style='font-size:20px'>Vendu le "+val['obj_date_vente']+"</div>";
			}
			if (val['obj_etat'] == "RENDU") {
				val['etat_str'] = "<div class='alert alert-success' style='font-size:20px'>Récupérer</div>";
			}

			if (modePage == "Etiquette") {
				var j = 0;
			} else {
				display_getFicheVente(val);
			}
			display_formulaire(val);
		}
	}

	function unloadPage() {}
</script>
<fieldset class=fiche>
	<div class="row tittab" id='trTitreFiche'>
		<div class="col-sm-4 col-md-4 col-xs-4">
			<span class="titrow col-md-3 col-sm-3 col-xs-3" width=20%>No</span>
			<span class="tabl1 col-md-9 col-sm-9 col-xs-9">
				<span style='font-size: 2em;' id='obj_numero'></span>
			</span>
		</div>
		<div class="col-sm-8 col-md-8 col-xs-8">
			<div class="col-sm-12 col-md-12 col-xs-12 tabl1">
				<span id="etat_str"></span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12">
			<span class="titrow col-md-3 col-sm-3 col-xs-3" width=20%>Déposé le</span>
			<span class="tabInput col-md-9 col-sm-9 col-xs-9">
				<span id='obj_date_depot'></span>
			</span>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12">
			<span class="titrow col-md-3 col-sm-3 col-xs-3" width=20%>Type</span>
			<span class="tabInput col-md-9 col-sm-9 col-xs-9">
				<span id='obj_type'></span>
			</span>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12">
			<span class="titrow  col-md-3 col-sm-3 col-xs-3">Public</span>
			<span class="tabInput col-md-9 col-sm-9 col-xs-9">
				<span id='obj_public'></span>
			</span>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12">
			<span class="titrow col-md-3 col-sm-3 col-xs-3">Pratique</span>
			<span class="tabInput col-md-9 col-sm-9 col-xs-9">
				<span id='obj_pratique'></span>
			</span>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12">
			<span class="titrow  col-md-3 col-sm-3 col-xs-3">Marque</span>
			<span class="tabInput col-md-9 col-sm-9 col-xs-9">
				<span id='obj_marque'></span>
			</span>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12">
			<span class="titrow  col-md-3 col-sm-3 col-xs-3">Mod&egrave;le</span>
			<span class="tabInput col-md-9 col-sm-9 col-xs-9">
				<span id='obj_modele'></span>
			</span>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12">
			<span class="titrow  col-md-3 col-sm-3 col-xs-3">Couleur</span>
			<span class="tabInput col-md-9 col-sm-9 col-xs-9">
				<span id='obj_couleur'></span>
			</span>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12">
			<span class="titrow  col-md-3 col-sm-3 col-xs-3">Date d'achat</span>
			<span class="tabInput col-md-9 col-sm-9 col-xs-9">
				<span id='obj_date_achat'></span>
			</span>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12">
			<span class="titrow  col-md-3 col-sm-3 col-xs-3">Prix d'achat</span>
			<span class="tabInput col-md-9 col-sm-9 col-xs-9">
				<span id='obj_prix_achat'></span>
			</span>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12">
			<span class="titrow  col-md-3 col-sm-3 col-xs-3">Taille</span>
			<span class="tabInput col-md-9 col-sm-9 col-xs-9">
				<span id='obj_taille'></span>
			</span>
		</div>

		<div class="col-sm-6 col-md-6 col-xs-12">
			<span class="titrow col-md-2 col-sm-2 col-xs-3">Description</span>
			<span class="tabInput col-md-10 col-sm-10 col-xs-9">
				<span id='obj_description'></span>
			</span>
			<span class="col-md-12 col-sm-12 col-xs-12 help">
				<div id="aide_descript" style="visibility: hidden;">
					<small>Année d'achat, prix d'achat, taille, accessoires, révision (transmission, pneus, freins..)</small>
				</div>
			</span>
		</div>
		<div class="col-sm-6 col-md-6 col-xs-12">
			<span class="titrow col-md-2 col-sm-2 col-xs-3">Accessoires
			</span>
			<span class="tabInput col-md-10 col-sm-10 col-xs-9">
				<span id='obj_accessoire'></span>
			</span>
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12">
			<span class="titrow  col-md-3 col-sm-3 col-xs-3">PRIX :</span>
			<span class="tabl1 col-md-9 col-sm-9 col-xs-9">
				<input type=hidden name="obj_prix_vente">
				&nbsp&nbsp<span id="obj_prix_vente">0.00</span>&euro;&nbsp
				<span id="date_vente"></span>
		</div>
	</div>
</fieldset>