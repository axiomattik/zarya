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
