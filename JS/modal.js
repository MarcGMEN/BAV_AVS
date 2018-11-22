function alertModalError(message) {
    getElement('myModal').style.display = "block";
    getElement('modalWind').className += " error";
    getElement('modalTitre').className = "BH_CADRE";
    getElement('modalTitre').innerHTML = "<h3>Erreur</h3>";
    getElement("modalText").innerHTML = message;
}

function initModal() {
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }
}