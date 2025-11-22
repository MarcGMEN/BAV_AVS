	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = {};
	var anneeBavSuvi = '';
	var cumul = 1;

	var mapQui = 'tous';
	// var anneeBavActive = '2021';

	function initPage() {
		if (ADMIN) {
			// chargement des codes postaux connue
			x_return_all_lat_lon_cdp(display_latLonCdp);

			// graph de suivi de la BAV
			x_return_nbFichesByDay(anneeBav, display_statByAnneeRef);

			/** chargement des parametres pour le choix de la BAV de ref  */
			x_return_allParametre(display_parametres);
			/** chargement des parametres pour le choix de la BAV de comparaison  */
			x_return_allParametre(display_parametres_statSuivi);

			// recuperation de la liste des types
			// x_return_enum('bav_objet', 'obj_type', display_list_type);
			// x_return_enum('bav_objet', 'obj_public', display_list_public);
			// x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);

			// retour de stat client pour les code postaux
			x_return_statClient(mapQui, display_statClient);

			// retour de stat de delais
			// x_return_statDelais(display_formulaire);

			// retour de stat de repartition par demi/journée.
			x_return_statRepartition(display_formulaire);

			// visu de la stat de depot
			x_return_statByType(tabToString(tabSel), "depot", display_statDepot);

			// affichage d'un histo des tarifs de depot
			x_return_histoCount(tabToString(tabSel), 'tarif', 500, 250, 0, 'depot', display_countTarifDepot);
			//x_return_histoCount(tabToString(tabSel), 'type', 500, 250, 2, 'depot', display_countTypeDepot);
			// retour du nombre d'objet vendu supérieur a 500 
			x_return_countByTarifSup(tabToString(tabSel), 500, "depot", display_countByTarifSupDepot);

			// visu de la stat de vente
			x_return_statByType(tabToString(tabSel), "vente", display_statVente);

			// affichage d'un histo des tarifs de vente
			x_return_histoCount(tabToString(tabSel), 'tarif', 500, 250, 0, 'vente', display_countTarifVente);
			x_return_histoCount(tabToString(tabSel), 'type', 1000, 300, 2, 'mixte', display_countTypeVente);

			// retour du nombre d'objet vendu supérieur a 500 
			x_return_countByTarifSup(tabToString(tabSel), 500, "vente", display_countByTarifSupVente);

		} else {
			// si pas ADMIN retour page accueil
			goTo();
		}
	}

	// valeurs de reference  de la BAV en cours
	var valRef = [];

	// après lecture de la bav en cours, on recherche les données de la BAV a comparere
	function display_statByAnneeRef(val) {
		valRef = val;
		x_return_nbFichesByDay(anneeBavSuvi, display_statByAnnee);
	}

	/**
	 * Affichage des val de la BAV  ( valRef) et la BAV de comparaison (val)
	 * 
	 * @param {} val 
	 */
	function display_statByAnnee(val) {
		var colorEtat = [];
		colorEtat['DEPOT_' + anneeBav] = 'DARKORANGE';
		colorEtat['VENTE_' + anneeBav] = 'DARKGREEN';
		colorEtat['RESTI_' + anneeBav] = 'DARKRED';
		colorEtat['DEPOT_' + anneeBavSuvi] = 'ORANGE';
		colorEtat['VENTE_' + anneeBavSuvi] = 'GREEN';
		colorEtat['RESTI_' + anneeBavSuvi] = 'RED';

		var typeLigneEtatInit = [];
		var typeLigneEtat = [];
		typeLigneEtat['DEPOT_' + anneeBav] = [];
		typeLigneEtat['VENTE_' + anneeBav] = [];
		typeLigneEtat['RESTI_' + anneeBav] = [];
		typeLigneEtat['DEPOT_' + anneeBavSuvi] = [5, 10];
		typeLigneEtat['VENTE_' + anneeBavSuvi] = [5, 10];
		typeLigneEtat['RESTI_' + anneeBavSuvi] = [5, 10];
		var monCanvas = getElement("canvasSuivi1");
		var ctx = monCanvas.getContext("2d");
		monCanvas.width = screen.width * 0.70;

		ctx.beginPath();
		ctx.font = "15px arial";
		ctx.fillText(anneeBav + " vs " + anneeBavSuvi, monCanvas.width / 2, 20);
		ctx.stroke();
		ctx.closePath();

		var maxYCalc = 0;
		if (sizeof(val) > 0) {
			if (sizeof(valRef) > 0) {
				for (var date in val) {
					if (valRef[date]) {
						// console.log("ajout de " + date);
						for (var etatRef in valRef[date]) {
							val[date][etatRef] = valRef[date][etatRef];
						}
					}
				}
				for (var date in valRef) {
					if (!val[date]) {
						// console.log("nouvelle " + date);
						val[date] = valRef[date];
					}
				}
			}
		} else if (sizeof(valRef) > 0) {
			val = valRef;
		}
		for (var date in val) {
			for (var etatRef in val[date]) {
				maxYCalc = maxYCalc > val[date][etatRef] ? maxYCalc : val[date][etatRef];
			}
		}
		// console.log(val);
		// console.log(maxYCalc);

		var pasGrille = 0;
		if (cumul) {
			maxY = 1500;
			pasGrille = 250;
		} else {
			maxY = maxYCalc + 40;
			pasGrille = 50;
		}

		for (var i = 0; i <= maxY; i += pasGrille) {
			ctx.beginPath();
			ctx.lineWidth = "1";
			ctx.strokeStyle = "GREY";
			var Y2 = monCanvas.height - (i * monCanvas.height / maxY) - 10;
			ctx.moveTo(0, Y2);
			ctx.lineTo(monCanvas.width, Y2);
			ctx.fillText(i, 5, Y2);
			ctx.stroke();
			ctx.closePath();
		}

		ctx.font = "15px arial";

		var countEtat = [];
		countEtat['DEPOT_' + anneeBav] = 0;
		countEtat['VENTE_' + anneeBav] = 0;
		countEtat['RESTI_' + anneeBav] = 0;
		countEtat['DEPOT_' + anneeBavSuvi] = 0;
		countEtat['VENTE_' + anneeBavSuvi] = 0;
		countEtat['RESTI_' + anneeBavSuvi] = 0;

		var countEtatOld = [];
		countEtatOld['DEPOT_' + anneeBav] = 0;
		countEtatOld['VENTE_' + anneeBav] = 0;
		countEtatOld['RESTI_' + anneeBav] = 0;
		countEtatOld['DEPOT_' + anneeBavSuvi] = 0;
		countEtatOld['VENTE_' + anneeBavSuvi] = 0;
		countEtatOld['RESTI_' + anneeBavSuvi] = 0;

		var Xdebut = 0;

		var keysSort = Object.keys(val).sort()
		// console.log(keysSort);
		var hauteurCanvas = monCanvas.height - 10;
		var largeurCanvas = monCanvas.width;
		var jourOld = 0;
		if (sizeof(keysSort) > 0) {
			var pasHour = largeurCanvas / sizeof(val);

			for (var date in keysSort) {

				var tabEtat = val[keysSort[date]];
				var jour = keysSort[date].split(" ")[0];
				var heure = keysSort[date].split(" ")[1];
				// console.log(jour, date);

				for (var etat in tabEtat) {
					var value = tabEtat[etat];
					// console.log("cpt "+etat);
					if (cumul) {
						countEtat[etat] += parseInt(value);
					} else {
						countEtat[etat] = parseInt(value);
					}
				}
				if (jour != jourOld) {
					ctx.beginPath();
					ctx.lineWidth = "1";
					ctx.moveTo(Xdebut + pasHour / 2, hauteurCanvas);
					ctx.lineTo(Xdebut + pasHour / 2, hauteurCanvas - 10);
					ctx.strokeStyle = "grey"
					ctx.stroke();
					ctx.closePath();

					Xdebut += pasHour / 2;

					if (!cumul) {
						for (var etatLu in countEtat) {
							countEtatOld[etatLu] = 0;
						}
					}
				}
				// console.log(countEtat);
				for (var etatLu in countEtat) {

					if (jour == jourOld && Xdebut > 0) {
						ctx.beginPath();
						ctx.lineWidth = "2";
						ctx.strokeStyle = colorEtat[etatLu];
						ctx.setLineDash(typeLigneEtat[etatLu]); // type ligne en fonction etat
						var Y = countEtatOld[etatLu] * hauteurCanvas / maxY;
						ctx.moveTo(Xdebut, hauteurCanvas - Y);

						// console.log(keysSort[date], etatLu, countEtatOld[etatLu], Xdebut, 200 - Y);
						var Y2 = countEtat[etatLu] * hauteurCanvas / maxY;
						ctx.lineTo(Xdebut + pasHour, hauteurCanvas - Y2);
						// console.log("=>", countEtat[etatLu], Xdebut+pasHour,200-Y2)
						ctx.stroke();
						ctx.setLineDash(typeLigneEtatInit);
						ctx.closePath();

						if (heure == 12 && cumul) {
							ctx.beginPath();
							ctx.lineWidth = "2";
							ctx.fillStyle = colorEtat[etatLu];
							ctx.setLineDash(typeLigneEtat[etatLu]); // type ligne en fonction etat
							var Y = countEtatOld[etatLu] * hauteurCanvas / maxY;
							if (etatLu.includes(anneeBavSuvi)) {
								ctx.fillText(countEtat[etatLu], Xdebut + pasHour - 10, hauteurCanvas - Y + 10);
								ctx.font = "11px arial";
							} else {
								ctx.font = "bold 11px arial";
								ctx.fillText(countEtat[etatLu], Xdebut + pasHour - 10, hauteurCanvas - Y - 10);
							}

							// console.log("=>", countEtat[etatLu], Xdebut+pasHour,200-Y2)
							ctx.stroke();
							ctx.setLineDash(typeLigneEtatInit);
							ctx.closePath();
						}
					} else {
						if (cumul) {
							ctx.beginPath();
							ctx.lineWidth = "2";
							ctx.fillStyle = colorEtat[etatLu];
							ctx.setLineDash(typeLigneEtat[etatLu]); // type ligne en fonction etat
							var Y = countEtatOld[etatLu] * hauteurCanvas / maxY;
							ctx.fillText(countEtat[etatLu], Xdebut - 10, hauteurCanvas - Y);
							// console.log("=>", countEtat[etatLu], Xdebut+pasHour,200-Y2)
							ctx.stroke();
							ctx.setLineDash(typeLigneEtatInit);
							ctx.closePath();
						}
					}
					countEtatOld[etatLu] = countEtat[etatLu];
				}
				if (jour != jourOld) {

					ctx.beginPath();
					ctx.lineWidth = "1";
					ctx.font = "11px arial";
					ctx.strokeStyle = "grey"
					ctx.moveTo(Xdebut, hauteurCanvas);
					ctx.lineTo(Xdebut, 0);
					ctx.fillText("J" + jour, Xdebut + 10, 20);

					// console.log(jour, countEtatOld[etatLu], Xdebut, 200 - Y2);
					ctx.stroke();
					ctx.closePath();

					ctx.beginPath();
					ctx.lineWidth = "1";
					ctx.strokeStyle = "grey"
					ctx.font = "9px arial";
					ctx.fillText(heure, Xdebut + pasHour / 2, monCanvas.height);
					ctx.moveTo(Xdebut + pasHour / 2, hauteurCanvas);
					ctx.lineTo(Xdebut + pasHour / 2, hauteurCanvas - 10);

					ctx.stroke();
					ctx.closePath();
					Xdebut += pasHour / 2;
				} else {

					ctx.beginPath();
					ctx.lineWidth = "1";
					ctx.strokeStyle = "grey"
					ctx.font = "9px arial";
					ctx.fillText(heure, Xdebut + pasHour, monCanvas.height);
					ctx.moveTo(Xdebut + pasHour, hauteurCanvas);
					ctx.lineTo(Xdebut + pasHour, hauteurCanvas - 10);

					ctx.stroke();
					ctx.closePath();
					Xdebut += pasHour;
				}
				jourOld = jour;


			}
			if (cumul) {
				for (var etatLu in countEtat) {
					var Y2 = hauteurCanvas - (countEtat[etatLu] * hauteurCanvas / maxY) - 5;
					if (etatLu.startsWith('RESTI')) {
						Y2 += 10;
					}
					
					ctx.fillStyle = colorEtat[etatLu];
					ctx.beginPath();
					ctx.font = "12px arial";
					// console.log(etatLu + " (" + countEtat[etatLu] + ")", Xdebut - 120, Y2);
					if (etatLu.includes(anneeBavSuvi)) {
						ctx.fillText(etatLu + " (" + countEtat[etatLu] + ")", Xdebut - 120, Y2 + 20);
						ctx.font = "12px arial";
					} else {
						ctx.font = "bold 12px arial";
						ctx.fillText(etatLu + " (" + countEtat[etatLu] + ")", Xdebut - 120, Y2 );
					}
					
					ctx.stroke();
					ctx.closePath();
				}
			}
		}
	}

	/**
	 * choix des autres BAV pour comparaison
	 * @param {} val 
	 */
	function display_parametres_statSuivi(val) {
		// console.log(val);
		var divCheckbox = getElement("annee_statSuvi");
		var repr = "";
		var lastBAV = "";
		var index = 0;
		repr += "<input type='radio'  name='annee_statSuvi' id='ck" + numeroBAV + "' value='" + numeroBAV + "' onchange='addStatsuvi(\"\")' >Rien</input>";
		for (var numeroBAV in val) {
			var strCheck = "";
			if (numeroBAV != anneeBav) {
				repr += "<input type='radio'  name='annee_statSuvi' id='ck" + numeroBAV + "' value='" + numeroBAV + "' onchange='addStatsuvi(this.value)' " + strCheck + " >" + numeroBAV + "</input>";
				if (numeroBAV < anneeBav) {
					lastBAV = numeroBAV;
				}
			}
		}
		divCheckbox.innerHTML = repr;
		getElement("ck" + lastBAV).checked = true;

		addStatsuvi(lastBAV);
	}

	/**
	 * remise a jour du graph de comparaison avec la nouvelle BAV de suivi
	 * @param {*} value 
	 */
	function addStatsuvi(value) {
		anneeBavSuvi = value;
		x_return_nbFichesByDay(anneeBav, display_statByAnneeRef);
	}

	/**
	 * Choix de la BAV de ref
	 * @param {*} val 
	 */
	function display_parametres(val) {
		var select = getElement("annee_stat");
		select.options[select.options.length] = new Option("Choix", "*");
		for (index in val) {
			select.options[select.options.length] = new Option(val[index]['par_numero_bav'] + "-" + val[index]['par_titre'], val[index]['par_numero_bav']);
			if (anneeBav == index) {
				select.options[select.options.length - 1].selected = true;
			}
		}
	}

	/* mise a jour de la BAV pour stat */
	function changeNumeroBAV(val) {
		SetCookie("par_numero_bav_stat", val);
		goTo('stat.php');
	}

	/**
	 * fonction par defaut de chargement de la page
	 */
	function unloadPage() {}

	
	function display_list_type(val) {
		display_list(val, 'type');
	}

	function display_list_public(val) {
		display_list(val, 'public');
	}

	function display_list_pratique(val) {
		display_list(val, 'pratique');
	}

	function display_list(val, row) {
		var select = getElement("sel_obj_" + row);
		for (index in val) {
			select.options[select.options.length] = new Option(val[index], val[index]);
			if (tabSel['obj_' + row] != null && tabSel['obj_' + row] == val[index]) {
				select.options[select.options.length - 1].selected = true;
			}
		}
	}

	//// gestion des code postaux
	//// gestion des code postaux
	//// gestion des code postaux

	var tabCdpLatLon = [];
	/* recuperation des lat-mon des codes postaux */
	/*  lié a display_statClient */ 
	function display_latLonCdp(val) {
		for (var cdp in val) {
			tabCdpLatLon[cdp] = val[cdp];
		}
	}


	var tabCdpNb = [];
	var nbClient = 0;
	/* Affichage des stats clients sous format map */
	function display_statClient(val) {

		tabCdpNb = [];
		tabDistanceCDP = [];
		nbClient = 0;
		// usage example:
		var tabVal = [];
		// console.log(val);
		var index = 0;
		for (i in val) {
			tabVal[index] = [];
			tabVal[index]['cdp'] = i;
			tabVal[index]['nb'] = val[i];
			index++;
		}
		// console.log(lat, lon);
		// console.log(tabVal);
		tabVal.sort((a, b) => (a['cdp'] > b['cdp'] ? 1 : a['cdp'] < b['cdp'] ? -1 : 0));
		// console.log(tabVal);


		initMap();
		purgeMarkers();
		getElement('tabCodePostal').innerHTML = "";
		index = 1;
		var rc = '';
		var depOld = "";
		var nbDep = 0;
		var nbCommune = 0;

		for (i in tabVal) {
			if (tabVal[i]['cdp']) {
				nbClient += tabVal[i]['nb'];
			}
		}

		var repr = "";

		repr += "<div class='row'>";
		var TIME_PAUSE = 1200;
		var indexSearch = 1;
		for (i in tabVal) {
			if (tabVal[i]['cdp']) {

				var dep = tabVal[i]['cdp'].substr(0, 2);
				var lat = 0;
				var lon = 0;
				if (tabCdpLatLon[tabVal[i]['cdp']]) {
					// console.log(tabVal[i]['cdp'] + " connu");
					var tabTmp = tabCdpLatLon[tabVal[i]['cdp']].split(',');
					var lat = tabTmp[0];
					var lon = tabTmp[1];
					var info = tabTmp[2];
					tabDistanceCDP[tabVal[i]['cdp']] = distanceHaversine(latSN, lonSN, lat, lon);

					// Ajout du marker sur la carte
					addMarker(lat, lon, tabVal[i]['cdp'], tabVal[i]['nb'], info);

				} else {
					// x_add_cdp(tabVal[i]['cdp'],lat, lon, display_vide);
					// recherche des code postaux non connus
					setTimeout('geoPosClient2("' + tabVal[i]['cdp'] + '")', TIME_PAUSE * indexSearch);
					// Ajout du marker sur la carte avec un delai pour trouvé sus google
					setTimeout('addMarkerdecal("' + tabVal[i]['cdp'] + '",' + indexSearch + ',' + tabVal[i]['nb'] + ')', TIME_PAUSE * indexSearch + 1000);
					indexSearch++;
				}

				rc = '';
				if (index++ % 3 == 0) {
					repr += "</tr><tr>";
					// rc='<br/>';
				}
				// console.log("dep ",dep, depOld);
				if (depOld != "" && depOld != dep) {
					var pour = nbDep * 100 / nbClient;
					repr += "<div class='col-md-12 col-sm-12 col-xs-12 tabl0'  style='background-color:lightgrey'>";
					repr += depOld + " => " + nbDep + " (" + pour.toFixed(2) + "%)";
					repr += "&nbsp;&nbsp;&nbsp;Communes : " + nbCommune;
					repr += "</div>";
					index = 1;
					nbDep = 0;
					nbCommune = 0;
				}
				tabCdpNb[tabVal[i]['cdp']] = tabVal[i]['nb'];
				var pour = tabVal[i]['nb'] * 100 / nbClient;
				repr += "<div class='col-md-4 col-sm-5 col-xs-6 tabl1' >";
				repr += tabVal[i]['cdp'] + " => " + tabVal[i]['nb'] + " (" + pour.toFixed(1) + "%)";
				//getElement('tabCodePostal').innerHTML+="&nbsp;&nbsp;&nbsp;"+tabVal[i]['cdp']+" => "+tabVal[i]['nb']+rc;
				repr += "</div>";


				depOld = dep;
				nbDep += tabVal[i]['nb'];
				nbCommune++;

			}
		}
		var pour = nbDep * 100 / nbClient;
		repr += "<div class='col-md-12 col-sm-12 col-xs-12 tabl0'  style='background-color:lightgrey'>";
		repr += depOld + " => " + nbDep + " (" + pour.toFixed(2) + "%)";
		repr += "&nbsp;&nbsp;&nbsp;Communes : " + nbCommune;
		repr += "</div>";
		repr += "<div class='col-md-12 col-sm-12 col-xs-12 tabl0'  >";
		repr += "</div>";

		// recuperation du tableau des distances
		getElement('tabCodePostal').innerHTML = repr;

		//
		console.log('traitement en ' + (TIME_PAUSE * indexSearch + 100) / 1000 + ' secondes');
		setTimeout("finCreateCarte()", TIME_PAUSE * indexSearch + 100);
	}

	/**
	 * Ajout des marker sur la carte
	 */
	function addMarkerdecal(cdp, index, nb) {
		console.log("marker decale "+cdp,tabCdpLatLon[cdp]);
		if (tabCdpLatLon[cdp]) {
			var tabTmp = tabCdpLatLon[cdp].split(',');
			var lat = tabTmp[0];
			var lon = tabTmp[1];
			addMarker(lat, lon, cdp, nb, tabTmp[2]);
		}
	}

	/**
	 * ajout des données de distance en fin de carte
	 */
	function finCreateCarte() {
		// alertModalInfo('Fin de creation de la carte');
		// console.log("tabDistanceCDP", tabDistanceCDP);

		var km50 = [];
		for (i in tabDistanceCDP) {
			var moduleDistance = parseInt(tabDistanceCDP[i] / 30);

			// console.log(tabDistanceCDP[i],moduleDistance);
			if (!km50[moduleDistance]) {
				km50[moduleDistance] = 0;
			}
			km50[moduleDistance] += tabCdpNb[i];
		}
		// console.log("km50", km50);

		var kmAV = 0;
		var repr = "";
		repr += "<div class='row'>";
		var stringKeys = Object.keys(km50);
		var indexAff = 1;
		for (let index = 0; index <= stringKeys[stringKeys.length - 1]; index++) {
			var nb = 0;
			if (km50[index]) {
				nb = km50[index];
			}
			var kmFin = (index + 1) * 30;
			if (nb > 0) {

				var pour = nb * 100 / nbClient;
				repr += "<div class='col-md-2 col-sm-4 col-xs-6'>";
				repr += kmAV + "km -> " + kmFin + "km = " + nb + " (" + pour.toFixed(1) + "%)&nbsp;&nbsp;&nbsp;";
				repr += "</div>";
			}
			kmAV = ((index + 1) * 30) + 1;


			//			repr += ((index + 1) * 30) + " = " + nb + "<br/>" + (((index + 1) * 30) + 1) + " -> ";
		}
		getElement('km30').innerHTML = repr;

	}

	/* affichage des graphs de depot par prix */
	function display_countTarifDepot(val) {
		getElement('tarifDepot').src = val;
	}

	/* affichage des graphs de vente par prix */
	function display_countTarifVente(val) {
		getElement('tarifVente').src = val ;
	}

	function display_countTypeDepot(val) {
		getElement('typeDepot').src = val;
	}

	function display_countTypeVente(val) {
		getElement('typeVente').src = val;
	}

	/* affichage des données de dépot
	 */
	function display_statDepot(val) {
		// infoPlusObj("prixMinidepot", val);
		infoPlusObj("prixMaxidepot", val);

		// infoPlusCli("nbVeloMaxiVendeurdepot", val);

		display_formulaire(val, null);
	}

	/* affichage des données de vente
	 */
	function display_statVente(val) {
		// infoPlusObj("prixMinivente", val);
		infoPlusObj("prixMaxivente", val);

		// infoPlusCli("nbVeloMaxiVendeurvente", val);
		// infoPlusCli("nbVeloMaxiAcheteur", val);

		display_formulaire(val, null);

		// val['pourcent'] = "0%";
		// if (getElement('count_depot').innerHTML != "()") {
		// 	val['pourcent'] = parseInt(parseInt(val['count_vente']) / parseInt(getElement('count_depot').innerHTML) * 100) + " %";
		// }
		// display_formulaire(val, null);

	}

	/** info plus de l'object */
	function infoPlusObj(id, val) {
		if (val["obj" + id]) {
			var obj = val["obj" + id];
			val['plus' + id] = "(" + obj['obj_numero'] + ") " + obj['obj_type'] + "-" + obj['obj_public'] + " - " + obj['obj_marque'] + " [" + obj['vendeur_nom'] + "]"
			getElement('plus' + id).onclick = function() {
				goTo("ficheAdmin.php", "modif", obj['obj_id']);
			};
		} else {
			val['plus' + id] = "";
		}
		
	}

	/* info plus client */
	function infoPlusCli(id, val) {
		if (val["cli" + id]) {
			var obj = val["cli" + id];
			val['plus' + id] = "(" + obj['cli_id'] + ") " + obj['cli_nom'];
			getElement('plus' + id).onclick = function() {
				goTo("client.php", "modif", obj['cli_id']);
			};
		} else {
			val['plus' + id] = "";
		}
	}

	/**
	 * affichage du compteur de depot
	 */
	function display_countByTarifSupDepot(val) {
		getElement('count_rangeDepot').innerHTML = val;
	}

	/**
	 * affichage du compteur de vente 
	 */
	function display_countByTarifSupVente(val) {
		getElement('count_rangeVente').innerHTML = val;
	}