
/**
 * Modal d'un warn avec timeout
 * @param {*} message 
 * @param {*} timeSec 
 */
function alertModalWarnTimeout(message, timeSec) { 
    alertModalWarn(message);
    setTimeout(function() {closeModal()},timeSec*1000);
}
/**
 * modal d'un warn avec fermeture par la croix
 * @param {} message 
 */
function alertModalWarn(message) { 

    getElement('myModal').style.display = "block";

    getElement('id_bh_modal').className = "BH_MODAL_ERR";
    getElement('modalTitre').innerHTML = "Erreur";
    getElement("modalClose").innerHTML = "<i class='fa fa-times-circle size-3 close' onclick='closeModal()'></i>";

    getElement("modalText").innerHTML = message;
}

/**
 * modal d'une info avec un timeout
 * @param {*} message 
 * @param {*} timeSec 
 */
function alertModalInfoTimeout(message,timeSec) {
    alertModalInfo(message);
    setTimeout(function() {closeModal()},timeSec*1000);
}

/**
 * modal d'une info avec fermeture par la croix
 * @param {*} message 
 */
function alertModalInfo(message) {

      getElement('myModal').style.display = "block";
  
      getElement('id_bh_modal').className = "BH_MODAL";
      getElement('modalTitre').innerHTML = "Information";
      getElement("modalClose").innerHTML = "<i class='fa fa-times-circle size-3 link' onclick='closeModal()'></i>";
  
      getElement("modalText").innerHTML = message;  
      
      $repr = "<input type=button value=Fermer onclick='closeModal()'>";
      getElement("modalAction").innerHTML = $repr;
}

/**
 * modal d'une erreur avec fermeture par la croix
 * @param {*} message 
 */
function alertModalError(message) { 
    getElement("modalClose").innerHTML = "<i class='fa fa-times-circle size-3 close' onclick='closeModal()'></i>";

    getElement('myModal').style.display = "block";

    getElement('id_bh_modal').className = "BH_MODAL_ERR";
    getElement('modalTitre').innerHTML = "Erreur";
    
    getElement("modalText").innerHTML = message;
    
}

/**
 * modal de saisie du mot de passe
 */
function alertModalPass() { 
    getElement('id_bh_modal').className = "BH_MODAL";
    getElement('myModal').style.display = "block";

    getElement('modalTitre').innerHTML = "Connexion";
    getElement("modalClose").innerHTML = "<i class='fa fa-times-circle size-3 close' onclick='closeModal()'></i>";

    getElement("modalText").innerHTML = "<h3>Connexion admin ou table ["+ipLocal+"]</h3><input type=password name=pass required>" 
    
    $repr = "<input type=button value=Confirmer onclick='searchStyle();confirmPass();closeModal()'>";
    $repr += "&nbsp;&nbsp;&nbsp;&nbsp;<input type=button value=Annuler onclick='closeModal()'>";
    getElement("modalAction").innerHTML = $repr;
}

/**
 * fenetre de confirmatio
 * @param {} message 
 * @param {*} plus 
 */
function alertModalConfirm(message, plus='',titre="Confirmation") {

    getElement('id_bh_modal').className = "BH_MODAL";
    getElement('myModal').style.display = "block";

    getElement('modalTitre').innerHTML = titre;

    //console.log(message);
    getElement("modalText").innerHTML = message;

    document.modalForm.onsubmit = function(){
        searchStyle();
        confirmModal(plus);
        closeModal(); 
        return false;
    };
    
    $repr = "<input type=submit value=Confirmer>";
    $repr += "&nbsp;&nbsp;&nbsp;&nbsp;<input type=button value=Annuler onclick='closeModal()'>";
    getElement("modalAction").innerHTML = $repr;
}

function searchStyle() {
    getElement('modalAction').innerHTML="<img src='Images/spinner_white_tiny.gif' />";
}

function  closeModal() {
     // Get the modal
     var modal = getElement('myModal');
     modal.style.display = "none";
}

function submitFormModal() {
    searchStyle();
    confirmModalForm();
    return false;
}