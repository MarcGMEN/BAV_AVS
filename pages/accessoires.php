<script>

</script>
<script src="JS/accessoires.js"></script>

<h3>Gestion des accessoires.</h3>
 
<form action="#" name="searchFormAccessoire" onSubmit="return false;" >
	<div class="row">
		<div class="col-sm-2 col-xs-2 ">
			<input type="text" name="numeroFiche" size="6" maxlength="4" 
				title="Saisisez le numéro de fiche" placeholder="N° fiche" 
				id="inputSearch" 
				style='background-color:LIGHTGREEN;font-weight:bold' 
				tabindex=1 
				onblur="searchAccessoire(this.value)" 
				onsubmit="searchAccessoire(this.value)" />
				<i id="loupe" class="fas fa-search link " 
					onclick="searchAccessoire(document.searchFormFiche.numeroFiche.value)"></i>
		</div>
		<div class="col-sm-6 col-xs-6">
			<input type=text id='acc_commentaire' disabled placeholder="Votre Commentaire" tabindex=2 ></input>
		</div>
		<div class="col-sm-4 col-xs-4">
			<button id="acc_etat_prec" tabindex=3 class="navigation link" 
				style="display:'none'"
				onclick="cghtEtat(this.innerHTML,this.form.inputSearch.value)"></button>
			<button id="acc_etat_next" tabindex=4 class="navigation link" 
				style="display:'none'"
				onclick="cghtEtat(this.innerHTML,this.form.inputSearch.value)"></button>
			<button id="acc_etat" tabindex=5 class="navigation link error" 
				style="display:'none'"
				onclick="cghtEtat(this.innerHTML,this.form.inputSearch.value)"></button>
		</div>
	</div>
</form>