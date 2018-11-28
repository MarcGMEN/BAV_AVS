<script>
	function get_nb_fiches(val) {

	}
	function display_nbs(val) {
	}

	function initEntete() {
		x_return_infoAppli(display_paramBAV);
		//x_return_nb_fiches_par_etat(display_nbs);
	}

	var TABLE=null;
	var ADMIN=null;
	function display_paramBAV(val) {
		console.log(val);
		if (val instanceof Object) {
			getElement('titre').innerHTML=val['titre'];
			if (val['TABLE']=='OK') {
				getElement('theMenu').style.display='block';
				getElement('connex').innerHTML='TABLE';
				TABLE=true;
			}
			else if (val['ADMIN']=='OK') {
				getElement('theMenu').style.display='block';
				getElement('connex').innerHTML='ADMIN';
				ADMIN=true;
			}
			else {
				getElement('theMenu').style.display='none';
				ADMIN=false;
				TABLE=false;
			}
		}
		else {
			getElement('titre').innerHTML="Pas de BAV programme..";
			getElement('theMenu').style.display='none';
			TABLE=false;
		}
		console.log(TABLE);
		setParamVal(val);
	}

	function enteteSaisie() {
		getElement('deposer').disabled=startSaisie;
		getElement('inputSearch').disabled=startSaisie;
	}

	function search(laForm) {
		if (laForm.numeroFiche.value != "") {
			laForm.Action.value='fiche';
			alert("go to"+laForm.numeroFiche.value);
			laForm.submit();
		}
	}
	function goTo(page='accueil.php', modePage='', id=null,message='') {
		document.formNavigation.action='index.php';
		document.formNavigation.page.value=page
		document.formNavigation.modePage.value=modePage;
		document.formNavigation.message.value=message;
		document.formNavigation.id.value=id;
		document.formNavigation.submit();
	}
	

</script>
<form name=formNavigation method=post>
	<input type=hidden name=page value="">
	<input type=hidden name=modePage value="">
	<input type=hidden name=id value="">
	<input type=hidden name=message value="">
</form>
<table class="BH_CADRE" cellspacing="0" cellpadding="0" border="0" wifth="100%">
	<tr height="100%">
		<td width="5%">
			<A HREF="index.php">
				<img src="Images/cycleBAV.png" height='100px' />
			</A>
		</td>
		<td width="95%">
			<table width="100%" border=1>
				<tr>
					<td width="90%" colspan="2" class="TITRE_FENETRE_PRINCIPALE" id=titre>
					</td>
					<td width="10%">
						<span style="float: left; display:none" id="theMenu">
							<i class="fas fa-bars fa-3x" onclick="inverseDisplay('divMenu')" ></i>
							<div style="position:absolute; display:none" id='divMenu'>
								<div class="MENU">
									<div style='text-algin: center'>Menu</div>
									<hr />
									<div class="link" onclick='goTo("parametre.php")'>Parametres</A></div>

								</div>
							</div>
						</span>
						<span style="float: right" title="[<?=$_SERVER['REMOTE_ADDR']?>]"><?=$_COOKIE['NUMERO_BAV']?>
						<div id="connex" ></div>
						</span>
					</td>
				</tr>
				<tr>
					
					<?php $tail = (int) 100 / 3;?>
					<td width="80%" colspan=2>
						<table width="100%">
							<tr>
								<td width="<?=$tail?>%">
									<!-- fiche etat cofirme -->
									A valider : <span id="confirme">...</span>
								</td>
								<td width="<?=$tail?>%">
									<!-- fiche etat valide -->
									Depot : <span id="valide">...</span>
								</td>
								<td width="<?=$tail?>%">
									Vendu : <span id="vendu">...</span>
									<small><span id="statVendu">...</span></small>
								</td>
							</tr>
						</table>
					</td>
					<td width="20%" rowspan="2">
							<table width="100%">
								<tr>
									<td width="40%">
										<div onclick='goTo("fiche.php","create");'
										 title="Remplir la fiche de dépot">
											<button height="100%" id="deposer">
												<span class="fas fa-plus-square"></span>&nbsp;Deposer<br />
											</button>
										</div>
									</td>
									<td width="60%">
										<table>
											<tr>
												<td align="center">
													<small>Recherche</small><br />
													<input type="text" name="numeroFiche" size="15" 
														maxlength="50" 
													title="Saisisez le numéro de fiche, ou l'identifiant de la fiche"
														 placeholder="Saisisez le numéro ou l'identifiant de la fiche." 
														 onchange="search(this.form)" id="inputSearch" />
												</td>
												<td align="center">
													<i class="fas fa-search link" 
														onclick="search(document.enteteFormFiche)"></i>
												</td>
											</tr>
										</table>

									</td>
								</tr>
							</table>
					</td>
				</tr>
				<tr>
					<td colspan=2>
						<table width="100%">
							<tr>
								<td width="<?=$tail?>%">
									<!-- fiche etat modif prix -->
									Modif prix : <A href="index.php?page=modif" method="POST">
											<span id="modifPrix">...</span></A>
								</td>
								<td width="<?=$tail?>%">
									<!-- fiche etat valide - vendu - retour -->
									Stock : <span id="stock">...</span>
								</td>
								<td width="<?=$tail?>%">
									Retour : <span id="retour">...</span>
									&nbsp;&nbsp;<small><span id="statRetour">...</span></small>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>