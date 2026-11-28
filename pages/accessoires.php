<script>

</script>
<script src="JS/accessoires.js"></script>

<h2>Gestion des accessoires.</h2>
 
<? if ($GET_modePage == "gestion") {?>
<form action="#" name="searchFormAccessoire" onSubmit="return false;" >
	<div class="row">
		<div class="col-sm-2 col-xs-12 ">
			<input type="hidden" name="acc_etat" id="acc_etat"  />
			<input type="text" name="numeroFiche" size="6" maxlength="4" 
				title="Saisisez le numéro de fiche" placeholder="N° fiche" 
				id="numFicAcc" 
				style='background-color:LIGHTGREEN;font-weight:bold' 
				tabindex=1 
				onblur="this.value!=''?searchAccessoire(this.value):''" 
				onsubmit="searchAccessoire(this.value); return false;" />
			<!-- <i id="loupe" class="fas fa-search link " 
				onclick="searchAccessoire(document.searchFormFiche.numeroFiche.value)"></i> -->
		</div>
		<div class="col-sm-5 col-xs-12">
			<input type=text 
				style='font-size:1.2em' 
				id='acc_commentaire' 
				maxlength="50"
				placeholder="Maximun 50 caractères"
				name='acc_commentaire' 
				disabled 
				placeholder="Votre Commentaire" 
				tabindex=2 ></input>
		</div>
		<div class="col-sm-5 col-xs-12">
			<!-- <button id="acc_etat_prec" 
				tabindex=3 
				class="navigation link" 
				style="display:none"
				onclick="cghtEtat(this.innerHTML,this.form.numFicAcc.value)"></button>-->
			&nbsp;<button id="acc_etat_next" 
				tabindex=4 
				class="SSMENU link" 
				style="display:none"
				onclick="cghtEtat(this.innerHTML,this.form.numFicAcc.value)"></button>
			&nbsp;<button  id="acc_modif" 
				tabindex=6 
				class="SSMENU link" 
				style="display:none"
				onclick="updateAcc(this.form.numFicAcc.value)">Modifier</button>
			&nbsp;<button id="acc_reset" 
				tabindex=7 
				class="SSMENU link" 
				style="display:none"
				onclick="initForm()">Reset</button>
		</div>
	</div>
</form>
<? } ?>
<div class="tabAction" >
	<div class="row">
		<div class="col-sm-6 col-xs-12 ">
			<span class="maskmobile">Voir les accessoires</span> [<span id="nbAcc"></span>]
		</div>
		<div class="col-sm-2 col-xs-4 ">
			Déposé<input type="checkbox" id='etat0' onclick='filtreSuivi()' />
		</div>
		<div class="col-sm-2 col-xs-4 ">
			A Restituer <input type="checkbox" id='etat1' onclick='filtreSuivi()' />
		</div>
		<div class="col-sm-2 col-xs-4 ">
			Restitué<input type="checkbox" id='etat2' onclick='filtreSuivi()' />
		</div>
	</div>
</div>
<div id="Accessoires"></div>