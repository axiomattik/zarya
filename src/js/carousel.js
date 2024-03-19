(function() {
	const slides = document.querySelectorAll('.zarya-carousel-slide');
	if (slides.length === 0) return;
	const dots = document.querySelectorAll('#zarya-carousel-dots > li');
	const nextChevron = document.getElementById('zarya-carousel-next');
	const prevChevron = document.getElementById('zarya-carousel-prev');

	function mod(n, m) {
		return ((n % m) + m) % m;
	}


	function setActiveSlide(index) {
		// Add 'inactive' class to all slides
		slides.forEach(slide => slide.classList.add('inactive'));
		dots.forEach(dot => dot.classList.remove('active'));

		// Remove 'inactive' class from the next slide 
		slides[index].classList.remove('inactive');
		dots[index].classList.add('active');
	}


	function cycleSlides(increment=1) {
		const activeIndex = Array.from(slides).findIndex(div => !div.classList.contains('inactive'));
		const nextIndex = mod((activeIndex + increment), slides.length);
		setActiveSlide(nextIndex);
	}


	nextChevron.addEventListener('click', function() {
		cycleSlides();
	});


	prevChevron.addEventListener('click', function() {
		cycleSlides(-1);
	});

	dots.forEach((dot, index) => {
		dot.addEventListener('click', function() {
			setActiveSlide(index);
		});
	});


	window.addEventListener("load", function() {
		cycleSlides();
		// setInterval(cycleSlides, 500);

	});
})();
