(function() {
	for (let fm of document.querySelectorAll(".footer-menu")) {
		fm.addEventListener("click", function() {
			fm.children[1].classList.toggle("rotate");
		});
	}
})();
