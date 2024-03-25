/*
(function() {
/* For layout purposes, make sure that every shop page
	 has a number of products divisible by 2, 3 and 4
	 by adding contentless dummy products where necessary.
	 This is a hack to ensure all flex items are the same width.
	 In the future these dummy elements could be dynamically filled
	 with real products.

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

*/
