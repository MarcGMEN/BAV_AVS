function alertModalWarnTimeout(message) { 
    // Get the <span> element that closes the modal
    var span = getElement("closeModal");

    if (span) {
        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
           closeModal();
        }
    }
    getElement('myModal').style.display = "block";

    getElement('modalTitre').className = "BH_MODAL_ERR";
    getElement('modalTitre').innerHTML = "Erreur";
    getElement("modalClose").innerHTML = "<i class='fa fa-times-circle size-3 close' id=closeModal></i>";

    getElement("modalText").innerHTML = message;

    setTimeout(closeModal(),3*1000);
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
  
      getElement('modalTitre').className = "BH_MODAL";
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

    getElement('modalTitre').className = "BH_MODAL_ERR";
    getElement('modalTitre').innerHTML = "Erreur";
    getElement("modalClose").innerHTML = "<i class='fa fa-times-circle size-3 close' id=closeModal></i>";

    getElement("modalText").innerHTML = message;
    
}

/**
 * fenetre de confirmatio
 * @param {} message 
 * @param {*} plus 
 */
function alertModalConfirm(message, plus='') {
    getElement('myModal').style.display = "block";

    getElement('modalTitre').innerHTML = "Confirmation";

    getElement("modalText").innerHTML = message;

    $repr = "<input type=button value=Confirmer onclick='searchStyle();confirmModal"+plus+"()'>";
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