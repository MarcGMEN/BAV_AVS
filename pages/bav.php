<script>
	function initPage() {
		x_return_html('bav_bourse', display_bav_bourse);
	}

	function display_bav_bourse(val) {
		getElement('bav_bourse').innerHTML = val;
	}

	function unloadPage() { }
</script>

<div class="col-md-12 col-sm-12 col-xs-12" id="bav_bourse">
