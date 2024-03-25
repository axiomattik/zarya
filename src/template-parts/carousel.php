<?php
	function explode_and_trim($string, $delimiter = ';') {
		return array_map('trim', explode($delimiter, $string));
	}

	$image_urls = explode_and_trim(get_theme_mod('zarya_carousel_image_url'));
	$button_texts = explode_and_trim(get_theme_mod('zarya_carousel_button_text'));
	$button_links = explode_and_trim(get_theme_mod('zarya_carousel_button_link'));

	$slides = [];

	$n = count($image_urls); /* TODO: don't assume that all arrays have the same count */
	for ($i = 0; $i < $n; $i++ ) {
		$slide = new StdClass();

		$slide->image_url = $image_urls[$i];
		$slide->button_text = $button_texts[$i];
		$slide->button_link = $button_links[$i];

		array_push($slides, $slide);
	}

?>

<div id="zarya-carousel-container">

	
	<div id="zarya-carousel">
		<span id="zarya-carousel-prev" class="chevron"></span>
		<div id="zarya-carousel-contents">

		<?php foreach ( $slides as $slide): ?>

			<div class="zarya-carousel-slide inactive">
				<img src="<?php echo $slide->image_url; ?>">
				<a href="<?php echo $slide->button_link; ?>" class="zarya-button"><?php echo $slide->button_text; ?></a>
			</div>

		<?php endforeach; ?>

		</div><!-- #zarya-carousel-contents -->
		<span id="zarya-carousel-next" class="chevron"></span>

	</div><!-- #zarya-carousel -->

	<ul id="zarya-carousel-dots">
		<li class="active"></li>
		<li></li>
		<li></li>
	</ul><!-- #zarya-carousel-dots -->


</div><!-- #zarya-carousel-container -->

