// mode de fonctionnement de la page
// create  : creation d'une fiche CLIENT
// modif   : modification par le client avec ID_FICHE, par la TABLE avec le numero fiche
// consult : modification par le client avec numero de fiche
// 

/*
 * action lors du chargement de la page
 */
var approved=1;
if (ADMIN) {
    approved='';
}
console.log(approved);
var gSearch=""
function initPage() {
    x_return_faqs("", approved, display_faqs);
}

function unloadPage() {

}
function search(search) {
    gSearch = search;
    x_return_faqs(noAccent(search), approved, display_faqs);
}
function display_faqs(val) {
    console.log(val);
    var repr="";
    if (val instanceof Object && !objectIsEmpty(val)) {
        for (index in val) {
            if (gSearch) {
                val[index]['faq_question'] = val[index]['faq_question'].replace(new RegExp(gSearch, 'ig'), "<b style='color:BLUE'>"+gSearch+"</b>");
                val[index]['faq_response'] = val[index]['faq_response'].replace(new RegExp(gSearch, 'ig'), "<b style='color:BLUE'>"+gSearch+"</b>");
                val[index]['faq_response'] = val[index]['faq_response'].replace(new RegExp(noAccent(gSearch), 'ig'), "<b style='color:BLUE'>"+gSearch+"</b>");
            }
            repr+="<dl><dt>";
            if (ADMIN) {
                repr+="<span class='label label-info link'><i class='far fa-trash-alt'></i>&nbsp;<i class='fas fa-edit' onclick=''></i>&nbsp;</span>";
            }
            repr+="Q.&nbsp;"+nl2br(val[index]['faq_question'])+" <i style='font-size:6pt'>("+formatDate(val[index]['faq_date'])+")</i></dt>";
            repr+="<dd style='background-color:lightgrey'>"+nl2br(val[index]['faq_response'])+"</dd></dl>";
        }
        getElement("faqs").innerHTML=repr;
    }
    else {
        getElement("faqs").innerHTML="<div class='alert alert-warning'><h3>Aucun résultat</h3></div>";
    }
}

function submitFAQ(laForm) {
    var tabData = recup_formulaire(laForm, 'faq');
    console.log(tabData);
    x_action_insertFaq(tabToString(tabData), display_create);
    return false;
}

function display_create(val) {
    x_return_faqs("", approved, display_faqs);
}