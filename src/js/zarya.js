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
	}


	window.addEventListener('DOMContentLoaded', (e) => {
		setupHamburger();
	});

})();
