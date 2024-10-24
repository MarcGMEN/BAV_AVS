var icon = new GIcon();

var geocoder;
var map;
var center = new GLatLng(47.31765397015263, -2.305026054382324);
var marker;


//d�claration de l'ic�ne pour les clusters
var iconCluster = new GIcon();
iconCluster.shadow = "images/cluster_shadow.png";
iconCluster.shadowSize = new GSize(22, 20);
iconCluster.iconAnchor = new GPoint(13, 25);
iconCluster.infoWindowAnchor = new GPoint(13, 1);
iconCluster.infoShadowAnchor = new GPoint(26, 13);

// d�claration de l'ic�ne pour un marker simple
var iconSingle = new GIcon();
iconSingle.image = "images/single.png";
iconSingle.shadow = "images/single_shadow.png";
iconSingle.iconSize = new GSize(12, 20);
iconSingle.shadowSize = new GSize(22, 20);
iconSingle.iconAnchor = new GPoint(6, 20);
iconSingle.infoWindowAnchor = new GPoint(6, 1);
iconSingle.infoShadowAnchor = new GPoint(13, 13);

icon = new GIcon(G_DEFAULT_ICON);
var texteMarker ="";
function init(){

	    // D�commenter l'�couteur suivant pour recharger la carte apr�s un drag / drop
	    
	   // GEvent.addListener(map,'moveend',function() {
	     // updateMarkers();
	   // });
	 }

function initMap(id, modif) {
	if (GBrowserIsCompatible() && getElement(id)) {
		map = new GMap2(getElement(id));
		// var center = new GLatLng(37.4419, -122.1419);
		map.addControl(new GSmallMapControl());
		// map.addControl(new GLargeMapControl());
		map.addControl(new GScaleControl());
		map.addControl(new GMapTypeControl());
		// map.addControl(new GOverviewMapControl());
		map.setCenter(center, 14);
		
/*	   // Mise � jour de la map
	   updateMarkers();

	   // Recharge la carte apr�s zoom (+ ou -)
	   GEvent.addListener(map,'zoomend',function() {
	     updateMarkers();
	   });
*/
		options = {icon : icon};
		if (modif) {
			options = {draggable : true, icon : icon};
		}
		marker = new GMarker(center, options);

		GEvent.addListener(marker, 'click', function() {
			if (trim(texteMarker).length > 0) {
				marker.openInfoWindowHtml(texteMarker);
			}
		});
		if (modif) {
			GEvent.addListener(marker, "dragstart", function() {
				map.closeInfoWindow();
			});

			GEvent.addListener(marker, "dragend", function() {
				// TODO: save lat and lng
					// marker.openInfoWindowHtml(marker.getLatLng().toString());
					save_position(marker.getLatLng());
				});
		}
		map.addOverlay(marker);

		geocoder = new GClientGeocoder();
	}
	
	return true;
}

function closeMap() {
	GUnload();
}

function makeIcon(image) {
	marker.setImage(image);
}

function setTexteMarker(texte){
	texteMarker=texte;
}

function affMarkerFromLieu(address) {
	display_lieu(address, 0, 0);
}

function affMarkerFromLieu(lat, lng) {
	display_lieu("", lat, lng);
}

// Create one of our tiny markers at the given point.
function modifMarker(point, legende) {
	// marker.openInfoWindowHtml(legende);
	marker.setLatLng(point);
	map.panTo(marker.getLatLng());

	return marker;
}

function addAddressToMap(response) {
	if (!response || response.Status.code != 200) {
		alert("D�sole, on a pas trouv� votre adresse.....");
		modifMarker(center, response.name);
	} else {
		var place = response.Placemark[0];
		var point = new GLatLng(place.Point.coordinates[1],
				place.Point.coordinates[0]);
		// alert("OK en "+point.toString() );
		modifMarker(point, response.name);
	}
}

var commentaire = "";

function display_lieu(address, lat, lng) {
	commentaire = address;
	if (lat && lat != 0 && lng && lng != 0) {
		var point = new GLatLng(lat, lng);
		//alert("avec Lat et Lng");
		modifMarker(point, commentaire);
	} else if (address) {
		//alert("avec "+address);
		geocoder.getLocations(address, addAddressToMap);
	}
}



// CLUSTER

function updateMarkers() {
	   // Mise � z�ro de la map (on efface tout ce qui s'y trouve) 
	   map.clearOverlays();
	   // Cr�ation de l'aire d�limitant les donn�es � afficher (rectangle rouge)
	   // utile en phase de test
	   var allsw = new GLatLng(47.21765397015263, -2.205026054382324);
	   var allne = new GLatLng(47.41765397015263, -2.405026054382324);
	   var allmapBounds = new GLatLngBounds(allsw,allne);

	   // affichage de l'aire d�limitant l'affichage des donn�es (rectangle rouge)
	   // commenter cette ligne pour ne pas l'afficher
	   map.addOverlay(new Rectangle(allmapBounds,3,"#F00",'')); 

	   // D�limitation de la map
	   var mapBounds = map.getBounds();
	   // coordonn�es SW de la map (sur la taille du div id = "map")
	   var sw = mapBounds.getSouthWest();
	   // coordonn�es NE de la map (sur la taille du div id = "map")
	   var ne = mapBounds.getNorthEast();
	   // Size est une aire repr�sentant les dimensions du rectangle de la map en degr�s
	   var size = mapBounds.toSpan(); //retourne un objet GLatLng

	   // cr�� une cellule de 10x10 pour constituer notre "grille"
	   // les cellules de cette grille sont ici affich�es en bleu
	   var gridSize = 10;
	   var gridCellSizeLat = size.lat()/gridSize;
	   var gridCellSizeLng = size.lng()/gridSize;
	   // cellGrid repr�sente un tableau qui contiendra l'ensemble
	   // des cellules dans lesquelles se trouveront des points
	   // - dans notre exemple, nous aurons 19 cellules (rectangles bleus)
	   var cellGrid = [];

	   //Parcourt l'ensemble des points et les assigne � la cellule concern�e
	   for (k in points) {
	     var latlng = new GLatLng(points[k].lat,points[k].lng);

	     // on v�rifie si le point appartient � notre zone
	     // la zone correspond � la map totale affich�e
	     // si le point n'appartient pas la map en cours on passe au point siuvant
	     if(!mapBounds.contains(latlng)) continue;

	     // On cr�� un rectangle temporaire en fonction des coordonn�es
	     // du point et de celles de la map afin d'obtenir notre cellule (cell)
	     var testBounds = new GLatLngBounds(sw,latlng);
	     var testSize = testBounds.toSpan();
	     var i = Math.ceil(testSize.lat()/gridCellSizeLat);
	     var j = Math.ceil(testSize.lng()/gridCellSizeLng);
	     // cell peut �tre compar�e � une case d'�chiquier
	     var cell = new Array(i,j);

	     // Si cette case (cellule) n'a pas encore �t� cr��e (undefined)
	     // on l'ajoute � notre grille ( = tableau de cellules = �chiquier)
	     if(typeof cellGrid[cell] == 'undefined') {

	       var lat_cellSW = sw.lat()+((i-1)*gridCellSizeLat);
	       var lng_cellSW =  sw.lng()+((j-1)*gridCellSizeLng);
	       // coordonn�es sud-ouest de notre cellule
	       var cellSW = new GLatLng(lat_cellSW, lng_cellSW);

	       var lat_cellNE = cellSW.lat()+gridCellSizeLat
	       var lng_cellNE =  cellSW.lng()+gridCellSizeLng;
	       // coordonn�es nord-est de notre cellule
	       var cellNE = new GLatLng(lat_cellNE, lng_cellNE);

	       // D�claration de la cellule et de ses propri�t�s (cluster ou non, points ...)
	       cellGrid[cell] = {
	         GLatLngBounds : new GLatLngBounds(cellSW,cellNE),
	           cluster : false,
	           markers:[], lt:[], lg:[], titre:[], adresse:[], image:[],
	           length: 0
	       };

	       // Ajoute la cellule (rectangle bleu) � la carte
	       // utile en phase de test
	       map.addOverlay(new Rectangle(cellGrid[cell].GLatLngBounds,1,"#00F",''));
	     }  

	     // augmentation du nombre de cellules sur la grille ( = 1 cellule en plus)
	     cellGrid[cell].length++;

	     // Si la cellule contient au moins 2 points, nous d�cidons ici
	    // que les markers seront clust�ris�s pour cette cellule
	     if(cellGrid[cell].markers.length > 1)
	       // On passe alors � true la propri�t� cluster de la cellule
	       cellGrid[cell].cluster = true;

	     // On lui renseigne ensuite les propri�t�s du point concern�
	     cellGrid[cell].lt.push(points[k].lat);
	     cellGrid[cell].lg.push(points[k].lng);
	     cellGrid[cell].markers.push(latlng);
	     cellGrid[cell].titre.push(points[k].Titre);
	     cellGrid[cell].adresse.push(points[k].Adresse);
	     cellGrid[cell].image.push(points[k].Image);
	   }

	   // On parcourt l'ensemble des cellules de notre grille (cases de l'�chiquier)
	   for (k in cellGrid) {
	     // Si les markers de la cellule doivent appara�tre sous forme de cluster
	     if(cellGrid[k].cluster == true) {
	       // cr�ation d'un marker au centre de la cellule
	       var span = cellGrid[k].GLatLngBounds.toSpan();
	       var sw = cellGrid[k].GLatLngBounds.getSouthWest();
	       var swLAT_span = sw.lat()+(span.lat()/2);
	       var swLNG_span = sw.lng()+(span.lng()/2);
	       var marker = createMarker(new GLatLng(swLAT_span,swLNG_span),'c',cellGrid[k]);
	     } else {
	       // Sinon, cr�ation d'un marker simple
	       var marker
	       for(i in cellGrid[k].markers)
	         marker = createMarker(cellGrid[k].markers[i],'p',cellGrid[k]);
	     }
	   }
	 }


function createMarker(point, type,infoMarker) {
	   // Si le marker repr�sente plusieurs points (cluster)
	   if(type=='c') {
	    // Pour d�finir le marker du cluster, nous faisons appel � un script PHP,
	    // non d�taill� ici, charg� de r�cup�rer le nombre de markers concern�s par ce cluster,
	    // infoMarker.length.
	    // Nous cr�ons alors un cercle � l'aide la librairie GD2 du php
	    // qui aura une couleur et une taille d�finies en fonction du nombre de markers.
	     iconCluster.image = 'http://www.weboblog.fr/icone-marker.php?nb='+infoMarker.length;
	     var marker = new GMarker(point,iconCluster);
	   } else
	     // Sinon, il s'agit d'un marker isol� (simple)
	     var marker = new GMarker(point,iconSingle);

	   // On ajoute le marker � la map 
	   map.addOverlay(marker);
	   // avec son �couteur d'�v�nement 
	   clickMarker(marker,infoMarker);
	 }

	 // fonction �couteur d'�v�nement pour un marker 
	 function clickMarker(marker,infoMarker){
	   var info = (infoMarker.length < 2) ? '' : infoMarker.length+' r�sultats <br />';
	   GEvent.addListener(marker, "click", function() {
	     // ici, contenu de l'infobulle = listing des r�sultats 
	     for(var n = 0; n < infoMarker.length; n++)
	       info += infoMarker.titre[n]+'<br />';
	     marker.openInfoWindowHtml(info);
	   });
	 }

	 // Definition de l'objet RECTANGLE pour les phases de d�veloppement / debugging ...

	 function Rectangle(bounds, opt_weight, opt_color, opt_html) {
	   this.bounds_ = bounds;
	   this.weight_ = opt_weight || 1;
	   this.html_ = opt_html || "";
	   this.color_ = opt_color || "#888888";
	 }

	 Rectangle.prototype = new GOverlay();

	 Rectangle.prototype.initialize = function(map) {
	   var div = document.createElement("div");
	   div.innerHTML = this.html_;
	   div.style.border = this.weight_ + "px solid " + this.color_;
	   div.style.position = "absolute";
	   map.getPane(G_MAP_MAP_PANE).appendChild(div);
	   this.map_ = map;
	   this.div_ = div;
	 }

	 Rectangle.prototype.remove = function() { this.div_.parentNode.removeChild(this.div_); }
	 Rectangle.prototype.copy = function() {
	   return new Rectangle(
	     this.bounds_,
	     this.weight_,
	     this.color_,
	     this.backgroundColor_,
	     this.opacity_
	   );
	 }

	 Rectangle.prototype.redraw = function(force) {
	   if (!force) return;
	   var c1 = this.map_.fromLatLngToDivPixel(this.bounds_.getSouthWest());
	   var c2 = this.map_.fromLatLngToDivPixel(this.bounds_.getNorthEast());
	   this.div_.style.width = Math.abs(c2.x - c1.x) + "px";
	   this.div_.style.height = Math.abs(c2.y - c1.y) + "px";
	   this.div_.style.left = (Math.min(c2.x, c1.x) - this.weight_) + "px";
	   this.div_.style.top = (Math.min(c2.y, c1.y) - this.weight_) + "px";
	 }
	 
	   function distHaversine(p1, p2) {
	     var R = 6371; 
	     var dLat  = p2.lat - p1.lat;
	     var dLong = p2.lon - p1.lon;

	     var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
	             Math.cos(p1.lat) * Math.cos(p2.lat) * Math.sin(dLong/2) * Math.sin(dLong/2);
	     var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
	     var d = R * c;
	   
	     return d;
	   }
	 
