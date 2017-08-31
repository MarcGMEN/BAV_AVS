
<script>
var numeroFiche;
	function verifNumeroFiche(numero) {
		x_verifNumeroFiche(numero, display_verifNumeroFiche);
		return false;
	}
	
	function display_verifNumeroFiche(val) {
		if (val != null && typeof val == 'object') {
			document.enteteFormFiche.lAction.value="ficheVisu";
			document.enteteFormFiche.submit();
		}
		else {
			if (confirm("Creation de la fiche "+document.enteteFormFiche.numeroFiche.value+" ?")) {
				document.enteteFormFiche.lAction.value="ficheCreation";
				document.enteteFormFiche.submit();
			}
		}
	}

	function initEntete() {
		x_return_numeros_bav(display_numero_bav_entete);
	}
	

	var nbFiche;
	function display_nb_fiche(val) {
		getElement("fiche").innerHTML=val;
		nbFiche=val;

		x_return_nb_vendu(display_nb_vendu);
		x_return_nb_stock(display_nb_stock);
		x_return_nb_retour(display_nb_retour);
		
	}
	function display_nb_vendeur(val) {
		getElement("vendeur").innerHTML=val;
	}
	function display_nb_acheteur(val) {
		getElement("acheteur").innerHTML=val;
	}
	var nbVendu;
	function display_nb_vendu(val) {
		getElement("vendu").innerHTML=val;
		pourcent=parseInt(val/nbFiche*100);
		getElement("statVendu").innerHTML=pourcent+"%";
	}
	
	function display_nb_stock(val) {
		getElement("stock").innerHTML=val;
	}
	function display_nb_retour(val) {
		getElement("retour").innerHTML=val;
		pourcent=parseInt(val/nbFiche*100);
		getElement("statRetour").innerHTML=pourcent+"%";
	}
	function display_nb_clients(val) {
		getElement("client").innerHTML=val;
	}

	function display_numero_bav_entete(val) {
		var select = getElement("sel_numero_bav");
		for(index in val) {
				var indexSel=select.options.length;
			    select.options[indexSel] = new Option(val[index], val[index]);
			    if (GetCookie("NUMERO_BAV")==null) {
			    	SetCookie("NUMERO_BAV",val[index]); 
			    	select.options[indexSel].setAttribute("selected", "selected");
			    }
			    else {
				    if ( val[index]==GetCookie("NUMERO_BAV")) {
				    	select.options[indexSel].setAttribute("selected", "selected");
				    }
			    }
		}
		//getElement("NUMERO_BAV_ENTETE").innerHTML="BAV "+val;

// 		x_return_nb_fiche(display_nb_fiche);
// 		x_return_nb_vendeur(display_nb_vendeur);
// 		x_return_nb_acheteur(display_nb_acheteur);
// 		x_return_nb_clients(display_nb_clients);	
	}
	function modifBAV(bav) {
		SetCookie("NUMERO_BAV",bav);
		document.location.href="index.php";
	}
</script>
<table class="BH_CADRE" cellspacing="0" cellpadding="1" border=0>
	<tr height="100%">
		<td width="20%">
			<div style="position:absolute;left:200px;font-size:15px;color:BLACK" id=NUMERO_BAV_ENTETE>
			BAV n°<select id=sel_numero_bav onchange="modifBAV(this.value)"></select></div>
			<A HREF="index.php">
				<img src="Images/cycleBAV.png" />
			</A>
		</td>
		<td width="80%">
			<table>
				<tr>
					<td width="15%">
						<img src="Images/mailing.png" height="150px"
								onclick="document.enteteFormStock.lAction.value='mailing';document.enteteFormStock.submit()" 
						 		title="Mailing" class="link"/>
						</div>
					</td>
					<td width="28%">
						<form name="enteteFormFiche" method="POST" 
							action="Actions/AEntete.php" onsubmit="return verifNumeroFiche(this.numeroFiche.value);" >
						<input type=hidden name="lAction" value=""/>
						<table width=100%>
							<tr>
								<td width=40% rowspan="3">
									<img src="Images/fiche.png" height="150px" />	
								</td>
								<td width=60% >
									<table >
									<tr><td>
									<input type="text" name="numeroFiche" size=3 maxlength="5" />
									</td>
									<td align="center">
									<input type="submit" value="Recherche" />
									</td></tr>
									</table>
									
								</td>
							</tr>
							<tr>
								<td >
									Nb de dépôt : <span id="fiche" >...</span>
								</td>
							</tr>
						</table>
						</form>
						
					</td>
					<td width="28%">
						<form name="enteteFormClient" method="POST"	action="Actions/AEntete.php" >
						<input type=hidden name="lAction" value="client"/>
						<table width=100%>
						<tr>
							<td width="40%" rowspan="3">
								<img src="Images/client.png" height="150px"
								onclick="document.enteteFormClient.lAction.value='clients';document.enteteFormClient.submit()"
						 		title="Fichier client" class="link"/>
							</td>
							
							<td width=50%>
							Nb de vendeurs : <span id="vendeur" >...</span>
						</td>
						</tr>
						<tr>
						<td>					
							Nb de acheteurs : <span id="acheteur" >...</span>
						</td>					
						</tr>
						<tr>
						<td>					
							Nb de clients : <span id="client" >...</span>
						</td>					
						</tr>
						</table>
						</form> 
					</td>
					<td width="28%">
						<form name="enteteFormStock" method="POST"	action="Actions/AEntete.php" >
						<input type=hidden name="lAction" value="stock"/>
						<table width=100%>
						<tr>
							<td width="40%" rowspan="3">
							<img src="Images/stock.png" height="150px" class="link" 
							onclick="document.enteteFormStock.lAction.value='stock';document.enteteFormStock.submit()" 
							title="Le stock" />
							</td>
							
							<td width=25%>
							Vendu : <span id="vendu" >...</span>
							</td>
							<td width=25% >
								<big><span id="statVendu" >...</span></big>
							</td>
						</tr>
						<tr>
							<td>					
								Retour : <span id="retour" >...</span>
							</td>					
							<td width=25% >
								<big><span id="statRetour" >...</span></big>
							</td>
						</tr>
						<tr>
							<td>					
								Stock : <span id="stock" >...</span>
							</td>					
						</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>