
<script>
	var tri = "obj_numero";
	var sens = "asc";
	var tabSel = {};
	var anneeBav='<?=$infAppli['numero_bav']?>';
	function initPage() {
		if (ADMIN) {
			x_return_allParametre(display_parametres);
			x_return_list_unique("bav_counter_access", "cas_page",display_actions)
		} else {
			// si pas ADMIN retour page accueil
			goTo();
		}
	}
	function changeNumeroBAV(val) {
		SetCookie("par_numero_bav_stat",val);
		goTo('statSite.php');
	}
	
	function display_parametres(val) {
		var select = getElement("annee_stat");
		select.options[select.options.length] = new Option("Choix", "*");
		for (index in val) {
			select.options[select.options.length] = new Option(val[index]['par_numero_bav']+"-"+val[index]['par_titre'], val[index]['par_numero_bav']);
			if ( anneeBav == index) {
				select.options[select.options.length - 1].selected = true;
			}
		}
	}

	function display_actions(val) {
		console.log(val);
	}
	
	function unloadPage() {}
</script>
<select id="annee_stat" onchange="changeNumeroBAV(this.value)"></select>