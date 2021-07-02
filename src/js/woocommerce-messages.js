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


	/* remove notifications if closed by user or after a certain time has elapsed */
	jQuery(document.body).on('wc_fragments_refreshed', function() {

		let closeButtons = document
			.querySelectorAll('div.woocommerce-notices-wrapper span.remove');

		for (let cb of closeButtons) {
			cb.addEventListener('click', function(e) {
				let notice = e.target.parentElement;
				notice.parentElement.removeChild(notice);
			})
			
			setTimeout(function() {
				cb.click();
			}, 2000);
		}
	});

})();


