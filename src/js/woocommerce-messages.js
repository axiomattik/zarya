(function() {
	
	/* prevent woocommerce auto scrolling behaviour */
	window.addEventListener("load", function() {
		setTimeout(function() {
			jQuery.scroll_to_notices = function() {
				return;
			};
			console.log(jQuery.scroll_to_notices.toString());
		}, 500);
	});

	jQuery(document.body).on('wc_fragments_refreshed', function() {
		let msgdiv = document.querySelector('div.woocommerce-notices-wrapper');
		let msg = msgdiv.innerText;
		console.log(msgdiv.innerText);
	});

})();


