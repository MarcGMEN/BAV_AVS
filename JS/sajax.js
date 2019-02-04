		
		// remote scripting library
		// (c) copyright 2005 modernmethod, inc
		var sajax_debug_mode = false;
		var sajax_request_type = "POST";
		var sajax_target_id = "";
		var sajax_failure_redirect = "";
		var sajax_asynchro = new Array();
				sajax_asynchro['return_enum']=1;
				sajax_asynchro['get_publiHtml']=1;
				sajax_asynchro['return_list_unique']=1;
				sajax_asynchro['action_makePDFFromHtml']=1;
				sajax_asynchro['return_html']=1;
				sajax_asynchro['save_html']=1;
				sajax_asynchro['whatYourName']=1;
				sajax_asynchro['return_oneClient']=1;
				sajax_asynchro['action_updateClient']=1;
				sajax_asynchro['action_insertClient']=1;
				sajax_asynchro['return_oneClientByMel']=1;
				sajax_asynchro['return_oneClientByIdModif']=1;
				sajax_asynchro['return_listClientByMel']=1;
				sajax_asynchro['return_listClientByName']=1;
				sajax_asynchro['return_oneClientByName']=1;
				sajax_asynchro['return_clients']=1;
				sajax_asynchro['return_countMailing']=1;
				sajax_asynchro['return_countMailingAEnvoyer']=1;
				sajax_asynchro['return_countMailingEnvoye']=1;
				sajax_asynchro['return_countMailingErreur']=1;
				sajax_asynchro['initMailing']=1;
				sajax_asynchro['actionMailing']=1;
				sajax_asynchro['envoiMailing']=1;
				sajax_asynchro['loadTexteMailing']=1;
				sajax_asynchro['return_list_marques']=1;
				sajax_asynchro['return_list_modeles']=1;
				sajax_asynchro['return_oneFiche']=1;
				sajax_asynchro['action_updateFiche']=1;
				sajax_asynchro['action_insertFiche']=1;
				sajax_asynchro['action_deleteFiche']=1;
				sajax_asynchro['return_oneFicheByIdModif']=1;
				sajax_asynchro['return_oneFicheByCode']=1;
				sajax_asynchro['action_createFiche']=1;
				sajax_asynchro['action_createFicheExpress']=1;
				sajax_asynchro['action_mail']=1;
				sajax_asynchro['action_makePDF']=1;
				sajax_asynchro['action_changeEtatFiche']=1;
				sajax_asynchro['action_confirmeFiche']=1;
				sajax_asynchro['action_vendFiche']=1;
				sajax_asynchro['return_countByEtat']=1;
				sajax_asynchro['return_fiches']=1;
				sajax_asynchro['return_fiches_express']=1;
				sajax_asynchro['return_oneParametre']=1;
				sajax_asynchro['return_allParametre']=1;
				sajax_asynchro['action_updateParametre']=1;
				sajax_asynchro['action_insertParametre']=1;
				sajax_asynchro['return_infoAppli']=1;
				sajax_asynchro['return_depotsBAV']=1;
				sajax_asynchro['return_tauxBAV']=1;
				
		function sajax_debug(text) {
			if (sajax_debug_mode)
                console.log(text);
				//alert(text);
		}
		
 		function sajax_init_object() {
 			sajax_debug("sajax_init_object() called..")
 			
 			var A;
 			
 			var msxmlhttp = new Array(
				'Msxml2.XMLHTTP.5.0',
				'Msxml2.XMLHTTP.4.0',
				'Msxml2.XMLHTTP.3.0',
				'Msxml2.XMLHTTP',
				'Microsoft.XMLHTTP');
			for (var i = 0; i < msxmlhttp.length; i++) {
				try {
					A = new ActiveXObject(msxmlhttp[i]);
				} catch (e) {
					A = null;
				}
			}
 			
			if(!A && typeof XMLHttpRequest != "undefined")
				A = new XMLHttpRequest();
			if (!A)
				sajax_debug("Could not create connection object.");
			return A;
		}
		
		var sajax_requests = new Array();
		
		function sajax_cancel() {
			for (var i = 0; i < sajax_requests.length; i++) 
				sajax_requests[i].abort();
		}
		
		function sajax_do_call(func_name, args) {
			var i, x, n;
			var uri;
			var post_data;
			var target_id;
			
			sajax_debug("in sajax_do_call().." + sajax_request_type + "/" + sajax_target_id);
			target_id = sajax_target_id;
			if (typeof(sajax_request_type) == "undefined" || sajax_request_type == "") 
				sajax_request_type = "GET";
			
			uri = "AJAX/AJAX.php";
			if (sajax_request_type == "GET") {
			
				if (uri.indexOf("?") == -1) 
					uri += "?rs=" + escape(func_name);
				else
					uri += "&rs=" + escape(func_name);
				uri += "&rst=" + escape(sajax_target_id);
				uri += "&rsrnd=" + new Date().getTime();
				
				for (i = 0; i < args.length-1; i++) 
					uri += "&rsargs[]=" + escape(args[i]);

				post_data = null;
			} 
			else if (sajax_request_type == "POST") {
				post_data = "rs=" + escape(func_name);
				post_data += "&rst=" + escape(sajax_target_id);
				post_data += "&rsrnd=" + new Date().getTime();
				
				for (i = 0; i < args.length-1; i++) 
					post_data = post_data + "&rsargs[]=" + escape(args[i]);
			}
			else {
				alert("Illegal request type: " + sajax_request_type);
			}
			
			x = sajax_init_object();
			if (x == null) {
				if (sajax_failure_redirect != "") {
					location.href = sajax_failure_redirect;
					return false;
				} else {
					sajax_debug("NULL sajax object for user agent:\n" + navigator.userAgent);
					return false;
				}
			} 
			else {
				x.open(sajax_request_type, uri, sajax_asynchro[func_name]);
				// window.open(uri);
			
				sajax_requests[sajax_requests.length] = x;
				
				if (sajax_request_type == "POST") {
					x.setRequestHeader("Method", "POST " + uri + " HTTP/1.1");
					x.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				}
				
				if (sajax_asynchro[func_name]) {
				x.onreadystatechange = function() {
					if (x.readyState != 4) 
						return;

					sajax_debug("received " + x.responseText);
				
					var status;
					var data;
					var txt = x.responseText.replace(/^\s*|\s*$/g,"");
					status = txt.charAt(0);
					data = txt.substring(2);

					if (status == "") {
						// let's just assume this is a pre-response bailout and let it slide for now
					} else if (status == "-") 
						alert("Error: " + data);
					else {
						if (target_id != "") 
							document.getElementById(target_id).innerHTML = eval(data);
						else {
							try {
								var callback;
								var extra_data = false;
								if (typeof args[args.length-1] == "object") {
									callback = args[args.length-1].callback;
									extra_data = args[args.length-1].extra_data;
								} else {
									callback = args[args.length-1];
								}
								callback(eval(data), extra_data);
							} catch (e) {
								console.error("Caught error " + e + ": Could not eval : [" + data +"]");
							}
						}
					}
				}
				}
			}
			
			sajax_debug(func_name + " uri = " + uri + "/post = " + post_data);
			try {
				x.send(post_data);
				if (!sajax_asynchro[func_name]) {
						while (x.status != 200 && x.status != 500) {
            	            sajax_debug(x.status);
						} 

						sajax_debug("received " + x.responseText);
						
						var status;
						var data	;
						var txt = x.responseText.replace(/^\s*|\s*$/g,"");
						status = txt.charAt(0);
						data = txt.substring(2);

						if (status == "") {
							// let's just assume this is a pre-response bailout and let it slide for now
						} else if (status == "-") 
							alert("Error: " + data);
						else {
							if (target_id != "") 
							document.getElementById(target_id).innerHTML = eval(data);
							else {
								try {
									var callback;
									var extra_data = false;
									if (typeof args[args.length-1] == "object") {
										callback = args[args.length-1].callback;
										extra_data = args[args.length-1].extra_data;
									} else {
										callback = args[args.length-1];
									}
									callback(eval(data), extra_data);
								} catch (e) {
									sajax_debug("Caught error " + e + ": Could not eval " + data );
								}
							}
						}
				}
				sajax_debug(x.status);
				delete x;
				sajax_debug("XMLHttpRequest delete..");
				return true;
			}
			catch(error) {
				  console.error(error);
				  return false;
			}
		}
		
				
		// wrapper for return_enum		
		function x_return_enum() {
			sajax_do_call("return_enum",
				x_return_enum.arguments);
		}
		
				
		// wrapper for get_publiHtml		
		function x_get_publiHtml() {
			sajax_do_call("get_publiHtml",
				x_get_publiHtml.arguments);
		}
		
				
		// wrapper for return_list_unique		
		function x_return_list_unique() {
			sajax_do_call("return_list_unique",
				x_return_list_unique.arguments);
		}
		
				
		// wrapper for action_makePDFFromHtml		
		function x_action_makePDFFromHtml() {
			sajax_do_call("action_makePDFFromHtml",
				x_action_makePDFFromHtml.arguments);
		}
		
				
		// wrapper for return_html		
		function x_return_html() {
			sajax_do_call("return_html",
				x_return_html.arguments);
		}
		
				
		// wrapper for save_html		
		function x_save_html() {
			sajax_do_call("save_html",
				x_save_html.arguments);
		}
		
				
		// wrapper for whatYourName		
		function x_whatYourName() {
			sajax_do_call("whatYourName",
				x_whatYourName.arguments);
		}
		
				
		// wrapper for return_oneClient		
		function x_return_oneClient() {
			sajax_do_call("return_oneClient",
				x_return_oneClient.arguments);
		}
		
				
		// wrapper for action_updateClient		
		function x_action_updateClient() {
			sajax_do_call("action_updateClient",
				x_action_updateClient.arguments);
		}
		
				
		// wrapper for action_insertClient		
		function x_action_insertClient() {
			sajax_do_call("action_insertClient",
				x_action_insertClient.arguments);
		}
		
				
		// wrapper for return_oneClientByMel		
		function x_return_oneClientByMel() {
			sajax_do_call("return_oneClientByMel",
				x_return_oneClientByMel.arguments);
		}
		
				
		// wrapper for return_oneClientByIdModif		
		function x_return_oneClientByIdModif() {
			sajax_do_call("return_oneClientByIdModif",
				x_return_oneClientByIdModif.arguments);
		}
		
				
		// wrapper for return_listClientByMel		
		function x_return_listClientByMel() {
			sajax_do_call("return_listClientByMel",
				x_return_listClientByMel.arguments);
		}
		
				
		// wrapper for return_listClientByName		
		function x_return_listClientByName() {
			sajax_do_call("return_listClientByName",
				x_return_listClientByName.arguments);
		}
		
				
		// wrapper for return_oneClientByName		
		function x_return_oneClientByName() {
			sajax_do_call("return_oneClientByName",
				x_return_oneClientByName.arguments);
		}
		
				
		// wrapper for return_clients		
		function x_return_clients() {
			sajax_do_call("return_clients",
				x_return_clients.arguments);
		}
		
				
		// wrapper for return_countMailing		
		function x_return_countMailing() {
			sajax_do_call("return_countMailing",
				x_return_countMailing.arguments);
		}
		
				
		// wrapper for return_countMailingAEnvoyer		
		function x_return_countMailingAEnvoyer() {
			sajax_do_call("return_countMailingAEnvoyer",
				x_return_countMailingAEnvoyer.arguments);
		}
		
				
		// wrapper for return_countMailingEnvoye		
		function x_return_countMailingEnvoye() {
			sajax_do_call("return_countMailingEnvoye",
				x_return_countMailingEnvoye.arguments);
		}
		
				
		// wrapper for return_countMailingErreur		
		function x_return_countMailingErreur() {
			sajax_do_call("return_countMailingErreur",
				x_return_countMailingErreur.arguments);
		}
		
				
		// wrapper for initMailing		
		function x_initMailing() {
			sajax_do_call("initMailing",
				x_initMailing.arguments);
		}
		
				
		// wrapper for actionMailing		
		function x_actionMailing() {
			sajax_do_call("actionMailing",
				x_actionMailing.arguments);
		}
		
				
		// wrapper for envoiMailing		
		function x_envoiMailing() {
			sajax_do_call("envoiMailing",
				x_envoiMailing.arguments);
		}
		
				
		// wrapper for loadTexteMailing		
		function x_loadTexteMailing() {
			sajax_do_call("loadTexteMailing",
				x_loadTexteMailing.arguments);
		}
		
				
		// wrapper for return_list_marques		
		function x_return_list_marques() {
			sajax_do_call("return_list_marques",
				x_return_list_marques.arguments);
		}
		
				
		// wrapper for return_list_modeles		
		function x_return_list_modeles() {
			sajax_do_call("return_list_modeles",
				x_return_list_modeles.arguments);
		}
		
				
		// wrapper for return_oneFiche		
		function x_return_oneFiche() {
			sajax_do_call("return_oneFiche",
				x_return_oneFiche.arguments);
		}
		
				
		// wrapper for action_updateFiche		
		function x_action_updateFiche() {
			sajax_do_call("action_updateFiche",
				x_action_updateFiche.arguments);
		}
		
				
		// wrapper for action_insertFiche		
		function x_action_insertFiche() {
			sajax_do_call("action_insertFiche",
				x_action_insertFiche.arguments);
		}
		
				
		// wrapper for action_deleteFiche		
		function x_action_deleteFiche() {
			sajax_do_call("action_deleteFiche",
				x_action_deleteFiche.arguments);
		}
		
				
		// wrapper for return_oneFicheByIdModif		
		function x_return_oneFicheByIdModif() {
			sajax_do_call("return_oneFicheByIdModif",
				x_return_oneFicheByIdModif.arguments);
		}
		
				
		// wrapper for return_oneFicheByCode		
		function x_return_oneFicheByCode() {
			sajax_do_call("return_oneFicheByCode",
				x_return_oneFicheByCode.arguments);
		}
		
				
		// wrapper for action_createFiche		
		function x_action_createFiche() {
			sajax_do_call("action_createFiche",
				x_action_createFiche.arguments);
		}
		
				
		// wrapper for action_createFicheExpress		
		function x_action_createFicheExpress() {
			sajax_do_call("action_createFicheExpress",
				x_action_createFicheExpress.arguments);
		}
		
				
		// wrapper for action_mail		
		function x_action_mail() {
			sajax_do_call("action_mail",
				x_action_mail.arguments);
		}
		
				
		// wrapper for action_makePDF		
		function x_action_makePDF() {
			sajax_do_call("action_makePDF",
				x_action_makePDF.arguments);
		}
		
				
		// wrapper for action_changeEtatFiche		
		function x_action_changeEtatFiche() {
			sajax_do_call("action_changeEtatFiche",
				x_action_changeEtatFiche.arguments);
		}
		
				
		// wrapper for action_confirmeFiche		
		function x_action_confirmeFiche() {
			sajax_do_call("action_confirmeFiche",
				x_action_confirmeFiche.arguments);
		}
		
				
		// wrapper for action_vendFiche		
		function x_action_vendFiche() {
			sajax_do_call("action_vendFiche",
				x_action_vendFiche.arguments);
		}
		
				
		// wrapper for return_countByEtat		
		function x_return_countByEtat() {
			sajax_do_call("return_countByEtat",
				x_return_countByEtat.arguments);
		}
		
				
		// wrapper for return_fiches		
		function x_return_fiches() {
			sajax_do_call("return_fiches",
				x_return_fiches.arguments);
		}
		
				
		// wrapper for return_fiches_express		
		function x_return_fiches_express() {
			sajax_do_call("return_fiches_express",
				x_return_fiches_express.arguments);
		}
		
				
		// wrapper for return_oneParametre		
		function x_return_oneParametre() {
			sajax_do_call("return_oneParametre",
				x_return_oneParametre.arguments);
		}
		
				
		// wrapper for return_allParametre		
		function x_return_allParametre() {
			sajax_do_call("return_allParametre",
				x_return_allParametre.arguments);
		}
		
				
		// wrapper for action_updateParametre		
		function x_action_updateParametre() {
			sajax_do_call("action_updateParametre",
				x_action_updateParametre.arguments);
		}
		
				
		// wrapper for action_insertParametre		
		function x_action_insertParametre() {
			sajax_do_call("action_insertParametre",
				x_action_insertParametre.arguments);
		}
		
				
		// wrapper for return_infoAppli		
		function x_return_infoAppli() {
			sajax_do_call("return_infoAppli",
				x_return_infoAppli.arguments);
		}
		
				
		// wrapper for return_depotsBAV		
		function x_return_depotsBAV() {
			sajax_do_call("return_depotsBAV",
				x_return_depotsBAV.arguments);
		}
		
				
		// wrapper for return_tauxBAV		
		function x_return_tauxBAV() {
			sajax_do_call("return_tauxBAV",
				x_return_tauxBAV.arguments);
		}
		
		