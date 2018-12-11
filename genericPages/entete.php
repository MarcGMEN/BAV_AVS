<script>
	function get_nb_fiches(val) {

	}
	function display_nbs(val) {
	}

	function initEntete() {
		x_return_infoAppli(display_paramBAV);
        x_return_countByEtat(display_counter);
	}

	var TABLE=null;
	var ADMIN=null;
	var CLIENT=null;
	function display_paramBAV(val) {
		console.log(val);
		console.log(modePage);
		if (val instanceof Object) {
			CLIENT=val['CLIENT'];
			TABLE=val['TABLE'];
			ADMIN=val['ADMIN'];

				getElement('titre').innerHTML=val['titre'];
				if (TABLE || ADMIN) {
					getElement('theMenu').style.display='block';
					getElement('connex').innerHTML=TABLE ? 'TABLE' : 'ADMIN';
					getElement('tabSearch').style.display='table';
				}
				else {
					getElement('theMenu').style.display='none';
					if (CLIENT) {
						getElement('tabSearch').style.display='table';
					}
				}
			
		}
		else {
			getElement('titre').innerHTML="Pas de BAV programme..";
			getElement('theMenu').style.display='none';
		}
		
		console.log("CLIENT:"+CLIENT+" TABLE:"+TABLE+" ADMIN:"+ADMIN+"");
		setParamVal(val);
	}

	function display_counter(val) {
		if (val instanceof Object) {
			for (key in val) {
				getElement(key).innerHTML=val[key];
			}
		}
		getElement("depotTOT").innerHTML=parseInt(val['STOCK'])+parseInt(val['VENDU'])+parseInt(val['RENDU']);
		
	}

	function enteteSaisie() {
		getElement('deposer').disabled=startSaisie;
		getElement('inputSearch').disabled=startSaisie;
	}

	function search(value) {
        console.log(value.length);
		console.log(!isNaN(Number(value)));
		if (!isNaN(Number(value)) && value < 9999) {
			console.log("consult fiche");
            x_return_oneFicheByCode(value, display_getFicheConsult);
		}
		else if (value.length == 5) {
			console.log("modif fiche "+value);
			x_return_oneFicheByIdModif(value, display_getFicheModif);
		}
		else if (value.length == 8) {
			console.log("consule client "+value);
			//x_return_fichesFromClient(value, display_getFiche);
		}
		else {
            alertModalWarnTimeout("Format incorrect (N° fiche, code fiche, code client)",2);
		}
		// si numerique < 10000 alors fiche en consult
		// si 5 caracteres => modif fiche
		// si 8 caracteres => consult client
	}

	function display_getFicheConsult(val) {
		if (val instanceof Object) {
			if (TABLE || ADMIN) {
				goTo("fiche.php","modif",val['obj_id']);
			}
			else if (val['obj_numero'] < 5000) {
				goTo("consult.php","consult",val['obj_id']);
			}
			else {
				alertModalWarnTimeout("Format incorrect (N° fiche, code fiche, code client)",2);
			}
		}
		else {
			alertModalWarnTimeout("Fiche inconnue",2);
		}
	}

	function display_getFicheModif(val) {
		if (val instanceof Object) {
			goTo("fiche.php","modif",val['obj_id']);
		}
		else {
			alertModalWarnTimeout("Fiche inconnue",2);
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
			<span id="depotTOT"></span>
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
							<i class="fas fa-bars fa-3x" onclick="inverseDisplay('divMenu')"></i>
							<div style="position:absolute; display:none" id='divMenu'>
								<div class="MENU">
									<div style='text-algin: center'>Menu</div>
									<hr />
									<div class="link" onclick='goTo("parametre.php")'>Parametres</A></div>

								</div>
							</div>
						</span>
						<span style="float: right" title="[<?=$_SERVER['REMOTE_ADDR']?>]"><?=$_COOKIE['NUMERO_BAV']?>
							<div id="connex"></div>
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
									A valider : <span id="CONFIRME">...</span>
								</td>
								<td width="<?=$tail?>%">
									<!-- fiche etat valide -->
									Stock : <span id="STOCK">...</span>
								</td>
								<td width="<?=$tail?>%">
									Vendu : <span id="VENDU">...</span>
									<small><span id="statVendu">...</span></small>
								</td>
							</tr>
						</table>
					</td>
					<td width="20%" rowspan="2">
						<table width="100%" id="tabSearch" style='display:none'>
							<tr>
								<td width="40%">
									<div onclick='goTo("fiche.php","create");' title="Remplir la fiche de dépot">
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
												<input type="text" name="numeroFiche" size="15" maxlength="50" title="Saisisez le numéro de fiche, ou l'identifiant de la fiche"
												 placeholder="Saisisez le numéro ou l'identifiant de la fiche." onchange="search(this.value)" id="inputSearch" />
											</td>
											<td align="center">
												<i class="fas fa-search link" onclick="search(document.enteteFormFiche.inputSearch)"></i>
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
									Init : <span id="INIT">...</span>
								</td>
								<td width="<?=$tail?>%">
									<!-- fiche etat modif prix -->
									Modif prix : <A href="index.php?page=modif" method="POST">
										<span id="modifPrix">...</span></A>
								</td>
								<td width="<?=$tail?>%">
									Retour : <span id="RENDU">...</span>
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