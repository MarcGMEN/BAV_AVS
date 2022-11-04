<div class="row">
	<div class="col-md-12">
		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:right">Confirm</div>
			<div class="col-md-10 col-sm-10 col-xs-4">
				<!-- fiche etat cofirme -->
				<span id="CONFIRME" class='link' onclick='goTo("stock.php","obj_etat","CONFIRME",null)' style='font-weight: bold'>...</span>
				<span id=countModifData title="Nb de d'etiquette à imprimer"></span>
				<span id=countModifVendeur title="Nb de coupons dépot à imprimer"></span>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:right">Init</div>
			<div class="col-md-10 col-sm-10 col-xs-4">
				<span id="INIT" class='link' onclick='goTo("stock.php","obj_etat","INIT",null)' style='font-weight: bold'>...</span>
			</div>
		</div>

		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:right">Stock</div>
			<div class="col-md-10 col-sm-10 col-xs-4">
				<span id="STOCK" class='link' onclick='goTo("stock.php","obj_etat","STOCK",null)' style='font-weight: bold'>...</span>
				<span id=countModifStock title="Nb de coupons sortie à imprimer"></span>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:right">Total</div>
			<div class="col-md-10 col-sm-10 col-xs-4">
				<!-- fiche etat valide -->
				<span id="TOTAL" style='font-weight: bold'>...</span>
			</div>
		</div>

		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:right">Vendu</div>
			<div class="col-md-10 col-sm-10 col-xs-4">
				<span id="VENDU" class='link' onclick='goTo("stock.php","obj_etat","VENDU",null)' style='font-weight: bold'>...</span>
				<small><span id="statVendu">...</span></small>
				<small><span title="Payé" class="PAYE link" id="PAYE" onclick='goTo("stock.php","obj_etat","PAYE",null)'></span></small>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:right">Rendu</div>
			<div class="col-md-10 col-sm-10 col-xs-4">
				<span id="RENDU" class='link' onclick='goTo("stock.php","obj_etat","RENDU",null)' style='font-weight: bold'>...</span>
				<small><span id="statRendu">...</span></small>
			</div>
		</div>
	</div>
</div>