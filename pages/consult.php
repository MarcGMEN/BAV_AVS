<script>
	var idFiche = '<?=$GET_id?>';
	function initPage() {
		if (idFiche) {
       		x_return_oneFiche(idFiche, display_fiche);
    	} else {
            goTo();
    	}
	}
	function display_fiche(val) {
        if (val instanceof Object) {
            console.log(val);
            display_formulaire(val);
        }
	}
	
	function unloadPage() {}

</script>
<fieldset class=fiche>
	<div class="row tittab" id='trTitreFiche' >
		<div class="col-sm-4 col-md-4 col-xs-4">
			<span class="titrow col-md-3 col-sm-3 col-xs-3" width=20%>No</span>
			<span class="tabl1 col-md-9 col-sm-9 col-xs-9">
				<span id='obj_numero'></span>
			</span>
		</div>
		<div class="col-sm-4 col-md-4 col-xs-4">
			<div class="col-sm-6 col-md-6 col-xs-6 tabl1">
				<span id="obj_etat"></span>
			</div>
		</div>
	</div>

	<div class="row">
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
			<span class="titrow  col-md-3 col-sm-3 col-xs-3">Modele</span>
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
		<!-- vue uniqueTABLE -->
		<div class="col-sm-4 col-md-4 col-xs-4">
			<span class="titrow  col-md-3 col-sm-3 col-xs-12">PRIX :</span>
			<span class="tabl1 col-md-9 col-sm-9 col-xs-12">
				<input type=hidden name="obj_prix_vente">
				&nbsp&nbsp<span id="obj_prix_vente">0.00</span>&#8364;&nbsp <span id="date_vente">
				</span>
		</div>
	</div>
</fieldset>