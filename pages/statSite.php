<script>
	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = {};
	var anneeBav = '<?= $infAppli['numero_bav'] ?>';

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
		var select = getElement("annee_stat");
		select.options[select.options.length] = new Option("Choix", "*");
		for (index in val) {
			select.options[select.options.length] = new Option(val[index]['par_numero_bav'] + "-" + val[index]['par_titre'], val[index]['par_numero_bav']);
			if (anneeBav == index) {
				select.options[select.options.length - 1].selected = true;
			}
		}
	}

	function display_actions(val) {
		console.log(val);
		var repr = "";
		var tab = tree(val, "", 0);
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
		for (var index in val) {

			if (parent == "") {
				dates = [];
			}
			repr += "<ul>";
			if (val[index] instanceof Object) {
				var idHtml = parent + "-" + index;

				var tab = tree(val[index], idHtml, niv + 1);
				repr += "<li>";
				repr += "<div class='row tree" + niv + "'>";
				repr += "<div class='col-xs-6 col-sm-6 col-md-6' >" + index + "</div>";
				repr += "<div class='col-xs-3 col-sm-3 col-md-3 link' onclick=\"inverseStat('" + idHtml + "')\" id='croix_" + idHtml + "'> + </div>";
				repr += "<div class='col-xs-1 col-sm-1 col-md-1' >Cpt => " + tab['nb'] + "</div>";
				repr += "<div class='col-xs-1 col-sm-1 col-md-1 link' onclick=\"initDate('" + idHtml + "');dessin('" + idHtml + "',0)\"><img src='Images/statBarre.png' height='20px'/>j</div>";
				repr += "<div class='col-xs-1 col-sm-1 col-md-1 link' onclick=\"initDate('" + idHtml + "');dessin('" + idHtml + "',1)\"><img src='Images/statBarre.png' height='20px'/>j/h</div>";
				repr += "</div>";
				repr += "<div id='div_" + idHtml + "' style=\"display:none\">";
				repr += tab['repr'];
				repr += "</div>";
				Array.prototype.push.apply(dates, tab['dates']);
				for (var j in dates) {

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

					var keyDate = dates[j].getFullYear() + "-" + dates[j].getMonth() + "-" + dates[j].getDate();
					var keyDateTime = dates[j].getFullYear() + "-" + dates[j].getMonth() + "-" + dates[j].getDate() + "-" + dates[j].getHours();
					if (!tabDates[idHtml][keyDate]) {
						tabDates[idHtml][keyDate] = 0;
					}
					if (!tabDatesTimes[idHtml][keyDateTime]) {
						tabDatesTimes[idHtml][keyDateTime] = 0;
					}

					//console.log(idHtml+" "+dates[j].getFullYear()+"-"+dates[j].getMonth()+"-"+dates[j].getDate()+" ("+tabDates[idHtml][dates[j].getFullYear()+"-"+dates[j].getMonth()+"-"+dates[j].getDate()]+") += 1");
					tabDates[idHtml][keyDate] += 1;
					tabDatesTimes[idHtml][keyDateTime] += 1;

				}
				repr += "</li>";

				repr += "<div style='display:none;border:0px blue solid' id='divcanvas" + idHtml + "'>";
				repr += "<div class='row'>";
				repr += "<div class='col-xs-2 col-sm-2 col-md-2' ><input type='date' id='debut" + idHtml + "' onchange=\"redessin('" + idHtml + "')\"/></div>";
				repr += "<div class='col-xs-8 col-sm-8 col-md-8' ></div>";
				repr += "<div class='col-xs-2 col-sm-2 col-md-2' ><input type='date' id='fin" + idHtml + "'  onchange=\"redessin('" + idHtml + "')\"/></div>";
				repr += "</div>";
				repr += "<div class='row'>";
				repr += "<div class='col-xs-11 col-sm-11 col-md-11' >";
				repr += "<canvas id='canvas" + idHtml + "' width='" + longueur + "' height='" + hauteur + "'>Votre navigateur est trop vieux</canvas></div>"
				repr += "<div class='col-xs-1 col-sm-1 col-md-1' style='vertical-align:top' onclick=\"closeDesin('" + idHtml + "')\"> <img src='Images/erreur.png'/> </div>";
				repr += "</div>";
				repr += "</div>";
				nb += tab['nb'];

			} else {
				nb++;
				// repr += "<div class='tree1'>" + index + " => " + val[index] + "</div>";
				dates.push(new Date(index));
			}
			repr += "</ul>";
		}
		return {
			repr,
			nb,
			dates
		};
	}

	function redessin(id) {
		dessin(id, hourG)
	}

	function closeDesin(id) {
		var divCanvas = getElement("divcanvas" + id);
		divCanvas.style.display = 'none';

		var monCanvas = getElement("canvas" + id);
		var context = monCanvas.getContext("2d");
		context.beginPath();
		context.clearRect(0, 0, monCanvas.width, monCanvas.height);
		context.closePath();


	}
	var longueur = window.innerWidth * 0.8;
	// var longueur = 150;
	var hauteur = 300;
	var hourG;

	function initDate(id) {
		// console.log("nb row " + nbRow);
		//var nbRow = sizeof(tabDates[id]);
		var start = null;
		var max = 0
		for (var date in tabDates[id]) {
			if (start == null) {
				start = new Date(date);
				start.setMonth(start.getMonth() + 1);
			}
			fin = new Date(date);
			fin.setMonth(fin.getMonth() + 1);
		}
		start.setDate(start.getDate() + 1);
		fin.setDate(fin.getDate() + 1);

		var ecartJour = Math.floor((fin - start) / (60 * 60 * 1000 * 24) + 1);
		var valueStart = start.toISOString().split('T')[0];
		// 
		var ecartMax = 10;
		console.log("ecart jour", ecartJour);
		if (ecartJour > ecartMax) {
			// on debute 10 jours avant la fin
			startTmp = new Date(fin);
			startTmp.setDate(startTmp.getDate() - ecartMax);
			valueStart = startTmp.toISOString().split('T')[0];
		}

		var debutHTML = getElement("debut" + id);
		var finHTML = getElement("fin" + id);
		debutHTML.value = valueStart;
		debutHTML.min = start.toISOString().split('T')[0];
		debutHTML.max = fin.toISOString().split('T')[0];

		finHTML.value = fin.toISOString().split('T')[0];
		finHTML.min = start.toISOString().split('T')[0];
		finHTML.max = fin.toISOString().split('T')[0];
	}

	function dessin(id, hour) {
		closeDesin(id);
		hourG = hour;
		var divCanvas = getElement("divcanvas" + id);
		divCanvas.style.display = 'block';

		var monCanvas = getElement("canvas" + id);
		var ctx = monCanvas.getContext("2d");
		ctx.font = "15px arial";

		// console.log("nb row " + nbRow);
		//var nbRow = sizeof(tabDates[id]);

		var debutHTML = getElement("debut" + id);
		var finHTML = getElement("fin" + id);

		var start = new Date(debutHTML.value);
		start.setHours(0);
		var fin = new Date(finHTML.value);
		fin.setHours(0);

		console.log(start);
		console.log(fin);

		var max = 0

		var tabData = tabDates[id];
		if (hour) {
			tabData = tabDatesTimes[id]
		}
		for (var date in tabData) {
			var nb = tabData[date];
			// console.log(date + " " + nb);
			if (nb > max) {
				max = nb;
			}
		}
		console.log("max " + max);
		console.log("nb " + nb);
		fin.setDate(fin.getDate() + 1);

		var nbRow = Math.floor((fin - start) / (60 * 60 * 1000));
		if (hour) {

		} else {
			var nbRow = Math.floor((fin - start) / (24 * 60 * 60 * 1000));
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
		if (fin < start) {
			alertModalInfo("Attention date de début supérieure à la date de fin");
		}
		// console.log("longueur " + longueur);
		// console.log("largeur " + largeur);

		var dayBefore;
		var cptHour = 0;
		var cptRow = 0;
		while (start < fin) {
			var keyDate = start.getFullYear() + "-" + start.getMonth() + "-" + start.getDate();
			var keyDateTime = keyDate + "-" + start.getHours();
			var laDateStr = start.getDate() + "/" + (start.getMonth() + 1) + "/" + start.getFullYear();
			var laDateStr2 = start.getDate() + "/" + (start.getMonth() + 1) + "/" + start.getFullYear();
			if (hour) {
				var laDate = keyDateTime;
				laDateStr = start.getDate() + "/" + (start.getMonth() + 1) + "/" + start.getFullYear();
				laDateStr2 = start.getDate() + "/" + (start.getMonth() + 1) + "/" + start.getFullYear() + " " + start.getHours();
			} else {
				var laDate = keyDate;
			}
			// console.log(laDateStr);
			var nb = 0;
			// console.log(tabDates);
			// console.log(laDate);
			if (tabData[laDate]) {
				nb = tabData[laDate];
			}


			// max => 180
			//  nb =  hc
			hc = (hauteur - 20) * nb / max;
			// console.log(hc,nb, max);
			/* Un rectangle de couleur unie */

			ctx.lineWidth = "1";
			ctx.fillStyle = "lightblue";
			// console.log("ctx.fillRect("+decal+", "+(hauteur-hc-10)+", "+largeur+", "+hc+")");
			ctx.fillRect(decal, hauteur - hc - 10, largeur, hc)
			// console.log(decal, hauteur - hc - 10, largeur, hc);

			// console.log("ctx.fillText("+nb+", "+Xlettre+", "+Ylettre+")");

			ctx.fillStyle = "BLACK";
			if (nb > 0) {
				ctx.font = "15px arial";
				var Xlettre = decal + largeur / 2 - 7;
				var Ylettre = hauteur - hc;
				if (largeur > 5) {
					ctx.fillText(nb, Xlettre, Ylettre);
				}
			}


			Xlettre = decal;
			Ylettre = hauteur - 10;
			var multi = 1;
			if (hour) {
				multi = 24;
			}
			if (keyDate != dayBefore) {
				// console.log("t2",(cptRow / multi) % 3);
				// console.log("t2=",cptRow / multi);
				if (largeur * multi > 30 || ((cptRow / multi) % 3 == 0)) {
					if (largeur < 100 && !hour) {
						ctx.font = "8px arial";
						ctx.fillText(laDateStr2, Xlettre, Ylettre+10);
					} else {
						ctx.font = "15px arial";
						ctx.fillText(laDateStr, Xlettre, Ylettre+10);
					}
					ctx.beginPath();
					ctx.setLineDash([]);
					// console.log(Xlettre, Ylettre);
					ctx.moveTo(Xlettre, Ylettre+10);
					ctx.lineTo(Xlettre, 10);
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
					ctx.font = "8px arial";
					ctx.fillText(start.getHours(), Xlettre - 5, Ylettre - 40);
					ctx.lineTo(Xlettre, hauteur - 50);
					ctx.closePath();
					ctx.stroke();
				}
			}
			cptRow++;



			decal += largeur;
			if (hour) {
				var newDate = start.setHours(start.getHours() + 1);
			} else {
				var newDate = start.setDate(start.getDate() + 1);
			}
			start = new Date(newDate);
			dayBefore = keyDate;
		}
		Xlettre = decal;
		ctx.beginPath();
		// console.log("LAST",Xlettre, Ylettre);
		ctx.moveTo(Xlettre, Ylettre);
		ctx.lineTo(Xlettre, 10);
		ctx.closePath();
		ctx.stroke();

		if (largeur < 5) {
			ctx.beginPath();
			ctx.font = "12px arial";
			ctx.lineWidth = "1";
			ctx.setLineDash([4, 4]);
			var hL1 = (hauteur / 3) + 2;
			ctx.moveTo(10, hL1);
			ctx.lineTo(longueur - 10, hL1);
			ctx.fillText((2 * max / 3).toFixed(2), 10, hL1);
			ctx.stroke();
			ctx.closePath();

			ctx.beginPath();
			ctx.font = "12px arial";
			ctx.lineWidth = "1";
			var hL2 = (2 * hauteur / 3) - 2;

			ctx.moveTo(10, hL2);
			ctx.lineTo(longueur - 10, hL2);
			ctx.fillText((max / 3).toFixed(2), 10, hL2);
			ctx.stroke();
			ctx.closePath();
		}

	}


	function unloadPage() {}
</script>
<select id="annee_stat" onchange="changeNumeroBAV(this.value)"></select>

<div id="statresult">
</div>
<canvas id="canvasShape" width="700" height="200">Votre navigateur est trop vieux</canvas>