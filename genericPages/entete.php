<script>
	function initEntete() {
		console.log("CLIENT:"+CLIENT+" TABLE:"+TABLE+" ADMIN:"+ADMIN+"");
		if (TABLE || ADMIN) {
			getElement('connex').innerHTML=TABLE ? 'TABLE' : 'ADMIN';
			if (getElement('tabStat')) {
				getElement('tabStat').className='tabStatShow';
				x_return_countByEtat(display_counter);
			}
		}
		else {
			if (CLIENT) {
				getElement('tabSearch').style.display='table';
			}
		}
		console.log("Fin initEntete");
	}

	function display_counter(val) {
		if (val instanceof Object) {
			for (key in val) {
				if (getElement(key)) {
					getElement(key).innerHTML=val[key];
				}
			}
			getElement("depotTOT").innerHTML=parseInt(val['STOCK'])+parseInt(val['VENDU'])+parseInt(val['RENDU']);
		}
	}

	function enteteSaisie() {
		getElement('inputSearch').disabled=startSaisie;
	}
</script>

<table class="BH_CADRE" cellspacing="0" cellpadding="0">
	<tr height="100%">
		<td width="5%">
			<span id="depotTOT"></span>
			<A HREF="index.php">
				<img src="Images/cycleBAV.png" id="cycleBAV" height='100pt' />
			</A>
		</td>
		<td width="80%" >
			<div class="TITRE_FENETRE_PRINCIPALE" >
				<?=$infAppli['titre']?>
			</div>
			<? if ($infAppli['TABLE'] || $infAppli['ADMIN']) {
                include "./genericPages/menuTABLE.php";
			}?>
		</td>
		<td width="15%">
			<!--<span style="float: left; display:none" id="theMenu">
				<i class="fas fa-bars fa-3x" onclick="inverseDisplay('divMenu')"></i>
				<div style="position:absolute; display:none" id='divMenu'>
					<div class="MENU">
						<div style='text-algin: center'>Menu</div>
						<hr />
						<div class="link" onclick='goTo("parametre.php")'>Parametres</A></div>

					</div>
				</div>
			</span>-->
			<span style="float: left" ?>
				<img src="Images/logoAVS.png"  id="logoAVS" height='120pt'>
			</span>
			<span style="float: right; vertical-align:middle" title="[<?=$_SERVER['REMOTE_ADDR']?>]"><?=$_COOKIE['NUMERO_BAV']?>
				<div id="connex"></div>
			</span>
		</td>
	</tr>
	<tr>
		<th colspan=2>
			<?php include "./genericPages/navigation.php"?>
		</th>
		<td>
			<table width="100%" id="tabSearch">
				<!--				<tr>
					<th width="100%">
						<div onclick='goTo("fiche.php","create");' title="Remplir la fiche de dépot" >
							<button height="100%" id="deposer" >
								<span class="fas fa-plus-square navigation"></span>&nbsp;Deposer<br />
							</button>
						</div>
					</th>
				</tr>-->
				<tr>
					<td>
						<table width="100%">
							<tr>
								<td>
									<!-- <small>Recherche</small><br /> -->
									<input type="text" name="numeroFiche" size="15" maxlength="50" title="Saisisez le numéro de fiche, ou l'identifiant de la fiche"
									 placeholder="Recherche" id="inputSearch" />
								</td>
								<th>
									<i class="fas fa-search link" onclick="search(document.enteteFormFiche.inputSearch)"></i>
								</th>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>