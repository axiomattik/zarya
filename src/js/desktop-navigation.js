(function() {

	
	window.addEventListener('load', function() {
		
		const navigationMenu = document.getElementById('navigation-menu');
		const parentItems = navigationMenu.children[0].children;
		const submenus = document.getElementById('navigation-submenu-container').children;

		function closeAllSubmenus() {
			for (let i = 0; i < submenus.length; i++) {
				submenus[i].classList.remove('active');
			}
		}

		function openSubmenu(index) {
				submenus[index].classList.add('active');
		}


		for (let i = 0; i < parentItems.length; i++) {
			parentItems[i].addEventListener('mouseenter', function() {
				closeAllSubmenus();
				openSubmenu(i);
			});

			submenus[i].addEventListener('mouseleave', function() {
				closeAllSubmenus();
			});
		}

	})
})();
