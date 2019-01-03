<script>
	var tri="cli_nom";
	var sens="asc";
	var selection = new Array();
	selection['cli_nom']="*";
	
	function initPage() {
		x_return_clients(tri,sens,tabToString(selection),display_clients);
	}

	function unloadPage() {
		
	} 

	function display_clients(val) {
        console.log(val);
		var total = 0;
		var repr="<table width='100%' border=1>";
		if (selection != "*") {
			var reg=new RegExp("("+selection+")", "gi");
		}
		var chaine="";
		for (index in val) {  
			if (!isNaN(index)) {
			repr+="<tr class='tabl0 link' onclick='goTo(\"client.php\",\"select\","+val[index]['cli_id']+")'>";
			repr+="<td width=35% >";
			chaine=val[index]['cli_nom'];
			if (selection != "*") {
				repr+=chaine.replace(reg,"<b>$1</b>");
			}
			else {
				repr+=chaine;
			}
			repr+="</td>";
			repr+="<td width=35% >";
			repr+=val[index]['cli_emel'];
			repr+="</td>";
			repr+="<td width=15% >";
			repr+=val[index]['cli_telephone'];
			repr+="</td>";
			repr+="<th width=3% >";
			if (val[index]['vente']['STOCK']) {
				repr+=val[index]['vente']['STOCK'];
			}
			else {
				repr+="0";
			}
			repr+="</th>";
			repr+="<th width=3% >";
			if (val[index]['vente']['VENDU']) {
				repr+=val[index]['vente']['VENDU'];
			}
			else if (val[index]['vente']['PAYE']) {
				repr+=val[index]['vente']['PAYE'];
			}
			else {
				repr+="0";
			}
			repr+="</th>";
			repr+="<th width=3% >";
			if (val[index]['vente']['RENDU']) {
				repr+=val[index]['vente']['RENDU'];
			}
			else {
				repr+="0";
			}
			repr+="</th>";
			repr+="<th width=3% >";
			repr+=val[index]['achat'];
			repr+="</th>";
			repr+="</tr>";

			total=total+1;
		}
		}
		repr+="</table>";

		getElement('clients').innerHTML=repr;

		getElement('total').innerHTML=total;

		if (sens=="asc") { classSort="sortUp";} else {classSort="sortDown";}
		getElement(tri).className=classSort;
	}

	function triColonne(col) {
		if (col==tri) {
			if (sens=="asc") {
				sens="desc";
			} 
			else {
				sens="asc";
			}
		}
		else {
			sens="asc";
		}
		getElement(tri).className="sortable";

		x_return_clients(numBav,col,sens,tabToString(selection),display_clients);
		tri=col;
	}

	function selectColonne(mask) {
		if (mask.length > 1) {
			selection['cli_nom']=mask;
		}
		else {
			selection['cli_nom']="*";
		}
		x_return_clients(tri,sens,tabToString(selection),display_clients);
		
	}
	
</script>
<h2>Nb Total de la selection : <span id=total></span></h2>
<table width="100%" >
	<tr>
		<td class="tittab" width=35%>
			<span id='cli_nom' onclick="triColonne('cli_nom')" class="sortable">Nom - Prenom&nbsp;&nbsp;&nbsp;</span>
			<input type=text name='cli_nom_<?=rand(1, 100)?>' size="20" class="autocomplete"
			 maxlength="100" onkeyup="selectColonne(this.value)" list="listClient" />
			<datalist id="listClient"></datalist> 
		</td>

		<td class="tittab" width=35%>
			<span id='cli_emel' onclick="triColonne('cli_emel')" class="sortable">Emel&nbsp;&nbsp;&nbsp;</span>
		</td>

		<td class="tittab" width=15%>
			<span id='cli_telephone' onclick="triColonne('cli_telephone')" class="sortable">Telephone&nbsp;&nbsp;&nbsp;</span>
		</td>

		<th class="tittab" width=3%>
			<span class="sortable" id='cli_depot' onclick="triColonne('cli_depot')">D&nbsp;&nbsp;&nbsp;</span>
		</th>

		<th class="tittab" width=3%>
			<span class="sortable" id='cli_vente' onclick="triColonne('cli_vente')">V&nbsp;&nbsp;&nbsp;</span>
		</th>
		<th class="tittab" width=3%>
			<span class="sortable" id='cli_rendu' onclick="triColonne('cli_rendu')">R&nbsp;&nbsp;&nbsp;</span>
		</th>

		
		<th class="tittab" width=3%>
			<span class="sortable" id='cli_achat' onclick="triColonne('cli_achat')">A&nbsp;&nbsp;&nbsp;</span>
		</th>

	</tr>
</table>
<div id=clients></div>