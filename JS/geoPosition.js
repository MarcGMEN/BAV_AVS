// On initialise la latitude et la longitude de st nazaire (centre de la carte)
var lat = 47.271469;
var lon = -2.229505;
var macarte = null;
var markerClusters;

var tabDistanceCDP = [];

var geocoder = L.Control.Geocoder.nominatim();

// Servira à stocker les groupes de marqueurs
// Nous définissons le dossier qui contiendra les marqueurs

var markers = []; // Nous initialisons la liste des marqueurs

var markerBAV;

// Fonction d'initialisation de la carte
function initMap() {

    markerClusters = L.markerClusterGroup(); // Nous initialisons les groupes de marqueurs
    // Nous définissons le dossier qui contiendra les marqueurs

    // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
    macarte = L.map('map', {
        fullscreenControl: true,
    }).setView([lat, lon], 11);

    // macarte.addControl(new L.Control.Fullscreen());

    // // create a fullscreen button and add it to the map
    // L.control.fullscreen({
    //     position: 'topleft', // change the position of the button can be topleft, topright, bottomright or bottomleft, default topleft
    //     title: 'Show me the fullscreen !', // change the title of the button, default Full Screen
    //     titleCancel: 'Exit fullscreen mode', // change the title of the button when fullscreen is on, default Exit Full Screen
    //     content: null, // change the content of the button, can be HTML, default null
    //     forceSeparateButton: true, // force separate button to detach from zoom buttons, default false
    //     forcePseudoFullscreen: true, // force use of pseudo full screen even if full screen API is available, default false
    //     fullscreenElement: false // Dom element to render in full screen, false by default, fallback to map._container
    // }).addTo(map);

    // // events are fired when entering or exiting fullscreen.
    // macarte.on('enterFullscreen', function () {
    //     console.log('entered fullscreen');
    // });

    // macarte.on('exitFullscreen', function () {
    //     console.log('exited fullscreen');
    // });

    // // you can also toggle fullscreen from map object
    // macarte.toggleFullscreen();


    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
        // fullscreenControl: true,

        // scaleControl: true,
        minZoom: 1,
        maxZoom: 20
    }).addTo(macarte);


    var myIconBAV = L.icon({
        iconUrl: 'Images/BAV_2020.png',
        iconSize: [30, 30],
    });
    markerBAV = L.marker([lat, lon], { icon: myIconBAV });
    markerBAV.addTo(macarte);
    L.circle([lat, lon], 30000).addTo(macarte);

    //macarte.addLayer(markerClusters);
}

function getGeoPos(adress) {
    var geoCode = geocoder.geocode(adress + ', France', function (results) {
        return results;
    });

    return geoCode;
}

function geoPosClient(adress) {

    console.log("geoPosClient(" + adress + ")");

    //var results = getGeoPos(adress);
    geocoder.geocode(adress + ', France',
        function (results) {
            var r = results[0];
            if (r) {
                console.log("geoPosClient(" + adress + ") => OK");
                tabDistanceCDP[adress] = distanceHaversine(lat, lon, r.properties.lat, r.properties.lon);
                tabCdpLatLon[adress] = r.properties.lat + ","+ r.properties.lon;
                x_add_cdp(adress, r.properties.lat, r.properties.lon, display_vide);
            }
        });
    
    x_add_cdp(adress, 47, -2, display_vide);
}

function addMarker(lat, lon, adress, info) {
    var iconBase = 'Images/logoAVS.png';

    widthIcon = 30;
    heightIcon = 20;
    // if  (info && Number.isInteger(info)) {
    //     widthIcon+=info*2;
    //     heightIcon+=info*2;
    // }
    var myIcon = L.icon({
        iconUrl: iconBase,
        iconSize: [widthIcon, heightIcon],
        iconAnchor: [widthIcon / 2, heightIcon / 2],
        popupAnchor: [-3, -3],
    });

    //var marker1 = L.marker(r.center, { icon: myIcon });
    var marker1 = L.marker([lat, lon], { icon: myIcon });
    marker1.bindPopup('<strong>' + adress + " : </strong><br/>" + parseInt(tabDistanceCDP[adress]) + ' km').openPopup();
    markers.push(marker1);

    // if (group) {
    //     markerClusters.addLayer(marker1);
    // } else {
    marker1.addTo(macarte);
    // }
    // if (unique) {
    // macarte.setView([lat, lon], 14);
    // } else {
    afficheGroup();
    // }

}

function display_vide(val) {

}


function afficheGroup() {
    var group = new L.featureGroup(markers); // Nous créons le groupe des marqueurs pour adapter le zoom
    // Nous demandons à ce que tous les marqueurs soient visibles, 
    //et ajoutons un padding (pad(0.5)) pour que les marqueurs ne soient pas coupés
    macarte.fitBounds(group.getBounds().pad(0.1));
}

function distanceHaversine(lat1, lon1, lat2, lon2) {
    const earthRadius = 6371; // Rayon moyen de la Terre en kilomètres

    // Conversion des degrés en radians
    const lat1Rad = (lat1 * Math.PI) / 180;
    const lon1Rad = (lon1 * Math.PI) / 180;
    const lat2Rad = (lat2 * Math.PI) / 180;
    const lon2Rad = (lon2 * Math.PI) / 180;

    // Calcul des écarts de latitude et de longitude
    const dLat = lat2Rad - lat1Rad;
    const dLon = lon2Rad - lon1Rad;

    // Formule de la distance haversine
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1Rad) * Math.cos(lat2Rad) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    // Calcul de la distance en kilomètres
    const distance = earthRadius * c;

    return distance;
}