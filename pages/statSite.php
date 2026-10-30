<script>
	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = {};
	var anneeBav = '<?= $infAppli['numero_bav'] ?>';
	var dateDeb;
	var dateFin;

	function initPage() {
		if (ADMIN) {
			x_return_allParametre(display_parametres);
			x_return_byTree(display_actions)
		} else {
			// si pas ADMIN retour page accueil
			goTo();
		}
	}

	function changeNumeroBAV(val) {
		SetCookie("par_numero_bav_stat", val);
		goTo('statSite.php');
	}

	function display_parametres(val) {
		// console.log(val);
		var select = getElement("annee_stat");
		select.options[select.options.length] = new Option("Choix", "*");
		for (index in val) {
			select.options[select.options.length] = new Option(val[index]['par_numero_bav'] + "-" + val[index]['par_titre'], val[index]['par_numero_bav']);
			if (anneeBav == index) {
				select.options[select.options.length - 1].selected = true;
				dateDeb=new Date(val[index]['par_client_date_debut'] );
				dateDeb.setDate(dateDeb.getDate()-10);
				dateFin=new Date(val[index]['par_date_fin_bav'] );
				dateFin.setDate(dateFin.getDate()+10);
				dateDeb.setHours(0);
				dateFin.setHours(0);
				// console.log(dateDeb,dateFin)
				getElement("dateDeb").innerHTML=dateDeb.toLocaleDateString();
				getElement("dateFin").innerHTML=dateFin.toLocaleDateString()
				dateDeb.setMonth(dateDeb.getMonth()+1);
				dateFin.setMonth(dateFin.getMonth()+1);
			}
		}
	}

	function display_actions(val) {
		var repr = "";
		var tab = tree(val, "", 0);
		tabDates.sort();
		tabDatesTimes.sort();
		repr = tab['repr'];
		getElement('statresult').innerHTML = repr;
	}

	function inverseStat(id) {
		displayId = getElement("div_" + id).style.display
		if (displayId == 'none') {
			getElement("div_" + id).style.display = 'block';
			getElement("croix_" + id).innerHTML = " - ";
		} else {
			getElement("div_" + id).style.display = 'none';
			getElement("croix_" + id).innerHTML = " + ";
		}
	}

	var tabDates = [];
	var tabDatesTimes = [];

	function tree(val, parent, niv) {
		
		var repr = "";
		var nb = 0;
		var dates = [];
		var affiche=1;
		for (var index in val) {
			if (parent == "") {
				dates = [];
			}
			if (!index.match("^(s_)")) {
				repr += "<ul>";
			}
			if (val[index] instanceof Object) {
				// console.log("tree => "+index);
				var idHtml = parent + "-" + index;

				var tab = tree(val[index], idHtml, niv + 1);

				// console.log("test index => "+index+ " affiche "+tab['affiche']);
				
				if (!index.match("^(s_)")) {

					// console.log("Ajout "+index+" en niveau "+niv);
					var lastDate = new Date(Math.max.apply(null, tab['dates']));
					var lastDateFR = lastDate.getDate() + "/" + (lastDate.getMonth() +1) +"/" + lastDate.getFullYear();
					repr += "<div class='row tree" + niv + "'>";
					repr += "<div class='col-xs-5 col-sm-5 col-md-5' >" + index + "</div>";
					if (tab['affiche']==1) {
						repr += "<div class='col-xs-3 col-sm-3 col-md-3 link' onclick=\"inverseStat('" + idHtml + "')\" id='croix_" + idHtml + "'> + </div>";
					}
					else {
						repr += "<div class='col-xs-3 col-sm-3 col-md-3 '>&nbsp;</div>";
					}

					repr += "<div class='col-xs-2 col-sm-2 col-md-2' >Cpt => " + tab['nb'] +" (" +lastDateFR +")</div>";
					repr += "<div class='col-xs-1 col-sm-1 col-md-1 link' onclick=\"dessin('" + idHtml + "',0)\"><img src='Images/statBarre.png' height='20px'/>j</div>";
					// repr += "<div class='col-xs-1 col-sm-1 col-md-1 link' onclick=\"dessin('" + idHtml + "',1)\"><img src='Images/statBarre.png' height='20px'/>j/h</div>";
					repr += "</div>";
					repr += "<div id='div_" + idHtml + "' style=\"display:none\">";
					repr += tab['repr'];
					repr += "</div>";
					affiche=1;
				}
				else {
					// console.log("pas d'affichage de "+index);
					affiche=0;
				}

				// console.log("on a "+sizeof(tab['dates'])+" date pour "+idHtml);
				//console.log(tab['dates']);
				for (var j in tab['dates']) {
					var dateLu = tab['dates'][j];


					//tabDates.push(idHtml);
					// if (debut == null || dates[j] < debut) {
					// 	debut = dates[j];
					// }
					// if (fin == null || dates[j] > fin) {
					// 	fin = dates[j];
					// }


					if (!tabDates[idHtml]) {
						tabDates[idHtml] = [];
					}
					if (!tabDatesTimes[idHtml]) {
						tabDatesTimes[idHtml] = [];
					}

					var keyDate = dateLu.getFullYear() + "-" + (dateLu.getMonth()+1) + "-" + dateLu.getDate();
					var keyDateTime = dateLu.getFullYear() + "-" + (dateLu.getMonth()+1) + "-" + dateLu.getDate() + "-" + dateLu.getHours();
					if (!tabDates[idHtml][keyDate]) {
						tabDates[idHtml][keyDate] = 0;
					}
					if (!tabDatesTimes[idHtml][keyDateTime]) {
						tabDatesTimes[idHtml][keyDateTime] = 0;
					}

					// console.log(idHtml+" "+keyDate+" ("+tabDates[idHtml][keyDate]+") += 1");
					tabDates[idHtml][keyDate] += 1;
					tabDatesTimes[idHtml][keyDateTime] += 1;
				}
				Array.prototype.push.apply(dates, tab['dates']);
				// console.log("on au total "+sizeof(dates)+" date ["+index+"]" );
				if (!index.match("(s_)")) {

					
				}
				nb += tab['nb'];

			} else {
				nb++;
				// repr += "<div class='tree1'>" + index + " => " + val[index] + "</div>";
				dates.push(new Date(index));
				affiche=0;
				// console.log("pas d'affichage de "+index+"  car dates");
			}
			if (!index.match("^(s_)")) {
				repr += "</ul>";
			}
			// console.log(index+ "-> "+repr);

		}
		return {
			repr,
			nb,
			dates,
			affiche
		};
	}

	function redessin(id) {
		dessin(id,0)
	}

	function closeDesin(id) {
		var divCanvas = getElement("divcanvas_" + id);
		if (divCanvas)
			divCanvas.style.display = 'none';

		var monCanvas = getElement("canvas_" + id);
		if (monCanvas) {
			var context = monCanvas.getContext("2d");
			context.beginPath();
			context.clearRect(0, 0, monCanvas.width, monCanvas.height);
			context.closePath();
		}
	}
	var longueur = window.innerWidth * 0.8;
	// var longueur = 150;
	var hauteur = 300;
	var hourG;

	function likekeys(id) {
		// console.log("likekeys " + id + " idDessin " + idDessin);
		return id.match("^(" + idDessin + ")") && id != idDessin && id.match("(-s_)");
	}

	var idDessin = "";
	var tabXYDays = [];

	function dessin(id,hour,dateRef=null) {
		if (hour == 0)
			tabXYDays=[];
		// console.log("dessin " + id + " hour " + hour + " dateRef "+dateRef);
		closeDesin(hour);
		hourG = hour;
		idDessin=id;
		var divCanvas = getElement("divcanvas_" + hour);
		divCanvas.style.display = 'block';
		var titreCanvas = getElement("titre_canvas_" + hour);
		titreCanvas.innerHTML = "Statistique d'accès pour " + id + " " + (hour == 1 ? "du "+dateRef : "" ) ;


		var monCanvas = getElement("canvas_" + hour);
		var ctx = monCanvas.getContext("2d");
		ctx.font = "15px arial";
		monCanvas.width = longueur;

		monCanvas.height = hauteur;


		
		//var nbRow = sizeof(tabDates[id]);

		// console.log(dateDeb);
		//console.log(id);

		var dateDebCanvas = new Date(dateDeb);
		var dateFinCanvas = new Date(dateFin);

		var max = 0

		// console.log(tabDatesTimes);
		var tabDataOS = new Array();
		while(tabDataOS.length > 0) {
			tabDataOS.pop();
		}
		var idsOS = Object.keys(tabDates).filter(likekeys);
		// console.log("idsOS",idsOS);
		for (var idOS in idsOS) {
			var tabId = idsOS[idOS].split('-');
			nameOS = tabId[sizeof(tabId) - 1];
			if (!tabDataOS[nameOS]) {
				tabDataOS[nameOS]=[];
				for (var date in tabDates[idsOS[idOS]]) {
					tabDataOS[nameOS][date] = tabDates[idsOS[idOS]][date];
				}
				if (hour) {
					for (var date in tabDatesTimes[idsOS[idOS]]) {
						tabDataOS[nameOS][date] = tabDatesTimes[idsOS[idOS]][date];
					}
				}
			} else {
				var tabTmp = tabDates[idsOS[idOS]];
				if (hour) {
					tabTmp = tabDatesTimes[idsOS[idOS]];
				}
				for (var date in tabTmp) {
					if (!tabDataOS[nameOS][date]) {
						tabDataOS[nameOS][date] = tabTmp[date];
						tabDataOS[nameOS][date] += tabTmp[date];
					}
				}
			}
		}
		// console.log("tabDataOS",tabDataOS);
		
		var tabData = tabDates[id];
		if (hour) {
			for (var dateHour in tabDatesTimes[id]) {
				if (dateHour.startsWith(dateRef)) {
					tabData[dateHour] = tabDatesTimes[id][dateHour];
				}
			}
			//tabData = tabDatesTimes[id];
			dateDebCanvas = new Date(dateRef);
			dateDebCanvas.setHours(0,0,0,0);
			dateDebCanvas.setMonth(dateDebCanvas.getMonth() + 1);
			dateFinCanvas = new Date(dateRef);
			dateDebCanvas.setHours(0,0,0,0);
			dateFinCanvas.setDate(dateFinCanvas.getDate() + 1);
			dateFinCanvas.setMonth(dateFinCanvas.getMonth() + 1);
		}
		

		var nbRow = Math.floor((dateFinCanvas - dateDebCanvas) / (60 * 60 * 1000));
		if (!hour) {
			var nbRow = Math.floor((dateFinCanvas - dateDebCanvas) / (24 * 60 * 60 * 1000));
		}
		console.log("nbRow " + nbRow);

		/* le contour*/
		// ctx.lineWidth = "2";
		// ctx.beginPath();
		// ctx.strokeStyle = "BLACK";
		// ctx.rect(0, 0, longueur, hauteur)
		// ctx.stroke();
		// ctx.closePath();

		var decal = parseInt(longueur * 0.05);
		var decalOrigine = decal
		// console.log("decal " + decal);
		var largeur = parseInt((longueur - (2 * decal)) / nbRow);
		// console.log("largeur F ", (longueur - (2 * decal)) / nbRow);
		if (largeur <= 0) {
			largeur = 1
		};
		// console.log("max nbrow " + (nbRow * largeur + decal));
		if (nbRow * largeur + decal > longueur) {
			alertModalInfo("Attention vous dépasse la capacité d'affichage 63 jours max");
		}
		if (dateFinCanvas < dateDebCanvas) {
			alertModalInfoTimeout("Attention date de début supérieure à la date de dateFin",1);
		}
		// console.log("longueur " + longueur);
		// console.log("largeur " + largeur);

		var dayBefore;
		var cptHour = 0;
		var cptRow = 0;
		var nbTot=0;
		var nbTotOS=[];

		// console.log("dateDebCanvas",dateDebCanvas);
		var debut=new Date(dateDebCanvas);
		while (debut <= dateFinCanvas) {
			// console.log("debut",debut);
			var keyDate = debut.getFullYear() + "-" + debut.getMonth() + "-" + debut.getDate();
			if (hour) {
				keyDate = keyDate + "-" + debut.getHours();
			}
			// console.log("keyDate",keyDate, debut);
			//for (var date in tabData) {
			var nb = tabData[keyDate];
			if (nb > max) {
				max = nb;
			}
			// console.log(debut, keyDate,nb,max);
			
			//}
			if (hour) {
				var newDate = debut.setHours(debut.getHours() + 1);
			} else {
				var newDate = debut.setDate(debut.getDate() + 1);
			}
			debut = new Date(newDate);
		}

		var dateLu=new Date(dateDebCanvas);
		while (dateLu < dateFinCanvas) {
			var keyDate = dateLu.getFullYear() + "-" + dateLu.getMonth() + "-" + dateLu.getDate();
			var keyDateTime = keyDate + "-" + dateLu.getHours();
			var laDateStr = dateLu.getDate() + "/" + (dateLu.getMonth() );
			var laDateStr2 = dateLu.getDate() + "/" + (dateLu.getMonth() );
			if (hour) {
				var laDate = keyDateTime;
				laDateStr = dateLu.getDate() + "/" + (dateLu.getMonth() );
				laDateStr2 = dateLu.getDate() + "/" + (dateLu.getMonth() )+ " " + dateLu.getHours();
			} else {
				var laDate = keyDate;
			}
			// console.log(laDate);
			var nb = 0;
			// console.log(tabDates);

			var colorOS = {'s_tel': "lightblue", 's_pc':"lightgreen"};
			
			var hc_prec = 0;
			var hc_tot = 0;
			var nbDate = 0;
			if (tabData[laDate]) {
				nbDate = tabData[laDate];
			}
			nbTot+=nbDate;

			for (var OS in tabDataOS) {

				// console.log(OS+" "+laDate+" "+tabDataOS[OS][laDate]);
				// console.log(tabDataOS[OS][laDate]);
				nb = 0;
				if (tabDataOS[OS][laDate]) {
					nb = tabDataOS[OS][laDate];
					if (!nbTotOS[OS]) {
						nbTotOS[OS]=0;
					}
					nbTotOS[OS]+=nb;
				}
				
				// max => 180
				//  nb =  hc
				hc = (hauteur - 30) * nb / max;
				// console.log(hc,nb, max);
				/* Un rectangle de couleur unie */

				ctx.lineWidth = "1";
				// ctx.fillStyle = "lightblue";
				ctx.fillStyle = colorOS[OS];
				// console.log("ctx.fillRect("+decal+", "+(hauteur-hc-10)+", "+largeur+", "+hc+")");
				ctx.fillRect(decal+1, hauteur - hc - 10 - hc_prec, largeur-2, hc-1)
				// ctx.roundRect(decal+1, hauteur - hc - 10 - hc_prec, largeur-2, hc-1,10);
				// drawRoundedRect(ctx,decal+1, hauteur - hc - 10 - hc_prec, largeur-2, hc-1,10);
				// console.log(hauteur, decal, hauteur - hc - 10 - hc_prec, largeur, hc, OS, nb);

				ctx.fillStyle = "BLACK";
				if (nb > 0) {
					ctx.font = "10px arial";
					//var Xlettre = decal + largeur / 2 - 7;
					var Xlettre = decal + largeur/15;
					var Ylettre = hauteur - hc / 2 - hc_prec -10;
					if (largeur > 5) {
						// ctx.fillText(nb + " " + OS.split("_")[1] , Xlettre + largeur/2 -12, Ylettre);
						ctx.fillText(nb , Xlettre + largeur/2-5, Ylettre);
					}
					// console.log("ctx.fillText(" + nb + ", " + Xlettre + ", " + Ylettre + ")");
				}
				ctx.fillStyle = "BLACK";
				hc_prec = hc;
				hc_tot += hc;
			}

			if (nbDate > 0) {
				ctx.font = "12px arial";
				var Xlettre = decal + largeur / 2 - 7;
				var Ylettre = hauteur - hc_tot - 12;
				if (largeur > 5) {
					ctx.fillText(nbDate, Xlettre, Ylettre);
				}
				// console.log("ctx.fillText(" + nbDate + ", " + Xlettre + ", " + Ylettre + ")");
			}
			Xlettre = decal;
			Ylettre = hauteur - 10;
			var multi = 1;
			if (hour) {
				multi = 24;
			}
			ctx.font = "bold 10px arial";
			ctx.fillStyle = "DARKBLUE";
					
			if (keyDate != dayBefore) {
				// console.log("t2",(cptRow / multi) % 3);
				// console.log("t2=",cptRow / multi);
				if (largeur * multi > 30 || ((cptRow / multi) % 3 == 0)) {
						
					if (largeur < 100 && !hour) {
						ctx.fillText(laDateStr2, Xlettre+2, Ylettre + 10);
					} else {
						ctx.fillText(laDateStr, Xlettre+2, Ylettre + 10);
					}
					ctx.beginPath();
					ctx.setLineDash([]);
					// console.log(Xlettre, Ylettre);
					ctx.moveTo(Xlettre, Ylettre + 10);
					ctx.lineTo(Xlettre, hauteur -50);
					ctx.closePath();
					ctx.stroke();
				}
				var cptHour = 0;
			}
			if (hour) {
				mod = 1;
				if (largeur < 50) {
					mod = 6;
				}
				if (largeur < 10) {
					mod = 12;
				}
				if (largeur < 4) {
					mod = 24;
				}

				if (cptHour++ % mod == 0) {
					ctx.beginPath();
					ctx.moveTo(Xlettre, Ylettre);
					ctx.fillText(dateLu.getHours(), Xlettre+ largeur / 2, Ylettre );
					ctx.lineTo(Xlettre, hauteur - 50);
					ctx.closePath();
					ctx.stroke();
				}
			}
			ctx.fillStyle = "BLACK";
			cptRow++;

			tabXYDays.push({
				"X": decal,
				"Y": hauteur,
				"date": laDate,
				"id": id,
				"nb": nbDate
			});


			decal += largeur;
			if (hour) {
				var newDate = dateLu.setHours(dateLu.getHours() + 1);
			} else {
				var newDate = dateLu.setDate(dateLu.getDate() + 1);
			}
			dateLu = new Date(newDate);
			dayBefore = keyDate;

		}
		// console.log("tabXYDays",tabXYDays);

		var textTot="Total: "+nbTot;
		
		Xlettre = decal;
		ctx.beginPath();
		// console.log("LAST",Xlettre, Ylettre);
		ctx.moveTo(Xlettre, Ylettre);
		ctx.lineTo(Xlettre, 10);
		ctx.closePath();
		ctx.stroke();

		ctx.font = "15px arial";
		
		ctx.fillText(textTot, Xlettre +10 , Ylettre - hauteur/2);
		var i=1;
		for (var OS in nbTotOS) {
			ctx.fillStyle = colorOS[OS];
			var posY = Ylettre - hauteur/2+ i*20;
			ctx.fillRect(Xlettre , posY-15, 100,20 )
			ctx.fillStyle = "BLACK";
			textTot=" "+OS.split("_")[1]+":"+parseInt(nbTotOS[OS]/nbTot*100)+"%";
			ctx.fillText(textTot, Xlettre ,posY);
			i++;
		}
		ctx.fillStyle = "";
		if (largeur < 5) {
			ctx.beginPath();
			ctx.font = "12px arial";
			ctx.lineWidth = "1";
			ctx.setLineDash([4, 4]);
			var hL1 = (hauteur / 3) + 2;
			ctx.moveTo(10, hL1);
			ctx.lineTo(longueur - 10, hL1);
			ctx.fillText((2 * max / 3).toFixed(2), 10, hL1 + 13);
			ctx.stroke();
			ctx.closePath();

			ctx.beginPath();
			ctx.font = "12px arial";
			ctx.lineWidth = "1";
			var hL2 = (2 * hauteur / 3) - 2;

			ctx.moveTo(10, hL2);
			ctx.lineTo(longueur - 10, hL2);
			ctx.fillText((max / 3).toFixed(2), 10, hL2 + 13);
			ctx.stroke();
			ctx.closePath();

			ctx.beginPath();
			ctx.font = "12px arial";
			ctx.lineWidth = "1";
			var hL3 = 10;
			ctx.moveTo(10, hL3);
			ctx.lineTo(longueur - 10, hL3);
			ctx.fillText((max).toFixed(2), 10, hL3 + 13);
			ctx.stroke();
			ctx.closePath();

			ctx.beginPath();
			ctx.font = "12px arial";
			ctx.lineWidth = "1";
			var hL4 = hauteur - 10;
			ctx.moveTo(10, hL4);
			ctx.lineTo(longueur - 10, hL4);
			ctx.fillText("0,00", 10, hL4 - 3);
			ctx.stroke();
			ctx.closePath();
		}


		if (hour == 0) {
		// 4. Écouter les clics sur le canvas
		monCanvas.addEventListener('mousemove', function(event) {
			// 1. Récupérer la position et la taille du canvas sur l'écran
   			const rect = monCanvas.getBoundingClientRect();
   			// 2. Calculer la position du clic par rapport au coin supérieur gauche du canvas (en pixels affichés)
   			const clientX = event.clientX - rect.left;
   			const clientY = event.clientY - rect.top;

			// console.log("Clic détecté à l'écran :", event.clientX, event.clientY);
			// console.log("Position relative au canvas :", clientX, clientY);
   			// 3. Gérer l'échelle (au cas où le canvas est étiré par du CSS, ex: width: 100%)
   			// Si votre canvas fait 800px de large en interne mais s'affiche à 400px sur l'écran :
			// console.log("Taille du canvas :", divCanvas.width, divCanvas.height);
			// console.log("Taille affichée du canvas :", rect.width, rect.height);
   			// const scaleX = divCanvas.width / rect.width;
   			// const scaleY = divCanvas.height / rect.height;
   			const scaleX = 1;
   			const scaleY = 1;

			// console.log("Échelle du canvas :", scaleX, scaleY);
   			// 4. Obtenir les coordonnées exactes DANS le repère du canvas
   			const mouseX = clientX * scaleX;
   			const mouseY = clientY * scaleY;

	    	let clickedDate = null;
    		let clickedId = null;

    		// Parcourir toutes les zones enregistrées
    		for (let i = 0; i < tabXYDays.length; i++) {
	        	const area = tabXYDays[i];
	    	    // Vérifier si le clic se trouve dans les limites de l'élément (X et Y)
    	    	if (mouseX >= area.X && mouseX <= area.X + largeur && 
    	        	mouseY < area.Y ) {	
    		        clickedDate = area.date;
        		    clickedId = area.id;
					clickedNb = area.nb;
            		break; // On a trouvé l'élément cliqué, on arrête la recherche
		        }
    		}

		    // Résultat
    		if (clickedDate && clickedNb > 0) {
				document.body.style.cursor = 'pointer';
				// console.log("Date cliquée :", clickedDate);
	        	// console.log("ID associé :", clickedId);
		
				// Vous pouvez maintenant appeler votre fonction ou afficher l'information
				// ex: afficherDetails(clickedDate, clickedId);
			}	
			else {
				document.body.style.cursor = 'default';
			}
		});
		monCanvas.addEventListener('click', function(event) {
			// 1. Récupérer la position et la taille du canvas sur l'écran
   			const rect = monCanvas.getBoundingClientRect();
   			// 2. Calculer la position du clic par rapport au coin supérieur gauche du canvas (en pixels affichés)
   			const clientX = event.clientX - rect.left;
   			const clientY = event.clientY - rect.top;

			// console.log("Clic détecté à l'écran :", event.clientX, event.clientY);
			// console.log("Position relative au canvas :", clientX, clientY);
   			// 3. Gérer l'échelle (au cas où le canvas est étiré par du CSS, ex: width: 100%)
   			// Si votre canvas fait 800px de large en interne mais s'affiche à 400px sur l'écran :
			// console.log("Taille du canvas :", divCanvas.width, divCanvas.height);
			// console.log("Taille affichée du canvas :", rect.width, rect.height);
   			// const scaleX = divCanvas.width / rect.width;
   			// const scaleY = divCanvas.height / rect.height;
   			const scaleX = 1;
   			const scaleY = 1;

			// console.log("Échelle du canvas :", scaleX, scaleY);
   			// 4. Obtenir les coordonnées exactes DANS le repère du canvas
   			const mouseX = clientX * scaleX;
   			const mouseY = clientY * scaleY;

	    	let clickedDate = null;
    		let clickedId = null;

    		// Parcourir toutes les zones enregistrées
    		for (let i = 0; i < tabXYDays.length; i++) {
	        	const area = tabXYDays[i];
	    	    // Vérifier si le clic se trouve dans les limites de l'élément (X et Y)
    	    	if (mouseX >= area.X && mouseX <= area.X + largeur && 
    	        	mouseY < area.Y ) {	
    		        clickedDate = area.date;
        		    clickedId = area.id;
            		break; // On a trouvé l'élément cliqué, on arrête la recherche
		        }
    		}

		    // Résultat
    		if (clickedDate) {
        		console.log("Date cliquée :", clickedDate);
	        	console.log("ID associé :", clickedId);
        
        		// Vous pouvez maintenant appeler votre fonction ou afficher l'information
        		// ex: afficherDetails(clickedDate, clickedId);
				dessin(clickedId, 1, clickedDate);
				document.body.style.cursor = 'default';
    		} else {
		        console.log("Aucune date cliquée.");
	    	}
		});
}
	}

	function unloadPage() {}
</script>
<h3 class="titreFiche">Stat d'accès de la BAV <?= $infAppli['numero_bav'] ?></h3>
<select id="annee_stat" onchange="changeNumeroBAV(this.value)"></select>
<span id=dateDeb></span> au <span id=dateFin></span>
<div style='display:none;border:0px blue solid; position: absolute;background-color:white;Z-index:100' id='divcanvas_0'>
	<div class='row'>
		<div class='col-xs-12 col-sm-12 col-md-12' id='titre_canvas_0' style='text-align:center;'></div>
		<div class='col-xs-11 col-sm-11 col-md-11' >
			<canvas id='canvas_0' >Votre navigateur est trop vieux</canvas>
		</div>
		<div class='col-xs-1 col-sm-1 col-md-1' style='vertical-align:top' onclick="closeDesin(0)"> <img class='link' src='Images/erreur.png'/> </div>
	</div>
</div>
<div style='display:none;border:0px blue solid; position: absolute;background-color:white;Z-index:100' id='divcanvas_1'>
	<div class='row'>
		<div class='col-xs-12 col-sm-12 col-md-12' id='titre_canvas_1' style='text-align:center;'></div>
		<div class='col-xs-11 col-sm-11 col-md-11' >
			<canvas id='canvas_1' >Votre navigateur est trop vieux</canvas>
		</div>
		<div class='col-xs-1 col-sm-1 col-md-1' style='vertical-align:top' onclick="closeDesin(1)"> <img class='link'  src='Images/erreur.png'/> </div>
	</div>
</div>
<div id="statresult">
</div>
