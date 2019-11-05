// On initialise la latitude et la longitude de Paris (centre de la carte)
var lat = 47.271469;
var lon = -2.229505;
var macarte = null;
var markerClusters;
// Servira à stocker les groupes de marqueurs
// Nous définissons le dossier qui contiendra les marqueurs

var markers = []; // Nous initialisons la liste des marqueurs

// Fonction d'initialisation de la carte
function initMap() {

    markerClusters = L.markerClusterGroup(); // Nous initialisons les groupes de marqueurs
    // Nous définissons le dossier qui contiendra les marqueurs

    // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
    macarte = L.map('map').setView([lat, lon], 11);
    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
        minZoom: 1,
        maxZoom: 20
    }).addTo(macarte);

    //macarte.addLayer(markerClusters);
}


function geoPosClient(adress, unique = true, group = true) {
    var iconBase = 'Images/logoAVS.png';
    var myIcon = L.icon({
        iconUrl: iconBase,
        iconSize: [30, 20],
        iconAnchor: [0, 0],
        popupAnchor: [-3, -3],
    });
    var geocoder = L.Control.Geocoder.nominatim();

    console.log("geoPosClient(" + adress + ")");
    geocoder.geocode(adress + ', France',
        function (results) {
            console.log(results);
            var r = results[0];
            if (r) {
                var marker1 = L.marker(r.center, { icon: myIcon })
                    
                    .bindPopup(r.name);
                markers.push(marker1);
                if (group) {
                    markerClusters.addLayer(marker1);
                }
                else {
                    marker1.addTo(macarte);
                }
                if (unique) {
                    initMap();
                    macarte.setView(r.center, 14);
                }
                else {
                    afficheGroup();
                }
            }
        });

}


function afficheGroup() {
    var group = new L.featureGroup(markers); // Nous créons le groupe des marqueurs pour adapter le zoom
    // Nous demandons à ce que tous les marqueurs soient visibles, 
    //et ajoutons un padding (pad(0.5)) pour que les marqueurs ne soient pas coupés
    macarte.fitBounds(group.getBounds().pad(0.1));
}