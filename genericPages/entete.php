<script>
	var ipLocal = "<?= $_SERVER['REMOTE_ADDR']; ?>";

	function initEntete() {
		console.log("CLIENT:" + CLIENT + " TABLE:" + TABLE + " ADMIN:" + ADMIN + "");
		if (TABLE || ADMIN) {
			getElement('connex').innerHTML = ADMIN ? 'ADMIN' : 'TABLE';
			if (getElement('tabStat')) {
				getElement('tabStat').className = 'tabStatShow';
				x_return_countByEtat(display_counter);
			}
			getElement('tdSearch').style.display = "table-cell";

		} else if (CLIENT) {
			getElement('tdSearch').style.display = "table-cell";
		}
			return_restant();
	}

	function return_restant() {
		var diff=((DATE_J1+"000")-Date.now())/1000;

		var jour=parseInt(diff / (3600*24));                  
		var heures=parseInt(diff / 3600) %24;
		var minutes=parseInt((diff % 3600) / 60);
		var secondes=parseInt(((diff % 3600) % 60));                  
		var jourTxt=jour>0?jour+'j et':'';
		if (secondes < 10) { secondes="0"+secondes}
		if (minutes < 10) { minutes="0"+minutes}
		getElement('timeRestant').innerHTML = jourTxt+" "+heures+":"+minutes+":"+secondes;
		setTimeout('return_restant()', 1000);
	}


	function display_counter(val) {
		if (val instanceof Object) {
			for (key in val) {
				if (getElement(key)) {
					getElement(key).innerHTML = val[key];
				}
			}
			var total = 0;
			var totalVente = 0
			if (val['STOCK']) {
				total += parseInt(val['STOCK']);
			}
			if (val['VENDU']) {
				total += parseInt(val['VENDU']);
				totalVente += parseInt(val['VENDU']);
			}
			if (val['RENDU']) {
				total += parseInt(val['RENDU']);
			}
			if (val['PAYE']) {
				total += parseInt(val['PAYE']);
				totalVente += parseInt(val['VENDU']);
			}

			getElement('TOTAL').innerHTML = total;

			getElement('statVendu').innerHTML = parseInt((val['VENDU'] / total) * 100) + "%";

			if (val['RENDU']) {
				getElement('statRendu').innerHTML = parseInt((parseInt(val['RENDU']) / total) * 100) + "%";
			} else {
				getElement('statRendu').innerHTML = "";
			}
		}
	}

	function enteteSaisie() {
		getElement('inputSearch').disabled = startSaisie;
	}

	function confirmPass() {
		x_whatYourName(document.modalForm.pass.value, displayhello);
	}

	function displayhello(val) {
		SetCookie("AADD", val);
		goTo("bav.php");
	}
</script>

<table class="BH_CADRE" cellspacing="0" cellpadding="0">
	<tr height="100%">
		<td width="12%">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-xs-6 menuMobile">
					<i class="fas fa-bars" style="font-size:36px" onclick="menuSel()"></i>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-6 maskMobile">
					<img src="Images/cycleBAV.png" id="cycleBAV" class=link onclick="location.href='index.php'" />
					<p style="font-size:0.7em" id=timeRestant></p>
				</div>
			</div>
		</td>
		<td width="73%">
			<div class="TITRE_FENETRE_PRINCIPALE">
				<?= $infAppli['titre']; ?>
			</div>
			<?php if ($infAppli['TABLE'] || $infAppli['ADMIN']) {
				include './genericPages/menuTABLE.php';
			} ?>
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
			<div style="float: left">
				<img src="Images/logoAVS.png" id="logoAVS" height='120pt'>
			</div>
			<div class="link" style="position:absolute; float: right; vertical-align:middle; font-size: 0.5em" onclick="alertModalPass();"><?= $_COOKIE['NUMERO_BAV']; ?>&nbsp;<span id="connex"></span>
			</div>
		</td>
	</tr>
</table>
<table class="BH_CADRE" cellspacing="0" cellpadding="0">
	<tr>
		<th class="tdMenu">
			<?php include './genericPages/navigation.php'; ?>
		</th>
		<td class="tdSearch" id="tdSearch" style="display:none">
			<form name="enteteFormFiche" action="#" onsubmit='return search(document.enteteFormFiche.inputSearch.value)'>
				<input type="text" name="numeroFiche" size="8" maxlength="50" title="Saisisez le numéro de fiche, ou l'identifiant de la fiche" placeholder="Vendu ?" id="inputSearch" onsubmit='search(this.value)' style='background-color:LIGHTGREEN;font-weight: bold' />
				<i id="loupe" class="fas fa-search link " onclick="search(document.enteteFormFiche.inputSearch.value)"></i>
			</form>
		</td>
	</tr>
</table>