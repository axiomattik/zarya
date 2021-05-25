(function() {
	/* ensure a uniform height for woocommerce tab panels */

	let tabpanels = document.querySelectorAll("div.woocommerce-Tabs-panel");

	// find the maximum height
	let maxHeight = 0;
	for (let tb of tabpanels) {
		if ( tb.offsetHeight > maxHeight ) maxHeight = tb.offsetHeight;
	}

	// set all tab panels to have that height
	for (let tb of tabpanels) {
		tb.style.height = maxHeight.toString() + "px";
	}

})();
