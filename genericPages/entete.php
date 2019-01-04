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
		console.log("Fin initEntete");
	}

	function display_counter(val) {
		if (val instanceof Object) {
			for (key in val) {
				if (getElement(key)) {
					getElement(key).innerHTML=val[key];
				}
			}
			//getElement("depotTOT").innerHTML=parseInt(val['STOCK'])+parseInt(val['VENDU'])+parseInt(val['RENDU']);
		}
	}

	function enteteSaisie() {
		getElement('inputSearch').disabled=startSaisie;
	}
</script>

<table class="BH_CADRE" cellspacing="0" cellpadding="0">
	<tr height="100%">
		<td width="15%">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-xs-6 menuMobile">
					<i class="fas fa-bars" style="font-size:36px" onclick="menuSel()"></i>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-6">
					<img src="Images/cycleBAV.png" id="cycleBAV" class=link onclick="location.href='index.php'" />
				</div>
			</div>
		</td>
		<td width="70%" >
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
			<span style="float: left" >
				<img src="Images/logoAVS.png"  id="logoAVS" height='120pt'>
			</span>
			<span style="float: right; vertical-align:middle; font-size: 0.5em" title="[<?=$_SERVER['REMOTE_ADDR']?>]"><?=$_COOKIE['NUMERO_BAV']?>
				<span id="connex"></span>
			</span>
		</td>
	</tr>
</table>
<table  class="BH_CADRE" cellspacing="0" cellpadding="0">
	<tr>
		<th class="tdMenu" >
			<?php include "./genericPages/navigation.php"?>
		</th>
		<td class="tdSearch" >
			<form name="enteteFormFiche" action="#" onsubmit='return search(document.enteteFormFiche.inputSearch.value)'>
			<input type="text" name="numeroFiche" size="15" maxlength="50" title="Saisisez le numéro de fiche, ou l'identifiant de la fiche"
				placeholder="Recherche" id="inputSearch" onsubmit='search(this.value)' />
			<i class="fas fa-search link" onclick="search(document.enteteFormFiche.inputSearch.value)"></i>
			</form>
		</td>
	</tr>
</table>