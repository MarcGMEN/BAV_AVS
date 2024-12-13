
function initPage() {
    x_get_creneaux(display_all);
    setTimeout('x_get_count_creneaux(display_count)', 500);
    setTimeout('x_get_init_creneaux_by_classeur(display_initClasseur)', 500);;

}
function unloadPage() {

}

var tabIdCre = [];
var tailleCre = 0;
function display_all(val) {
    // console.log(val);
    if (val instanceof Object) {
        var total = 0;
        var repr = "<table width=100%>";
        repr += "<tr>";
        repr += "<td width=5%>&nbsp;</td>";
        var nbCre = 0;
        for (index in val) {
            nbCre++;
        }
        tailleCre = parseInt(95/ nbCre);
        for (index in val) {

            var dateLu = new Date(val[index]['cre_debut']);
           
            repr += "<td width='" + tailleCre + "%' class='tittab'>"; 
            repr += "<span class='maskMobileBlock'>" + getJourDate(dateLu) + "</span>";
            repr += "<span class='onMobileBlock'>" + getJourDate(dateLu).substr(0,2) + "</span>";
            repr += " " + dateLu.getDate()
            repr += "<span class='maskMobileBlock' title='Supprimer' onclick='supprimerCrenau(" + val[index]['cre_id'] + ")' class='link' >❌</span>";
            repr += "<br/><span class='maskMobileBlock'>à partir de</span> "+val[index]['cre_debut'].substr(11, 5);
            repr += "<br/><span class='maskMobileBlock'>Temps de :" + val[index]['delta'] + "min</span>";
            repr += "</td > ";
            tabIdCre.push(val[index]['cre_id']);
        }
        repr += "</tr>";
        repr += "<tr>";
        repr += "<td class='maskMobile tabl0'>Total charge</td>";
        repr += "<td class='onMobile tabl0'>Tot</td>";
        for (index in val) {
            repr += "<td class='tabl1' style='text-align:center; font-size:0.6em' >";
            repr += "<span id = 'cre_" + val[index]['cre_id'] + "_nb' ></span> / ";
            repr += "<span id = 'tot_reel_" + val[index]['cre_id']+"' ></span>"
            repr += "</td>";
        }
        repr += "</tr>";
        repr += "<table>";
        total++;
    } else {
        repr += "<p>Aucun créneaux pour le moment.</p>";
    }

    getElement("creneaux").innerHTML = repr;

}

function display_count(val) {
    // console.log(val);
    if (val instanceof Object) {
        for (index in val) {
            getElement("cre_" + index + "_nb").innerHTML = val[index]['cpt'];
        }
    }
}

function display_initClasseur(val) {
    // console.log(val);
    var repr = "<table width=100% border=1>";
    if (val instanceof Object) {
        for (idClass in val) {
            repr += "<tr style='height:50px' class='tabl0'>";
            repr += "<td  width='5%' >" + val[idClass]['numero_deb'];
            repr += "<br />["+val[idClass]['cpt'] + "]</td > ";
            for (index in tabIdCre) {
                var numCre = tabIdCre[index];
                repr += "<td  width='" + tailleCre + "%'class='tabl1'>";
                if (val[idClass][numCre]) {
                    repr += " <div style='text-align:center;width:100%;height:40px;background-color:WHITE' id='" + idClass + "_" + numCre + "_prevu'></div>";
                }
                else {
                    repr += "<div style='width:100%;height:40px;background-color:GREEN'>&nbsp;</div>";
                }
                repr += "<div style='width:100%;height:4px;background-color:lightgrey' ></div>";
                repr += " <div style='text-align:center;width:100%;height:40px;background-color:WHITE' id='" + idClass + "_" + numCre + "_reel'></div>";
                repr + "</td>";
            }
            repr += "</tr>";
        }
        repr += "<table>";
        getElement("creneauxClass").innerHTML = repr;

       setTimeout('x_get_count_creneaux_by_classeur_reel(display_countClasseur_reel)',1000);
       setTimeout('x_get_count_creneaux_by_classeur(display_countClasseur)',1000);
    }
}

/**
 * 
 * @param {*} val 
 */
function display_countClasseur(val) {
     console.log(val);
    if (val instanceof Object) {
        for (idClass in val) {
            for (index in tabIdCre) {
                var numCre = tabIdCre[index];
                var idDiv = idClass + "_" + numCre + "_prevu";
                if (val[idClass][numCre]) {
                    var charge = parseInt(val[idClass][numCre]['cpt'] * 100 / val[idClass][numCre]['max_nb']);
                    var color = "Green";
                    var colorText = "White";
                    if (charge > 60) {
                        color = 'orange'
                        colorText = "black";
                    }
                    if (charge > 80) {
                        color = 'RED'
                        colorText = "White";
                    }
                    var repr = "";
                    
                    // console.log(idClass + "_" + numCre + "_prevu");
                    if (getElement(idDiv)) {
                        getElement(idDiv).style.backgroundColor = color;
                        getElement(idDiv).style.color= colorText;
                        
                        repr += "prévu :<br/>"+val[idClass][numCre]['cpt'] + ' / ' + val[idClass][numCre]['max_nb'];
                        /*repr += "<span class='maskMobile'>  en min : "
                        repr += val[idClass][numCre]['charge_tps'] + "' / " + val[idClass][numCre]['max_tps'] + "'</span>";*/
                        getElement(idDiv).innerHTML = repr;
                    }
                }
                else {
                    getElement(idDiv).innerHTML = "&nbsp;";
                }

            }

        }
    }

}

function display_countClasseur_reel(val) {
    console.log((val));
    var totalCre = [];
    for (idClass in val) {

        for (index in val[idClass]) {
            if (index != "numero_deb") {
                // console.log(idClass + "_" + index + "_reel");
                if (getElement(idClass + "_" + index + "_reel")) {
                    getElement(idClass + "_" + index + "_reel").innerHTML = "info :<br/>" + val[idClass][index]['cpt'] + " / " + val[idClass][index]['max_nb'];
                    var charge = parseInt(val[idClass][index]['cpt'] * 100 / val[idClass][index]['max_nb']);
                    if (!totalCre[index]) {
                        totalCre[index] = 0;
                    }
                    totalCre[index] += val[idClass][index]['cpt'];
                    var color = "lightGreen";
                    var colorText = "black";
                    if (charge > 60) {
                        color = 'LightSalmon'
                        colorText = "black";
                    }
                    if (charge > 80) {
                        color = 'salmon'
                    }
                    getElement(idClass + "_" + index + "_reel").style.backgroundColor = color;
                    getElement(idClass + "_" + index + "_reel").style.color= colorText;
                }
            }
        }
        for (index in totalCre) {
            getElement('tot_reel_' + index).innerHTML = totalCre[index];
        }
    }
}

function addCreneau(form) {

    console.log(form.debut.value);
    console.log(form.fin.value);
    var dateDeb = new Date(form.debut.value);
    var dateFin = new Date(form.fin.value);

    var suite = true;
    if (dateFin <= dateDeb) {
        window.alert("La date de fin doit être supérieure à la date de début");
        suite = false;
    }

    if (suite) {
        x_addCreneau(form.debut.value, form.fin.value, display_create);
    }
}

function display_create(val) {
    if (val) {
        alertModalInfoTimeout(val, 3);
    }
    x_get_creneaux(display_all);
}


function supprimerCrenau(id) {
    if (confirm("Suppression de ce creneau ? ")) {
        x_delete_creneau(id, initPage);
    }
}