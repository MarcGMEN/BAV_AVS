<div class="row" style="background-color: lightgreen;font-size:1.1em">
	<div class="col-md-12  col-menuTable">
		<div class="col-md-3 col-sm-3 col-xs-12  col-menuTable" >
			<div class="col-md-3 col-sm-3 col-xs-3 col-menuTableEtat">Dépôt</div>
			<div class="col-md-3 col-sm-3 col-xs-3 col-menuTable">
				<!-- fiche etat cofirme -->
				<span id="e_CONFIRME" class='link' onclick='goTo("stock.php","obj_etat","CONFIRME",null)' style='font-weight: bold'>...</span>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3 col-menuTable">
				<div id=countModifData title="Nb de d'etiquette à imprimer"></div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3 col-menuTable" >
				<div id=countModifVendeur title="Nb de coupons dépot à imprimer"></div>
			</div>
			<!-- <div class="col-md-3 col-sm-3 col-xs-2" style="text-align:right">Init</div>
			<div class="col-md-9 col-sm-9 col-xs-4">
				<span id="INIT" class='link' onclick='goTo("stock.php","obj_etat","INIT",null)' style='font-weight: bold'>...</span>
			</div> -->
		</div>

		<div class="col-md-3 col-sm-3 col-xs-12 col-menuTable">
			<div class="col-md-3 col-sm-3 col-xs-3 col-menuTableEtat" >Stock</div>
			<div class="col-md-3 col-sm-3 col-xs-3 col-menuTable">
				<!-- fiche etat cofirme -->
				<span id="e_STOCK" class='link' onclick='goTo("stock.php","obj_etat","STOCK",null)' style='font-weight: bold'>...</span>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3 col-menuTable" >
				<div id=countModifStock title="Nb de coupons sortie à imprimer"></div>
			</div>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12 col-menuTable">
			<div class="col-md-3 col-sm-3 col-xs-3 col-menuTableEtat" >Vendu</div>
			<div class="col-md-3 col-sm-3 col-xs-3 col-menuTable">
				<!-- fiche etat cofirme -->
				<span id="e_VENDU" class='link' onclick='goTo("stock.php","obj_etat","VENDU",null)' style='font-weight: bold'>...</span>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6 col-menuTable">
				<div><span id="statVendu">...</span>
				<small><span title="Payé" class="PAYE link" id="e_PAYE" onclick='goTo("stock.php","obj_etat","PAYE",null)'>Payé
				</span></small></div>
			</div>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12 col-menuTable">
			<div class="col-md-6 col-sm-6 col-xs-6 col-menuTableEtat" >Rendu</div>
			<div class="col-md-6 col-sm-6 col-xs-6 col-menuTable">
				<span id="e_RENDU" class='link' onclick='goTo("stock.php","obj_etat","RENDU",null)' style='font-weight: bold'>...</span>
				<small><span id="statRendu">...</span></small>
			</div>
		</div>
		<div class="col-md-1 col-sm-1 col-xs-12 col-menuTable">
			<div class="col-md-6 col-sm-6 col-xs-6 col-menuTableEtat" >Total</div>
			<div class="col-md-6 col-sm-6 col-xs-6 col-menuTable">
				<!-- fiche etat valide -->
				<span id="e_TOTAL" style='font-weight: bold'>...</span>
			</div>
		</div>

	</div>
</div>