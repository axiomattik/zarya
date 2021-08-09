(function() {
/* For layout purposes, make sure that every shop page
	 has a number of products divisible by 2, 3 and 4
	 by adding contentless dummy products where necessary.
	 This is a hack to ensure all flex items are the same width.
	 In the future these dummy elements could be dynamically filled
	 with real products.
*/

const dummy = () => {
	let li = document.createElement("li");
	li.classList.add("dummy");
	li.classList.add("product");
	return li;
}

window.addEventListener("load", function() {
	let ul = document.querySelector("ul.products");
	if ( ! ul ) return;
	while ( ul.children.length % 3 != 0 || ul.children.length % 4 != 0  ) {
		ul.appendChild(dummy());
	}
});


})();

(function() {
	for (let fm of document.querySelectorAll(".footer-menu")) {
		fm.addEventListener("click", function() {
			fm.children[1].classList.toggle("rotate");
			fm.children[2].classList.toggle("hidden");
		});
	}
})();


(function() {

	let hamburgerNav;
	let hamburgerButton;
	let hamburgerMenu;
	let hamburgerOverlay;

	const isExpanded = () => hamburgerButton.getAttribute('aria-expanded') == 'true';


	const submenuButton = (submenu) => {

		const button = document.createElement('button');
		const span = document.createElement('span');

		span.classList.add('chevron');
		button.appendChild(span);

		button.setAttribute('aria-label', 'Navigation Submenu');
		button.setAttribute('aria-expanded', 'false');
		button.classList.add('hamburger-submenu-button');
		button.onclick = () => {
			let expanded = button.getAttribute('aria-expanded') == 'true';
			button.setAttribute('aria-expanded', (!expanded).toString());
			span.classList.toggle('rotate');
			submenu.classList.toggle('hamburger-submenu-visible');
		}

		return button;

	};


	const overlay = () => {
		const div = document.createElement('div');
		div.classList.add('hamburger-overlay');
		div.onclick = () => toggleHamburger();
		return div;
	};




	function setupHamburger() {
		// Initialise Hamburger
		hamburgerNav = document.querySelector('#hamburger-nav');
		hamburgerButton = document.querySelector('#hamburger-button');
		hamburgerMenu = document.querySelector('#hamburger-menu');
		hamburgerOverlay = overlay();


		hamburgerNav.appendChild(hamburgerOverlay);
		hamburgerButton.classList.add('hamburger-button-visible');
		hamburgerButton.onclick = () => toggleHamburger();
		hamburgerMenu.classList.toggle('hamburger-menu-no-js');
		hamburgerMenu.classList.add('hamburger-menu');

		// Escape key closes the hamburger menu
		document.onkeyup = function(e) {
			if (e.key === 'Escape' && isExpanded())
				toggleHamburger();
		}

		// Initialise Submenus

		// loop through items of hamburger-menu, if the item has children change its class
		for (let submenu of document.querySelectorAll('.sub-menu')) {
			let submenuTitle = submenu.parentElement;
			let anchor = submenuTitle.querySelector('a');
			let button = submenuButton(submenu);
			submenuTitle.classList.add('hamburger-submenu-title');
			submenu.classList.add('hamburger-submenu');
			submenuTitle.insertBefore(button, submenu);
			if (anchor) {
				anchor.removeAttribute("href");
				anchor.onclick = () => button.click();
			}
		}
	}


	function toggleHamburger() {
		hamburgerButton.setAttribute('aria-expanded', (!isExpanded()).toString());
		hamburgerButton.classList.toggle('is-active');
		hamburgerOverlay.classList.toggle('hamburger-overlay-visible');
		hamburgerMenu.classList.toggle('hamburger-menu-visible');
		document.body.classList.toggle('prevent-scroll');
		document.documentElement.classList.toggle('prevent-scroll');
	}


	window.addEventListener('DOMContentLoaded', (e) => {
		setupHamburger();
	});

})();

(function() {
	window.addEventListener("load", function() {
		let loader = document.querySelector("#loader");
		loader.classList.add("done");
	});
})();

(function() {
	
	jQuery(document.body).on('wc_fragments_refreshed', function() {
		initialise_quantity_buttons();
	});

	window.addEventListener('load', function() {
		initialise_quantity_buttons();
	});

	function initialise_quantity_buttons() {
		function update() {
			let updateButton = document.querySelector("td.actions>button[name='update_cart']");
			if (updateButton) {
				updateButton.disabled = false;
				updateButton.click();

			}
		}

		for (let div of document.querySelectorAll("div.quantity")) {
			let decbtn = div.querySelector("button.decrement");
			let incbtn = div.querySelector("button.increment");
			let quantity = div.querySelector("input.qty");
			let minval = quantity.min; 
			let maxval = quantity.max;
			
			function disable_buttons() {
				let val = parseInt(quantity.value);
				if ( minval != "" && val <= minval ) {
					decbtn.classList.add("quantity__disabled");
				} else {
					decbtn.classList.remove("quantity__disabled");
				}

				if ( maxval != "" && val >= maxval ) {
					incbtn.classList.add("quantity__disabled");
				} else {
					incbtn.classList.remove("quantity__disabled");
				}
			}

			disable_buttons();

			decbtn.addEventListener('click', function(e) {
				e.preventDefault();
				let val = parseInt(quantity.value);
				if ( !minval || val > minval ) {
					quantity.value = (val - 1).toString();
				}
				update();
			});

			incbtn.addEventListener('click', function(e) {
				e.preventDefault();
				let val = parseInt(quantity.value);
				if ( !maxval || val < maxval ) {
					quantity.value = (val + 1).toString();
				}
				update();
			});

		}

	}


})();

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
		formCheckout.addEventListener("submit", function() {

			let notificationChecker = setInterval(function() {
				let notices = queryNotices();
				if (notices) {
					initialiseNotices(notices);
					clearInterval(notificationChecker);
				}
			}, 400);

		});

	});




})();


