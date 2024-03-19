(function() {

	const removeElement = (e) => e.parentElement.removeChild(e);


	const queryNotices = () =>
		[...document.querySelectorAll("div.woocommerce-error"),
		 ...document.querySelectorAll("div.woocommerce-message"),
		 ...document.querySelectorAll("div.woocommerce-info")];


	function relocateMisplacedNotice(notice) {
		/* WooCommerce places some notices in seemingly arbitrary locations on the page
		   This function moves a notice to the primary notices-wrapper */
		let noticesWrapper = document.querySelector("div.woocommerce-notices-wrapper");
		noticesWrapper.appendChild(notice);
	}


	function timeoutNotice(notice, delay=1000) {
		function timeout() {
			setTimeout(function() {
				removeElement(notice);
			}, delay);
			document.removeEventListener('pointermove', timeout);
		}

		document.addEventListener('pointermove', timeout);
	}


	function initialiseCloseButton(notice) {
		let closeButton = notice.children[0];
		closeButton.addEventListener('click', function() {
			removeElement(notice);
		});
	}


	function initialiseNotices(notices) {
		let closeDelay = 2000;
		for (let n of notices) {
			relocateMisplacedNotice(n);
			initialiseCloseButton(n);
			timeoutNotice(n, closeDelay);
			closeDelay += 800;
		}
	}
	
	window.addEventListener("load", function() {
		/* prevent woocommerce auto scrolling behaviour */
		setTimeout(function() {
			jQuery.scroll_to_notices = function() {
				return;
			};
		}, 500);


		/* add event listeners to initialise notices */
		jQuery(document.body).on('updated_checkout', function() {
			initialiseNotices(queryNotices());
			
		});

		jQuery(document.body).on('wc_fragments_refreshed', function() {
			initialiseNotices(queryNotices());
		});


		/* after checkout form is submitted, initialise notifications once they are returned */
		let formCheckout = document.querySelector("form.checkout");
		if (formCheckout) {

			formCheckout.addEventListener("submit", function() {

				let notificationChecker = setInterval(function() {
					let notices = queryNotices();
					if (notices) {
						initialiseNotices(notices);
						clearInterval(notificationChecker);
					}
				}, 400);

			});

		}

	});




})();


