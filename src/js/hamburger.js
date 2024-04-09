(function() {
	/* Disable page scroll whilst hamburger menu is open */

	window.addEventListener('load', function() {

		const body = document.getElementsByTagName('body')[0];
		document.getElementById('hamburger-toggle').addEventListener('change', function() {
			if (this.checked) {
				body.classList.add('disable-scroll');
			} else {
				body.classList.remove('disable-scroll');
			}
		});

		// TODO: what if page scroll is disabled and then window is resized, hiding hamburger?

	});

})();
