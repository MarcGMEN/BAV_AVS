function compoFiche(val, gSearch = "", google = true, caffard = true, vendeur=true) {
    var repr = "";
    val['obj_marque_orig'] = val[index]['obj_marque'].replaceAll(/'/g, "");
    val['obj_modele_orig'] = val[index]['obj_modele'].replaceAll(/'/g, "");
    if (val[index]['obj_marque']) {
        if (gSearch) {
            var tabSearch = gSearch.replace("%", " ").split(" ");
            for (i in tabSearch) {
                if (tabSearch[i] != "") {
                    var reg = new RegExp("(" + tabSearch[i] + ")", "gi");
                    val[index]['obj_modele'] = val[index]['obj_modele'].replace(reg, "<b style='color:BLUE'>$1</b>");
                    val[index]['obj_description'] = val[index]['obj_description'].replace(reg, "<b style='color:BLUE'>$1</b>");
                    // val[index]['obj_prix_vente'] = val[index]['obj_prix_vente'].replace(reg, "<b style='color:BLUE'>$1</b>");
                    // val[index]['obj_prix_depot'] = val[index]['obj_prix_depot'].replace(reg, "<b style='color:BLUE'>$1</b>");
                    val[index]['obj_couleur'] = val[index]['obj_couleur'].replace(reg, "<b style='color:BLUE'>$1</b>");
                    val[index]['obj_public'] = val[index]['obj_public'].replace(reg, "<b style='color:BLUE'>$1</b>");
                    val[index]['obj_type'] = val[index]['obj_type'].replace(reg, "<b style='color:BLUE'>$1</b>");
                    val[index]['obj_marque'] = val[index]['obj_marque'].replace(reg, "<b style='color:BLUE'>$1</b>");
                    val[index]['obj_taille'] = val[index]['obj_taille'].replace(reg, "<b style='color:BLUE'>$1</b>");
                }
            }
        }
    }

    repr += "<div class='col-md-12 col-sm-12 col-xs-12 fiche_0'>";
    // if (GetCookie('CAFFARD_BAV') || ADMIN) {
    repr += "<div class='titreFiche' ";
    if ((GetCookie('CAFFARD_BAV') || ADMIN) && caffard) {
        repr += "onclick = 'x_return_oneFicheByCode(" + val[index]['obj_numero'] + ", display_getFicheVente);'";
    }
    repr += "> N° " + val[index]['obj_numero'];
    if (val[index]['obj_modele'] && google) {
        repr += "&nbsp<A href='https://www.google.fr/search?tbm=isch&q=" + val['obj_marque_orig'] + " " + val['obj_modele_orig'] + "' target='_blank' ><img src='https://www.we-do-it-better.fr/wp-content/uploads/2019/04/googlesearch.png' height='20px'/></A></span>";
    }
    var vendu=false;
    if (vendeur) {
        repr +="&nbsp;&nbsp;&nbsp;<span class='tittab "+val[index]['obj_etat']+"' >";
        switch (val[index]['obj_etat']) {
            case "CONFIRME":
                repr += "&nbsp;A déposer&nbsp;";
                break;
            case "STOCK":
                repr += "&nbsp;Non vendu&nbsp;";
                break;
            case "VENDU":
                repr += "&nbsp;Vendu&nbsp;";
                vendu=true;
                break;
            case "RENDU":
                repr += "&nbsp;Restitué&nbsp;";
                break;
            case "PAYE":
                repr += "&nbsp;Vendu et argent remis&nbsp;";
                vendu=true;
                break;
        
        }
        repr += "</span>";
        
    } else {

    }
        repr += "</div>";
    
    // }	
    // repr += "<div class='row'>";
    repr += "<div  class='col-md-6 col-sm-6 col-xs-6' >";
    repr += val[index]['obj_type'];
    if (val[index]['obj_public'] && val[index]['obj_public'] != "Autre") {
        repr += " - "+val[index]['obj_public'];
    }

    repr += "</div>";
    repr += "<div class='col-md-6 col-sm-6 col-xs-6' style='text-align: right;font-size:1.5em'>";
    if (ADMIN) {
        repr += val[index]['obj_prix_depot'] + " &euro;";
        if (val[index]['obj_prix_nego'] != "0.00") {
            repr += " -> " + val[index]['obj_prix_nego'] + "&euro;";
        }
        if (vendu) {
                repr += "<br/><small>vendu "+val[index]['obj_prix_vente'] + " &euro;</small>";
        }
    } else if (GetCookie('CAFFARD_BAV') || vendeur ) {
        repr += val[index]['obj_prix_depot'] + " &euro;";
        if (vendu) {
            repr += "<br/><small>vendu "+val[index]['obj_prix_vente'] + " &euro;</small>";
        }
    }
    repr += "</div>";
    // repr += "</div>";


    repr += "<div class='fiche_1'>";
    if (val[index]['obj_marque']) {
        repr += val[index]['obj_marque'];
        repr += " - ";
    }
    if (val[index]['obj_modele']) {
        repr += " " + val[index]['obj_modele'];
        repr += " - Taille : ";
    }
    if (val[index]['obj_taille']) {
        repr += val[index]['obj_taille'];
    }
    repr += "</div>";

    if (val[index]['obj_description']) {
        repr += "<div class='fiche_desc'>";
        repr += val[index]['obj_description'];
        repr += "</div>";
    }
    repr += "</div>";
    return repr;
}
