var tri="cli_nom";
var sens="asc";
var selection = {"cli_nom" : "*"};

function initPage() {
    if (ADMIN) {
        x_return_clientsRecap(tri,sens,tabToString(selection),display_clients);
    }
    else {
        goTo();
    }
    
}

function unloadPage() {
    
} 

function display_clients(val) {
    var total = 0;
    var repr="<table width='100%' border=1>";
    if (selection.cli_nom != "*") {
        var reg=new RegExp("("+selection.cli_nom+")", "gi");
    }
    var chaine="";
    for (index in val) {  
        var totalClient=0;
        var classPlus="";
        
        if (val[index]['STOCK']>0) {
            totalClient+=parseInt(val[index] ['STOCK']);
            classPlus="STOCK";
        }
        if (val[index] ['VENDU']>0) {
            totalClient+=parseInt(val[index] ['VENDU']);
            classPlus="VENDU";
        }
        if (val[index] ['PAYE']>0) {
            totalClient+=parseInt(val[index] ['PAYE']);
            classPlus="PAYE";
        }
        if (val[index] ['RENDU']>0) {
            totalClient+=parseInt(val[index] ['RENDU']);
            classPlus="RENDU";
        }
        
        if (val[index]['ACHAT']>0) {
            totalClient+=parseInt(val[index]['ACHAT']);
            classPlus="ACHAT";
        }
        if (totalClient == 0) {
            classPlus="WARN"
        }
        if (!isNaN(index)) {
        repr+="<tr class='tabl0 link "+classPlus+"' onclick='goTo(\"client.php\",\"select\","+val[index]['cli_id']+")'>";
        repr+="<td width=20% >";
        chaine=val[index]['cli_nom'];
        if (selection.cli_nom != "*") {
            repr+=chaine.replace(reg,"<b>$1</b>");
        }
        else {
            repr+=chaine;
        }
        repr+=" <small>("+val[index]['cli_code_postal']+")</small>";
        repr+="</td>";
        repr+="<td width=15% class='maskmobile' ><small>";
        repr+=val[index]['cli_taux_com']+" % -- "+val[index]['cli_prix_depot']+" €";
        repr+="</small></td>";
        
        repr+="<td width=35% class='maskmobile'>";
        repr+=val[index]['cli_emel'];
        repr+="</td>";
        
        repr+="<td width=15% class='maskmobile'>";
        repr+=val[index]['cli_telephone'];
        repr+="</td>";
        repr+="<th width=2% style='text-align: center'>";
        if (val[index] ['CONFIRME'] !=0) {
            repr+=val[index] ['CONFIRME'];
        }
        else {
            repr+="";
        }
        repr+="</th>";
        repr+="<th width=2% style='text-align: center'>";
        if (val[index] ['STOCK'] !=0) {
            repr+=val[index] ['STOCK'];
        }
        else {
            repr+="";
        }
        repr+="</th>";
        repr+="<th width=2% style='text-align: center'>";
        if (val[index] ['VENDU'] !=0) {
            repr+=val[index] ['VENDU'];
        }
        else {
            repr+="";
        }
        repr+="</th>";
        repr+="<th width=2% style='text-align: center'>";
        if (val[index] ['PAYE'] !=0) {
            repr+=val[index] ['PAYE'];
        }
        else {
            repr+="";
        }
        repr+="</th>";

        repr+="<th width=2% style='text-align: center'>";
        if (val[index] ['RENDU'] !=0) {
            repr+=val[index] ['RENDU'];
        }
        else {
            repr+="";
        }
        repr+="</th>";

        repr+="<th width=2% style='text-align: center'>";
        if (val[index]['ACHAT'] !=0) {
            repr+=val[index]['ACHAT'];
        }
        else {
            repr+="";
        }
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

    x_return_clientsRecap(col,sens,tabToString(selection),display_clients);
    tri=col;
}

function selectColonne(mask) {
    if (mask.length > 1) {
        selection = {'cli_nom' : mask};
    }
    else {
        selection = {'cli_nom' : "*"};
    }
    x_return_clientsRecap(tri,sens,tabToString(selection),display_clients);
    
}
