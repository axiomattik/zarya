<?php
/**
 * @package _s
 */
get_header();
?>
<main id="primary" class="site-main">
	<div id="hero">

	</div>
	<div id="featured-products">

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>

	</div>
</main>
<?php
get_sidebar();
get_footer();
