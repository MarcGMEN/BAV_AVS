
<script>
	var tri="cli_nom";
	var sens="asc";
	var selection="*";
	var numBav= GetCookie('NUMERO_BAV');
	
	function initPage() {
		x_return_clients(numBav,tri,sens,selection,display_clients);
		x_return_list_public(display_list_public);
	}
	function display_list_public(val) {
		var select = getElement("sel_obj_public");
		select.options[select.options.length] = new Option("Tous", "*");
		for(index in val) {
			    select.options[select.options.length] = new Option(val[index], val[index]);
		}
	}
	
	function unloadPage() {
		
	} 

	function display_clients(val) {

		var total = 0;
		var repr="<table width='100%'>";
		if (selection != "*") {
			var reg=new RegExp("("+selection+")", "gi");
		}
		var chaine="";
		for (index in val) {
			repr+="<tr class='tabl0 link' onclick='location.href=\"index.php?page=client.php&cli_id="+val[index]['cli_id']+"\"'>";
			repr+="<td width=40% >";
			chaine=val[index]['cli_nom']+" "+val[index]['cli_prenom'];
			if (selection != "*") {
				repr+=chaine.replace(reg,"<b>$1</b>");
			}
			else {
				repr+=chaine;
			}
			repr+="</td>";
			repr+="<td width=25% >";
			repr+=val[index]['cli_emel'];
			repr+="</td>";
			repr+="<td width=15% >";
			repr+=val[index]['cli_telephone'];
			repr+="</td>";
			repr+="<td width=5% >";
			repr+=val[index]['cli_depot'];
			repr+="</td>";
			repr+="<td width=5% >";
			repr+=val[index]['cli_vente'];
			repr+="</td>";
			repr+="<td width=5% >";
			repr+=val[index]['cli_achat'];
			repr+="</td>";
			repr+="</tr>";

			total=total+1;
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

		x_return_clients(numBav,col,sens,selection,display_clients);
		tri=col;
	}
	function selectColonne(mask) {
		if (mask.length > 1) {
			selection=mask;
		}
		else {
			selection="*";
		}
		x_return_clients(numBav,tri,sens,selection,display_clients);
		
	}

	function checkAllBav(check) {
		if (check.checked) {
			numBav="*";
		}
		else {
			numBav=GetCookie('NUMERO_BAV');
		}
		x_return_clients(numBav,tri,sens,selection,display_clients);
	}
	
</script>
<h2>Nb Total de la sélection :	<span id=total></span>
&nbsp;&nbsp;&nbsp;Toutes les bav <input type="checkbox" onchange="checkAllBav(this);" value="*"/></h2>
<table width="100%">
<tr>
<td class="tittab" width=40% >
<span id='cli_nom' onclick="triColonne('cli_nom')" class="sortable">Nom - Prénom&nbsp;&nbsp;&nbsp;</span>
<input type=text name='cli_nom_<?=rand(1,100)?>'  size="20" maxlength="100" onkeyup="selectColonne(this.value)"/> </td>

<td class="tittab" width=25% >
<span id='cli_emel'  onclick="triColonne('cli_emel')" class="sortable">Emel&nbsp;&nbsp;&nbsp;</span></td>

<td class="tittab" width=15% >
<span id='cli_telephone' onclick="triColonne('cli_telephone')" class="sortable">Téléphone&nbsp;&nbsp;&nbsp;</span></td>

<td class="tittab" width=5% >
<span class="sortable" id='cli_depot' onclick="triColonne('cli_depot')">Dépôt&nbsp;&nbsp;&nbsp;</span></td>

<td class="tittab" width=5% >
<span class="sortable" id='cli_vente' onclick="triColonne('cli_vente')">Vente&nbsp;&nbsp;&nbsp;</span></td>

<td class="tittab" width=5% >
<span class="sortable" id='cli_achat' onclick="triColonne('cli_achat')">Achat&nbsp;&nbsp;&nbsp;</span></td>

</tr>
</table>
<div id=clients></div>