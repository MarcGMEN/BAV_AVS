var tri = "cli_nom";
var sens = "asc";
var selection = { "cli_nom": "*" };
var allG = 0;

function initPage() {
    if (ADMIN) {
        //        findClients(allG);
    } else {
        goTo();
    }
}

function unloadPage() {

}

function findClients(all) {
    allG = all;
    getElement('total').innerHTML = "...";
    getElement('totalAcheteur').innerHTML = "...";
    getElement('totalVendeur').innerHTML = "...";
    getElement('totalVendeurEtAcheteur').innerHTML = "...";
    getElement('totalAbsent').innerHTML = "...";
    x_return_clientsRecap(tri, sens, tabToString(selection), allG, display_clients);
}

function display_clients(val) {
    console.log(val);
    var total = 0;
    var repr = "<table width='100%' border=1>";
    if (selection.cli_nom != "*") {
        var reg = new RegExp("(" + selection.cli_nom + ")", "gi");
    }
    var chaine = "";
    var totalAcheteur = 0;
    var totalVendeur = 0;
    var totalVendeurEtAcheteur = 0;
    var totalAbsent = 0


    for (index in val) {
        var totalClient = 0;
        var classPlus = "";
        var indVendeur = false;
        var indAcheteur = false;
        if (!isNaN(index)) {
            if (val[index]['STOCK'] > 0) {
                totalClient += parseInt(val[index]['STOCK']);
                indVendeur = true;
                classPlus = "STOCK";
            }
            if (val[index]['VENDU'] > 0) {
                totalClient += parseInt(val[index]['VENDU']);
                indVendeur = true;
                classPlus = "VENDU";
            }
            if (val[index]['PAYE'] > 0) {
                totalClient += parseInt(val[index]['PAYE']);
                indVendeur = true;
                classPlus = "PAYE";
            }
            if (val[index]['RENDU'] > 0) {
                totalClient += parseInt(val[index]['RENDU']);
                indVendeur = true;
                classPlus = "RENDU";
            }

            if (val[index]['ACHAT'] > 0) {
                totalClient += parseInt(val[index]['ACHAT']);
                totalAcheteur++;
                indAcheteur = true;
                classPlus = "ACHAT";
            }
            if (totalClient == 0) {
                classPlus = "WARN"
            }
            classPlus = "";

            if (val[index]['cli_taux_com'] == 0) {
                classPlus = "ERROR"
            } else {
                if (val[index]['cli_taux_com'] == 5) {
                    classPlus = "STOCK"
                } else if (val[index]['cli_prix_depot'] == 0) {
                    classPlus = "ACHAT"
                }
            }

            if (indVendeur) {
                totalVendeur++;
                if (indAcheteur && indVendeur) {
                    totalVendeurEtAcheteur++;
                }
            } else if (!indAcheteur) {
                totalAbsent++;
            }

            repr += "<tr class='tabl0 link " + classPlus + "' onclick='goTo(\"client.php\",\"select\"," + val[index]['cli_id'] + ")'>";
            repr += "<td width=20% >";
            chaine = val[index]['cli_nom'];
            if (selection.cli_nom != "*") {
                repr += chaine.replace(reg, "<b>$1</b>");
            } else {
                repr += chaine;
            }
            repr += " <span style='font-size:7pt;font-weight: bold;' id=bavs_" + val[index]['cli_id'] + "' title=\"";
            var virgule = '';
            for (indexbavs in val[index]['bavs']) {
                repr += virgule + val[index]['bavs'][indexbavs]['obj_numero_bav'];
                virgule = ", ";
            }
            repr += "\" >[" + sizeof(val[index]['bavs']) + "]</span>"
            repr += " <small>(" + val[index]['cli_code_postal'] + ")</small>";
            repr += "</td>";
            repr += "<td width=15% class='maskmobile' ><small>";
            repr += val[index]['cli_taux_com'] + " % -- " + val[index]['cli_prix_depot'] + " €";
            repr += "</small></td>";

            repr += "<td width=35% class='maskmobile'>";
            repr += val[index]['cli_emel'];
            repr += "</td>";

            repr += "<td width=15% class='maskmobile'>";
            repr += val[index]['cli_telephone'];
            repr += "</td>";
            repr += "<th width=2% style='text-align: center'>";
            if (val[index]['CONFIRME'] && val[index]['CONFIRME'] != 0) {
                repr += val[index]['CONFIRME'];
            } else {
                repr += "";
            }
            repr += "</th>";
            repr += "<th width=2% style='text-align: center'>";
            if (val[index]['STOCK'] && val[index]['STOCK'] != 0) {
                repr += val[index]['STOCK'];
            } else {
                repr += "";
            }
            repr += "</th>";
            repr += "<th width=2% style='text-align: center'>";
            if (val[index]['VENDU'] && val[index]['VENDU'] != 0) {
                repr += val[index]['VENDU'];
            } else {
                repr += "";
            }
            repr += "</th>";
            repr += "<th width=2% style='text-align: center'>";
            if (val[index]['PAYE'] && val[index]['PAYE'] != 0) {
                repr += val[index]['PAYE'];
            } else {
                repr += "";
            }
            repr += "</th>";

            repr += "<th width=2% style='text-align: center'>";
            if (val[index]['RENDU'] && val[index]['RENDU'] != 0) {
                repr += val[index]['RENDU'];
            } else {
                repr += "";
            }
            repr += "</th>";

            repr += "<th width=2% style='text-align: center'>";
            if (val[index]['ACHAT'] && val[index]['ACHAT'] != 0) {
                repr += val[index]['ACHAT'];
            } else {
                repr += "";
            }
            repr += "</th>";
            repr += "</tr>";

            total++;

            // x_return_bavsClient(val[index]['cli_id'], display_bavs);
        }
    }
    repr += "</table>";

    getElement('clients').innerHTML = repr;

    getElement('total').innerHTML = total;
    getElement('totalAcheteur').innerHTML = totalAcheteur;
    getElement('totalVendeur').innerHTML = totalVendeur;
    getElement('totalVendeurEtAcheteur').innerHTML = totalVendeurEtAcheteur;
    getElement('totalAbsent').innerHTML = totalAbsent;


    if (sens == "asc") { classSort = "sortUp"; } else { classSort = "sortDown"; }
    getElement(tri).className = classSort;
}

function display_bavs(val) {
    console.log(val);
    var virgule = "";
    getElement('bavs_' + val[0]['id_client']).innerHTML = "[";
    for (index in val) {
        getElement('bavs_' + val[0]['id_client']).innerHTML += virgule + val[index]['obj_numero_bav'];
        virgule = ",";
    }
    getElement('bavs_' + val[0]['id_client']).innerHTML += "]";
}

function triColonne(col) {
    if (col == tri) {
        if (sens == "asc") {
            sens = "desc";
        } else {
            sens = "asc";
        }
    } else {
        sens = "asc";
    }
    getElement(tri).className = "sortable";
    findClients(allG);
    tri = col;
}

function selectColonne(mask) {
    if (mask.length > 1) {
        getElement('total').innerHTML = "...";
        getElement('totalAcheteur').innerHTML = "...";
        getElement('totalVendeur').innerHTML = "...";
        getElement('totalVendeurEtAcheteur').innerHTML = "...";
        getElement('totalAbsent').innerHTML = "...";
        selection = { 'cli_nom': mask };
        x_return_clientsRecap(tri, sens, tabToString(selection), allG, display_clients);
    }
}