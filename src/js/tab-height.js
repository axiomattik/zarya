(function() {
	/* ensure a uniform height for woocommerce tab panels */

	function adjustTabPanelHeights() {
		let tabpanels = document.querySelectorAll("div.woocommerce-Tabs-panel");
		let baseFontSize = window.getComputedStyle(
			document.getRootNode().children[0]
		).fontSize.replace("px", "");

		// recalculate automatic heights of tab panels 
		// and find the maximum height
		let maxHeight = 0;
		for (let tb of tabpanels) {
			let tmpdisplay = tb.style.display;
			tb.style.display = "block";
			tb.style.height = "auto";
			if ( tb.offsetHeight > maxHeight ) maxHeight = tb.offsetHeight;
			tb.style.display = tmpdisplay;
		}

		// set all tab panels to have that height
		let height = (maxHeight / baseFontSize).toString() + "rem";
		for (let tb of tabpanels) {
			tb.style.height = height;
		}
	}

	window.addEventListener("load", adjustTabPanelHeights);
	window.addEventListener("resize", adjustTabPanelHeights);

})();
