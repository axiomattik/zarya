(function() {
	
	window.addEventListener("load", function() {

	});

	function htmlToElement(html) {
		let elem = document.createElement('template');
		html = html.trim();
		elem.innerHTML = html;
		return elem.content.firstChild;
	}

	async function requestNotice() {
		let data = new FormData();
		data.append('action', 'wc_notice');
		data.append('message', 'Item added to basket');
		data.append('notice_type', 'success');

		let response = await fetch("/wp-admin/admin-ajax.php", {
			method: 'POST',
			credentials: 'same-origin',
			body: data,
		});

		if ( ! response.ok ) {
			throw new Error(`HTTP Error: ${response.status}`);
		}

		return response.text();
	}


	jQuery(document.body).on('added_to_cart', function() {
		let wcNoticeWrapper = document.querySelector("div.woocommerce-notices-wrapper");

		requestNotice()
			.then(html => {
				let div = htmlToElement(html);
				wcNoticeWrapper.appendChild(div);
				/* the notice will close as a result of this trigger */
				jQuery(document.body).trigger('wc_fragments_refreshed');
			})
			.catch(e => console.log(e));

	});

})();


