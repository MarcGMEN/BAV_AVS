function alertModalError(message) {
    getElement('myModal').style.display = "block";

    getElement('modalTitre').className = "BH_MODAL_ERREUR";
    getElement('modalTitre').innerHTML = "Erreur";

    getElement("modalText").innerHTML = message;
    getElement("modalText").innerHTML = "<i class='fa fa-times-circle size-3 close'></i>";
}

function alertModalConfirm(message) {
    getElement('myModal').style.display = "block";

    getElement('modalTitre').innerHTML = "Confirm";

    getElement("modalText").innerHTML = message;

    $repr = "<input type=button value=Confirmer onclick='confirmModal()'>";
    $repr += "&nbsp;&nbsp;&nbsp;&nbsp;<input type=button value=Annuler onclick='annulerModal()'>";
    getElement("modalAction").innerHTML += $repr;
}


function initModal() {
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    if (span) {
        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }
    }
}