(function() {
	let decbtn = document.querySelector(".quantity>button.decrement");
	let incbtn = document.querySelector(".quantity>button.increment");
	let quantity = document.querySelector(".quantity>input.qty");
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
		disable_buttons();
	});

	incbtn.addEventListener('click', function(e) {
		e.preventDefault();
		let val = parseInt(quantity.value);
		if ( !maxval || val < maxval ) {
			quantity.value = (val + 1).toString();
		}
		disable_buttons();
	});


})();
