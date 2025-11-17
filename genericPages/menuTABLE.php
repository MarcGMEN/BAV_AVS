<div class="row" style="background-color: #0cd;font-size:1.1em">
	<div class="col-md-12">
		<div class="col-md-3 col-sm-3 col-xs-12" >
			<div class="col-md-4 col-sm-4 col-xs-4" style="text-align:right">Pré-depot</div>
			<div class="col-md-2 col-sm-2 col-xs-2">
				<!-- fiche etat cofirme -->
				<span id="e_CONFIRME" class='link' onclick='goTo("stock.php","obj_etat","CONFIRME",null)' style='font-weight: bold'>...</span>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3">
				<div id=countModifData title="Nb de d'etiquette à imprimer"></div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3">
				<div id=countModifVendeur title="Nb de coupons dépot à imprimer"></div>
			</div>
			<!-- <div class="col-md-3 col-sm-3 col-xs-2" style="text-align:right">Init</div>
			<div class="col-md-9 col-sm-9 col-xs-4">
				<span id="INIT" class='link' onclick='goTo("stock.php","obj_etat","INIT",null)' style='font-weight: bold'>...</span>
			</div> -->
		</div>

		<div class="col-md-3 col-sm-3 col-xs-12">
			<div class="col-md-4 col-sm-4 col-xs-4" style="text-align:right">Stock</div>
			<div class="col-md-2 col-sm-2 col-xs-2">
				<!-- fiche etat cofirme -->
				<span id="e_STOCK" class='link' onclick='goTo("stock.php","obj_etat","STOCK",null)' style='font-weight: bold'>...</span>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6">
				<span id=countModifStock title="Nb de coupons sortie à imprimer"></span>
			</div>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<div class="col-md-4 col-sm-4 col-xs-4" style="text-align:right">Total</div>
			<div class="col-md-8 col-sm-8 col-xs-8">
				<!-- fiche etat valide -->
				<span id="e_TOTAL" style='font-weight: bold'>...</span>
			</div>
		</div>

		<div class="col-md-2 col-sm-2 col-xs-12">
			<div class="col-md-4 col-sm-4 col-xs-4" style="text-align:right">Vendu</div>
			<div class="col-md-2 col-sm-2 col-xs-2">
				<!-- fiche etat cofirme -->
				<span id="e_VENDU" class='link' onclick='goTo("stock.php","obj_etat","VENDU",null)' style='font-weight: bold'>...</span>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6">
				<small><span id="statVendu">...</span></small>
				<small><span title="Payé" class="PAYE link" id="PAYE" onclick='goTo("stock.php","obj_etat","PAYE",null)'></span></small>
			</div>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<div class="col-md-4 col-sm-4 col-xs-4" style="text-align:right">Rendu</div>
			<div class="col-md-8 col-sm-8 col-xs-8">
				<span id="e_RENDU" class='link' onclick='goTo("stock.php","obj_etat","RENDU",null)' style='font-weight: bold'>...</span>
				<small><span id="statRendu">...</span></small>
			</div>
		</div>
	</div>
</div>