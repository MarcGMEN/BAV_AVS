function initPage() {
    if (ADMIN) {
        x_return_enum('bav_objet', 'obj_type', display_list_type);
        //x_return_enum('bav_objet', 'obj_public', display_list_public);
        //x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);

        x_return_list_marques(display_list_marque)
        x_return_list_unique("bav_objet", "obj_etat", display_list_etat)
            //x_return_list_unique("bav_objet", "obj_couleur", display_list_couleur)
        x_return_fiches(tri, sens, tabToString(tabSel), display_fiches);
    } else {
        goTo();
    }

}

function display_list_type(val) {
    display_list(val, 'type');
}

function display_list_public(val) {
    display_list(val, 'public');
}

function display_list_pratique(val) {
    display_list(val, 'pratique');
}

function display_list_marque(val) {
    display_list(val, 'marque');
}

function display_list_couleur(val) {
    display_list(val, 'couleur');
}

function display_list_etat(val) {
    display_list(val, 'etat');
}

function display_list(val, row) {
    console.log(val);
    var select = getElement("sel_obj_" + row);
    select.options[select.options.length] = new Option("Choix", "*");
    for (index in val) {
        select.options[select.options.length] = new Option(val[index], val[index]);
        if (tabSel['obj_' + row] != null && tabSel['obj_' + row] == val[index]) {
            select.options[select.options.length - 1].selected = true;
        }
    }
}

function unloadPage() {}

// recuperation des donnees de la BAV
function setParamVal(val) {
    setParamValIndex(val);
    if (ADMIN) {} else {
        goTo();
    }
}

function display_fiches(val) {
    console.log(val);
    if (val instanceof Object) {

        var total = 0;
        var repr = "<table width='100%' border=1  >";
        for (index in val) {
            if (!isNaN(index)) {
                var stylePlus = "margin: 2 2 2 2";
                if (val[index]['mop_id'] > 0) {
                    stylePlus = "color:DARKRED;font-weight:bold"
                }
                repr += "<tr class='tabl0 " + val[index]['obj_etat'] + " link' style='" + stylePlus + "' onclick='goTo(\"fiche.php\",\"modif\"," + val[index]['obj_id'] + ")'>";
                repr += "<td width=5% align=center>";
                if (val[index]['obj_modif_data'] > 0) {
                    //repr += "<img src='Images/etiq" + val[index]['obj_modif_data'] + ".png' style='height:20px' />";
                    repr += "<div style='font-size:0.5em'>etiquette</div>";
                }
                if (val[index]['obj_modif_vendeur'] > 0) {
                    //repr += "<img src='Images/coupon_vendeur" + val[index]['obj_modif_vendeur'] + ".png' style='height:10px' />";
                    repr += "<div style='font-size:0.5em'>coupon vendeur</div>";
                }
                if (val[index]['obj_modif_stock'] > 0) {
                    repr += "<div style='font-size:0.5em'>coupon Stock</div>";
                }

                if (val[index]['mop_id'] > 0) {
                    repr += "<img src='Images/modifPrix.png' style='height:20px' />";
                }
                repr += val[index]['obj_numero'];
                repr += "</td>";
                repr += "<td width=8%>";
                repr += val[index]['obj_type'];
                repr += "</td>";
                repr += "<td class='maskMobile' width=8%  >";
                repr += val[index]['obj_couleur'];
                repr += "</td>";
                /*repr += "<td width=10% >";
                repr += val[index]['obj_public'];
                repr += "</td>";
                repr += "<td width=10% >";
                repr += val[index]['obj_pratique'];
                repr += "</td>";*/
                repr += "<td class='maskMobile' width=12% title=\"modèle :" + val[index]['obj_modele'] + "\ndesc :" + val[index]['obj_description'] + "\"'>";
                repr += val[index]['obj_marque'];
                repr += "</td>";
                repr += "<td class='maskMobile' width=14% title=\"mel : " + val[index]['cli_emel'] + "\">";
                repr += val[index]['vendeur_nom'];
                repr += "</td>";
                repr += "<td width=8% >";
                if (val[index]['obj_prix_vente'] == 0) {
                    repr += "<span style='color:RED'>" + val[index]['obj_prix_depot'] + "</span>";
                } else {
                    repr += val[index]['obj_prix_vente'];
                }
                repr += "</td>";
                repr += "<td width=8% >";
                repr += val[index]['obj_etat'];
                repr += "</td>";
                repr += "<td width=8% class='maskMobile' >";
                repr += formatDate(val[index]['obj_date_depot'], false);
                repr += "</td>";
                repr += "<td class='maskMobile' width=14% >";
                repr += val[index]['acheteur_nom'];
                repr += "</td>";
                repr += "<td class='maskMobile' width=16% title='date vente - date retour'>";
                repr += formatDate(val[index]['obj_date_vente'], false);
                repr += " - ";
                repr += formatDate(val[index]['obj_date_retour'], false);
                repr += "</td>";
                repr += "</tr>";

                total = total + 1;
            }
        }
        repr += "</table>";

        getElement('fiches').innerHTML = repr;

        getElement('total').innerHTML = total;

        if (sens == "asc") {
            classSort = "sortUp";
        } else {
            classSort = "sortDown";
        }
        getElement(tri).className = classSort;

        if (getElement('total_vente_stock')) {
            getElement('total_vente_stock').innerHTML = "0.00";
            getElement('total_vente_vendu').innerHTML = "0.00";
            getElement('total_vente_paye').innerHTML = "0.00";
            getElement('total_vente_depot').innerHTML = "0.00";;
            getElement('total_com_vendu').innerHTML = "0.00";
            getElement('total_com_paye').innerHTML = "0.00";
            getElement('total_depot').innerHTML = "0.00";
            //getElement('total_vente_rendu').innerHTML = "0.00";

            if (val['total_vente_depot']) {
                getElement('total_vente_depot').innerHTML = val['total_vente_depot'];
            }
            if (val['total_vente_STOCK']) {
                getElement('total_vente_stock').innerHTML = val['total_vente_STOCK'];
                getElement('total_depot').innerHTML = val['total_depot'];
            }
            if (val['total_vente_VENDU']) {
                getElement('total_vente_vendu').innerHTML = val['total_vente_VENDU'];
                getElement('total_com_vendu').innerHTML = val['total_com_vendu'];
            }

            if (val['total_vente_PAYE']) {
                getElement('total_vente_paye').innerHTML = val['total_vente_PAYE'];
                getElement('total_com_paye').innerHTML = val['total_com_paye'];
            }
            // if (val['total_vente_RENDU']) {
            // 	getElement('total_vente_rendu').innerHTML = val['total_vente_RENDU'];
            // }
        }
    } else {
        alertModalWarn(val);
    }


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
    x_return_fiches(col, sens, tabToString(tabSel), display_fiches);
    tri = col;
}

function isEdit() {
    if (getElement("selEdit").value == 1) {
        tabSel['obj_modif_data'] = getElement("selEdit").value;
        tabSel['obj_modif_vendeur'] = getElement("selEdit").value;;
        getElement("selEdit").value = 0;
    } else {
        tabSel['obj_modif_data'] = "*";
        tabSel['obj_modif_vendeur'] = "*";
        getElement("selEdit").value = 1;
    }
    x_return_fiches(tri, sens, tabToString(tabSel), 0, display_fiches);
}

function selectColonne(col, mask) {
    tabSel['obj_type'] = getElement("sel_obj_type").value;
    tabSel['obj_marque'] = getElement("sel_obj_marque").value;
    tabSel['obj_etat'] = getElement("sel_obj_etat").value;

    x_return_fiches(col, sens, tabToString(tabSel), 0, display_fiches);
}

function searchColonne(col, mask) {
    tabSel['obj_search'] = getElement("inp_obj_couleur").value;
    //tabSel[col] = mask;

    if (tabSel['obj_search'].length > 2 || tabSel['obj_search'].length == 0) {

        if (tabSel['obj_search'].length == 0) {
            tabSel['obj_search'].length = null;
        }
        x_return_fiches(tri, sens, tabToString(tabSel), 0, display_fiches);
    }
}


function display_listVendeur(val) {
    var list = getElement("listVendeur");
    list.innerHTML = "";;
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}