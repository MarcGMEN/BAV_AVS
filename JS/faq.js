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
            if (ADMIN) {
                if (val[index]['faq_approved'] == "0") {
                    repr+="<div class='alert-danger'>"
                }
                else {
                    repr+="<div class='alert-success'>"
                }
            
                repr+="<div class='alert alert-info '>"+
                    "<i class='far fa-trash-alt link' title='Supprimer la question/réponse' "+
                        " onclick='deleteFaq("+val[index]['faq_id']+")'></i>&nbsp;"+
                    "<i class='link fas fa-edit' title='Modifier la question/réponse' "+
                        " onclick='updateFaq("+val[index]['faq_id']+")'></i>&nbsp;";
                if (val[index]['faq_approved'] == "1") {
                    repr+="&nbsp;<i class='link far fa-check-square' title='Désactiver la question/réponse'"+
                    " onclick='desactiveFaq("+val[index]['faq_id']+")'></i>&nbsp;";
                }
                else {
                    repr+="&nbsp;<i class='link far fa-square' title='Activer la question/réponse' "+
                            " onclick='activeFaq("+val[index]['faq_id']+")'></i>&nbsp;";
                }
                repr+="</div>";
                
            }
            else {
                repr+="<div>"
            }
            repr+="<dl>";
            repr+="<dt id='question_"+val[index]['faq_id']+"' >Q.&nbsp;"+val[index]['faq_question']+
                    " <i style='font-size:6pt'>("+formatDate(val[index]['faq_date'])+")</i></dt>";
            repr+="<dd style='background-color:lightgrey' id='reponse_"+val[index]['faq_id']+"'>"+val[index]['faq_response']+"</dd></dl>";
            if (ADMIN) {
                repr+="<div id='reponse_edit_"+val[index]['faq_id']+"'  style='display:none'>";
                repr+="<i class='fas fa-save link' title='sauver la réponse' "+
                    "onclick='saveEditor(CKEDITOR.instances.edit_faq_Q"+val[index]['faq_id']+".getData(), CKEDITOR.instances.edit_faq_R"+val[index]['faq_id']+".getData(),"+val[index]['faq_id']+")'></i>&nbsp;";
		        repr+="<i class='fas fa-times link' title='fermer' onclick='closeEditor("+val[index]['faq_id']+")'></i>";	
                repr+="<textarea style='width:100%' rows=5 id='edit_faq_Q"+val[index]['faq_id']+"' contenteditable='true'>"+
                    val[index]['faq_question']+"</textarea>";
                repr+="<textarea style='width:100%' rows=5 id='edit_faq_R"+val[index]['faq_id']+"' contenteditable='true'>"+
                    val[index]['faq_response']+"</textarea>";
                repr+="</div>";
            }
            repr+="</div><br/>";
        }
        getElement("faqs").innerHTML=repr;
    }
    else {
        getElement("faqs").innerHTML="<div class='alert alert-warning'><h3>Aucun résultat</h3></div>";
    }
}

function submitFAQ(laForm) {
    var tabData = recup_formulaire(laForm, 'faq');
    tabData['faq_question']=CKEDITOR.instances.edit_faq.getData();
    x_action_insertFaq(tabToString(tabData), display_create);
    return false;
}

function display_create(val) {
    messageVente = "<div class='alert alert-success'>Votre question est enregistré, nous vous "+
        " répondrons dans les meilleurs délais.<br/>merci. </div>";
    if (messageVente != "") {
        alertModalInfo(messageVente);
    }
    var data=Array();
    data['faq_email']="";
    data['faq_name']="";
    data['faq_question']="";
    display_formulaire(data, formFaq);
    x_return_faqs("", approved, display_faqs);
    window.location.href="#top";
}

var id=0;
function deleteFaq(idFaq) {
    id=idFaq;
    alertModalConfirm('Suppression de ce faq', "Supp");
}
/**click sur btn cofirm de modalFiche */
function confirmModalSupp() {
    x_action_deleteFaq(id, initPage);
}

function activeFaq(id) {
    var data={'faq_id':id, 'faq_approved':'1'};
    x_action_updateFaq(tabToString(data), initPage);
}
function desactiveFaq(id) {
    var data={'faq_id':id, 'faq_approved':'0'};
    x_action_updateFaq(tabToString(data), initPage);
}

function updateFaq(id) {
    getElement('reponse_'+id).style.display='none';
    getElement('question_'+id).style.display='none';
    console.log(id);
    getElement('reponse_edit_'+id).style.display='block';
    CKEDITOR.replace("edit_faq_R"+id );
    CKEDITOR.replace("edit_faq_Q"+id );

    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
	CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;
}

function closeEditor(id) {
    getElement('reponse_'+id).style.display='block';
    getElement('question_'+id).style.display='block';
    getElement('reponse_edit_'+id).style.display='none';
    
}


function saveEditor(question, reponse, id) {
    var data={'faq_id':id, 'faq_response':reponse,'faq_question':question};
    x_action_updateFaq(tabToString(data), initPage);
}

    

