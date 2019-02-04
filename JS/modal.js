function alertModalWarnTimeout(message, timeSec) { 
    alertModalWarn(message);
    setTimeout(function() {closeModal()},timeSec*1000);
}
function alertModalWarn(message) { 
    // Get the <span> element that closes the modal
    var span = getElement("closeModal");

    if (span) {
        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
           closeModal();
        }
    }
    getElement('myModal').style.display = "block";

    getElement('id_bh_modal').className = "BH_MODAL_ERR";
    getElement('modalTitre').innerHTML = "Erreur";
    getElement("modalClose").innerHTML = "<i class='fa fa-times-circle size-3 close' id=closeModal></i>";

    getElement("modalText").innerHTML = message;
}

function alertModalInfoTimeout(message,timeSec) {
    alertModalInfo(message);
    setTimeout(function() {closeModal()},timeSec*1000);
}

function alertModalInfo(message) {
      // Get the <span> element that closes the modal
      var span = getElement("closeModal");

      if (span) {
          // When the user clicks on <span> (x), close the modal
          span.onclick = function () {
             closeModal();
          }
      }
      getElement('myModal').style.display = "block";
  
      getElement('id_bh_modal').className = "BH_MODAL";
      getElement('modalTitre').innerHTML = "Info";
      getElement("modalClose").innerHTML = "<i class='fa fa-times-circle size-3 link' onclick='closeModal()'></i>";
  
      getElement("modalText").innerHTML = message;  
}

function alertModalError(message) { 
    // Get the <span> element that closes the modal
    var span = getElement("closeModal");

    if (span) {
        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
           closeModal();
        }
    }
    getElement('myModal').style.display = "block";

    getElement('id_bh_modal').className = "BH_MODAL_ERR";
    getElement('modalTitre').innerHTML = "Erreur";
    getElement("modalClose").innerHTML = "<i class='fa fa-times-circle size-3 close' id=closeModal></i>";

    getElement("modalText").innerHTML = message;
    
}

function alertModalPass() { 
    // Get the <span> element that closes the modal
    var span = getElement("closeModal");

    if (span) {
        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
           closeModal();
        }
    }
    getElement('myModal').style.display = "block";

    getElement('modalTitre').innerHTML = "Connexion";
    getElement("modalClose").innerHTML = "<i class='fa fa-times-circle size-3 close' id=closeModal></i>";

    getElement("modalText").innerHTML = "<h3>Connexion admin</h3><input type=password name=pass required>" 
    
    $repr = "<input type=button value=Confirmer onclick='searchStyle();confirmPass();closeModal()'>";
    $repr += "&nbsp;&nbsp;&nbsp;&nbsp;<input type=button value=Annuler onclick='closeModal()'>";
    getElement("modalAction").innerHTML = $repr;
}

/**
 * fenetre de confirmatio
 * @param {} message 
 * @param {*} plus 
 */
function alertModalConfirm(message, plus='') {
    getElement('myModal').style.display = "block";

    getElement('modalTitre').innerHTML = "Confirmation";

    console.log(message);
    getElement("modalText").innerHTML = message;

    $repr = "<input type=button value=Confirmer onclick='searchStyle();confirmModal"+plus+"();closeModal()'>";
    $repr += "&nbsp;&nbsp;&nbsp;&nbsp;<input type=button value=Annuler onclick='closeModal()'>";
    getElement("modalAction").innerHTML = $repr;
}

function alertModalConfirmForm(message, plus='') {
    getElement('myModal').style.display = "block";

    getElement('modalTitre').innerHTML = "Confirmation du formulaire";

    getElement("modalText").innerHTML = message;

    $repr = "<button>Confirmer</button> ";
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
    console.log('submitFormModal');
    searchStyle();
    confirmModalForm();
    return false;
}