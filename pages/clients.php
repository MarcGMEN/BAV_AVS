<script src="JS/clients.js" type="text/javascript"></script>

<h3>Nb  : <span id=total></span> 
	(Vendeurs : <span id=totalVendeur></span>; Acheteurs : <span id=totalAcheteur></span>; 
	Vendeurs-Acheteurs : <span id=totalVendeurEtAcheteur></span>; En attente : <span id=totalAbsent></span>) </h3>
<table width="100%" >
	<tr>
		<td class="tittab" width=35% colspan="2">
			<span id='cli_nom' onclick="triColonne('cli_nom')" class="sortable">Nom - Prenom&nbsp;&nbsp;&nbsp;</span>
			Tous <input type="checkbox" value="1" name="all" onchange="x_return_clientsRecap(tri,sens,tabToString(selection),this.checked ? 1 : 0,display_clients);" />
			<input type=text name='cli_nom_<?=rand(1, 100)?>' size="20" class="autocomplete"
			 maxlength="100" onkeyup="selectColonne(this.value)"  />
			
		</td>

		<td class="tittab maskmobile" width=35%>
			<span id='cli_emel' onclick="triColonne('cli_emel')" class="sortable">Emel&nbsp;&nbsp;&nbsp;</span>
		</td>

		<td class="tittab maskmobile" width=15%>
			<span id='cli_telephone' onclick="triColonne('cli_telephone')" class="sortable">Telephone&nbsp;&nbsp;&nbsp;</span>
		</td>

		<th class="tittab " width=2% >
			<span  id='cli_depot'>C</span>
		</th>

		<th class="tittab " width=2% >
			<span  id='cli_depot'>D</span>
		</th>

		<th class="tittab" width=2%>
			<span  id='cli_vente'>V</span>
		</th>
		<th class="tittab" width=2%>
			<span  id='cli_vente'>P</span>
		</th>
		
		<th class="tittab" width=2%>
			<span  id='cli_rendu'>R</span>
		</th>
		La Bourse Animations Réglement F.A.Q. Contacts Presse Parc Pré-déposer Gestion fiches Stock Clie
		<th class="tittab" width=2%>
			<span  id='cli_achat'>A</span>
		</th>

	</tr>
</table>
<div id=clients></div>