
function initPage() {
    x_get_avis(false,display_all);
    x_get_countAvis(false,display_allCount);
}

function unloadPage() {

}

function display_allCount(val) {
    
    if (val instanceof Object) {

        var total = 0;
        var nb = 0;
        for (index in val) {
            nb+= parseInt(val[index]['cpt']);
            total += index *  parseInt(val[index]['cpt']);
        }
        var moyenne = parseFloat(total / nb);
            
        var repr = "<div style='font-size:2em;'>Moyenne de <b>" + (isNaN(moyenne) ? 0 : moyenne).toFixed(2) + "</b> / 5 sur " + nb + " votes ";
        repr +="<small><i class='link' style='color:grey' onclick='getAvisFromNote(\"\")'>(Tous les commentaires)</i></small></div > ";
        repr += "<table width=30% border=0>";
        for (i = 5; i > 0; i--) {
            repr += "<tr style='font-size:2em;'><td style='text-align:center;width:20%' >";
            if (val[i] ) {
                repr += val[i]['cpt'];
            }
            else {
                repr += "-";
            }
            repr += "</td><td class='link' width=80% onclick='getAvisFromNote("+i+")' title='Voir les commentaires avec la note "+i+"'>";
            for (j = 0; j < i; j++) {
                repr += "<span style='color: GOLD;'>★</span>";
            }
            repr += "</td></tr>";
        }
        repr += "</table>";
        getElement("avisCount").innerHTML = repr;
    }
}

function display_all(val) {
    console.log(val);
    if (val instanceof Object) {
        var total = 0;
        var repr = "";
        for (index in val) {
            repr += "<div class='row' style='border:1px solid #ddd; padding:10px; margin:10px 0;'>";
            repr += "<div class='col-sm-8 col-md-8 col-xs-8'>";
            if (ADMIN) {
                repr += "<span title='Supprimer' onclick='supprimerAvis(" + val[index]['avs_id'] + ")' class='link' style='font-size:1.5em'>&nbsp;❌&nbsp;</span>";
            }
            repr += "<strong>Note : </strong>";
            for (i = 0; i < parseInt(val[index]['avs_note']);i++) {
                repr += "<span style='font-size:2em;color: GOLD;'>★</span>";
            }
            repr += "</div>"
            repr += "<div class='col-sm-4 col-md-4 col-xs-4'>";
            repr += "<em>Publié le : </em>" +formatDate(val[index]['avs_date'], true);
            repr += "</div>";
            repr += "<div class='col-sm-12 col-md-12 col-xs-12'>";
            repr += "<strong>Commentaire : </strong>" +val[index]["avs_commentaire"];
            repr += "</div>"
            repr += "</div>";
        }
        
        total++;
    } else {
        repr += "<p>Aucun avis pour le moment.</p>";
    }

    getElement("avis").innerHTML = repr;

}
function inverseStar(star) {

    // RAZ des etoiles
    for (i = 1; i <= 5; i++) {
        getElement(i + 'pt').style.color = 'GREY';
    }
    if (star) {
        var j = star.id.substr(0, 1);
    }
    if (getElement("note").value == j) {
        getElement("note").value = 0;
    }
    else {
        for (i = 1; i <= 5; i++) {
            if (i <= j) {
                getElement(i + 'pt').style.color = 'BLUE';
            }
            getElement("note").value = j;
        }
    }
}

function valideStar(form) {
    if (form.note.value == 0) {
        alertModalInfo('Vous ne nous donnez pas de note, pourquoi voter alors ?');
    }
    else {
        x_add_avis(form.note.value, form.commentaire.value, display_create);
    }
}

function display_create(val) {
    alertModalInfoTimeout('Merci de votre participation.',3);
    setTimeout("location.reload()", 3000);
}

function getAvisFromNote(note) {
    x_get_avis(true,note,display_all);
}

function supprimerAvis(id) {
    if (confirm("Suppression de cet avis ? ")) {
        x_delete_avis(id, initPage);
    }
}