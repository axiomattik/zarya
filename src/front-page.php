<?php
/**
 * @package Zarya
 */
get_header();
?>
<main id="primary" class="site-main">
	<?php if ( has_header_image() ): ?>
	<div id="hero">
		<?php the_header_image_tag(); ?>
	</div>
	<?php endif; ?>
	<div id="featured-products">

	</div>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>

</main>
<?php
get_sidebar();
get_footer();
