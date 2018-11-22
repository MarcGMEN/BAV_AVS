
<script>
	function get_nb_fiches(val) {

	}
	function display_nbs(val) {
	}

	function initEntete() {
		x_return_oneParametre(GetCookie('NUMERO_BAV'), display_paramBAV);
		//x_return_nb_fiches_par_etat(display_nbs);
	}

	function display_paramBAV(val) {
		if (val instanceof Object) {
			getElement('titre').innerHTML=val['par_titre'];
		}
		else {
			getElement('titre').innerHTML="Pas de BAV programme..";
		}
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
</script>
<table class="BH_CADRE" cellspacing="0" cellpadding="1" border="0">
	<tr height="100%">
		<td width="5%">
			<A HREF="index.php">
				<img src="Images/cycleBAV.png" height='100px'/>
			</A>


		</td>
		<td width="95%">
			<table width="100%" border=1>
				<tr>
					<td width="90%" colspan="2" class="TITRE_FENETRE_PRINCIPALE" id=titre>

					</td>
					<td width="10%">
						<span style="float: left"><i class="fas fa-bars fa-3x" onclick="inverseDisplay('divMenu')"></i>
						<div  style="position:absolute; display:none" id='divMenu' >
				<div class="MENU" >
					<div style='text-algin: center'>Menu</div>
					<hr/>
					<div><A HREF='index.php?page=login.php'>Login</A></div>
					<div><A HREF='index.php?page=parametre.php'>Parametres</A></div>

				</div>
			</div></span>
						<span style="float: right"><?=$_COOKIE['NUMERO_BAV']?>  [<?=$_SERVER['REMOTE_ADDR']?>]</span>
					</td>
				</tr>
				<tr>
					<td width="25%" rowspan="2">
						<form name="enteteFormFiche" method="POST" action="Actions/AEntete.php" >
						<input type="hidden" name="lAction" value="fiche"/>
						<table width="100%" >
							<tr>
								<td width="40%" >
									<div onclick="document.enteteFormFiche.value='';
										document.enteteFormFiche.lAction.value='create';
										document.enteteFormFiche.submit()"
									title="Remplir la fiche de dépot"
										>
										<button height="100%" id="deposer">
											<span class="fas fa-plus-square" ></span>&nbsp;Deposer<br/>
										</button>
									</div>
								</td>
								<td width="60%" >
									<table >
										<tr>
											<td align="center">
												<small>Recherche</small><br/>
												<input type="text" name="numeroFiche" size="15" maxlength="50"
												title="Saisisez le numéro de fiche, ou l'identifiant de la fiche"
												placeholder="Saisisez le numéro ou l'identifiant de la fiche."
												onchange="search(this.form)" id="inputSearch"/>
											</td>
											<td align="center">
												<i class="fas fa-search link" onclick="document.enteteFormFiche.lAction.value='fiche';	document.enteteFormFiche.submit()"></i>
											</td>
										</tr>
									</table>

								</td>
							</tr>
						</table>
						</form>
					</td>
					<?php $tail = (int) 100 / 3;?>
					<td width="75%" colspan=2 >
						<table width="100%" >
							<tr>
								<td width="<?=$tail?>%">
									<!-- fiche etat cofirme -->
									A valider : <span id="confirme" >...</span>
								</td>
								<td width="<?=$tail?>%">
									<!-- fiche etat valide -->
									Depot : <span id="valide" >...</span>
								</td>
								<td width="<?=$tail?>%">
									Vendu : <span id="vendu" >...</span>
									<small><span id="statVendu" >...</span></small>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan=2 >
						<table width="100%" >
							<tr>
								<td width="<?=$tail?>%">
									<!-- fiche etat modif prix -->
									Modif prix : <A href="index.php?page=modif" method="POST"><span id="modifPrix" >...</span></A>
								</td>
								<td width="<?=$tail?>%">
									<!-- fiche etat valide - vendu - retour -->
									Stock : <span id="stock" >...</span>
								</td>
								<td width="<?=$tail?>%">
									Retour : <span id="retour" >...</span>
									&nbsp;&nbsp;<small><span id="statRetour" >...</span></small>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>