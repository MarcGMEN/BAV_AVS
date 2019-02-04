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
var typeACT ="PRESSE";
var gSearch=""

function initPage() {
    x_return_actus("", approved, typeACT , display_acts);
}

function unloadPage() {

}

function search(search) {
    gSearch = search;
    x_return_actus(noAccent(search), approved, typeACT ,display_acts);
}

function display_acts(val) {
    console.log(val);
    if (val instanceof Object && !objectIsEmpty(val)) {
        var repr="<div class='row'>";
        var annee="";
        for (index in val) {

            if (annee != val[index]['act_numero_bav'] ) {
                repr+="</div>";
                repr+="<div class=titreFiche>"+val[index]['act_numero_bav']+"</div>";
                repr+="<div class='row'>";
            }
            annee = val[index]['act_numero_bav'];
            
            if (gSearch) {
                val[index]['act_titre'] = val[index]['act_titre'].replace(new RegExp(gSearch, 'ig'), "<b style='color:BLUE'>"+gSearch+"</b>");
            }

            repr+="<div class='col-md-4 col-sm-6 col-xs-12'>";
            if (ADMIN) {
                if (val[index]['act_active'] == "0") {
                    repr+="<div class='alert-danger'>"
                }
                else {
                    repr+="<div class='alert-success'>"
                }
            
                repr+="<div class='alert alert-info '>"+
                    "<i class='far fa-trash-alt link' title='Supprimer la question/réponse' "+
                        " onclick='deleteActu("+val[index]['act_id']+")'></i>&nbsp;"+
                    "<i class='link fas fa-edit' title='Modifier la question/réponse' "+
                        " onclick='updateActu("+val[index]['act_id']+")'></i>&nbsp;";
                if (val[index]['act_active'] == "1") {
                    repr+="&nbsp;<i class='link far fa-check-square' title='Désactiver la question/réponse'"+
                    " onclick='desactiveActu("+val[index]['act_id']+")'></i>&nbsp;";
                }
                else {
                    repr+="&nbsp;<i class='link far fa-square' title='Activer la question/réponse' "+
                            " onclick='activeActu("+val[index]['act_id']+")'></i>&nbsp;";
                }
                repr+="</div>";
                
            }
            else {
                repr+="<div>"
            }
            repr+="<h3 id='question_"+val[index]['act_id']+"' >&nbsp;"+val[index]['act_titre']+
                    " <i style='font-size:6pt'>("+formatDate(val[index]['act_date'])+")</i></h3>";
            repr+="<div style='background-color:lightgrey' id='reponse_"+val[index]['act_id']+"'>"+val[index]['act_blob']+"</div>";
            if (ADMIN) {
                repr+="<div id='reponse_edit_"+val[index]['act_id']+"'  style='display:none'>";
                repr+="<i class='fas fa-save link' title='sauver la réponse' "+
                    "onclick='saveEditor(CKEDITOR.instances.edit_act_Q"+val[index]['act_id']+".getData(), CKEDITOR.instances.edit_act_R"+val[index]['act_id']+".getData(),"+val[index]['act_id']+")'></i>&nbsp;";
		        repr+="<i class='fas fa-times link' title='fermer' onclick='closeEditor("+val[index]['act_id']+")'></i> Modification de l'article";	
                repr+="<textarea style='width:100%' rows=2 id='edit_act_Q"+val[index]['act_id']+"' contenteditable='true'>"+
                    val[index]['act_titre']+"</textarea>";
                repr+="<textarea style='width:100%' rows=5 id='edit_act_R"+val[index]['act_id']+"' contenteditable='true'>"+
                    val[index]['act_blob']+"</textarea>";
                repr+="</div>";
            }
            repr+="</div><br/>";
            repr+="</div >";
        }
        repr+="</div >";
        getElement("actus").innerHTML=repr;
    }
    else {
        getElement("actus").innerHTML="<div class='alert alert-warning'><h3>Aucun résultat</h3></div>";
    }
}

function submitPresse(laForm) {
    var tabData = recup_formulaire(laForm, 'act');
    tabData['act_titre']=CKEDITOR.instances.edit_act.getData();
    tabData['act_blob']=CKEDITOR.instances.edit_act_article.getData();
    console.log(tabData);
    x_action_insertActuPRESSE(tabToString(tabData), display_create);
    return false;
}

function display_create(val) {
    var data=Array();
    data['act_email']="";
    data['act_titre']="";
    data['act_blob']="";
    getElement('edit_act').innerHTML="";
    getElement('edit_act_article').innerHTML="";
    display_formulaire(data, formPresse);
    x_return_actus("", approved, typeACT, display_acts);
    window.location.href="#top";
}

var id=0;
function deleteActu(idActu) {
    id=idActu;
    alertModalConfirm('Suppression de cet article', "Supp");
}
/**click sur btn cofirm de modalFiche */
function confirmModalSupp() {
    x_action_deleteActu(id, initPage);
}

function activeActu(id) {
    var data={'act_id':id, 'act_active':'1'};
    x_action_updateActu(tabToString(data), initPage);
}
function desactiveActu(id) {
    var data={'act_id':id, 'act_active':'0'};
    x_action_updateActu(tabToString(data), initPage);
}

function updateActu(id) {
    getElement('reponse_'+id).style.display='none';
    getElement('question_'+id).style.display='none';
    console.log(id);
    getElement('reponse_edit_'+id).style.display='block';
    CKEDITOR.replace("edit_act_R"+id );
    CKEDITOR.replace("edit_act_Q"+id );

    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
	CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;
}

function closeEditor(id) {
    getElement('reponse_'+id).style.display='block';
    getElement('question_'+id).style.display='block';
    getElement('reponse_edit_'+id).style.display='none';
    
}


function saveEditor(question, reponse, id) {
    var data={'act_id':id, 'act_blob':reponse,'act_titre':question};
    x_action_updateActu(tabToString(data), initPage);
}

    

