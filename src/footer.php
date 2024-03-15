<?php
/**
 * @package Zarya
 */

?>
	</div><!-- .site-body -->

	<footer id="colophon" class="site-footer full-width">
		<div id="footer-top-container" class="full-width">
			<div id="footer-top" class="full-width">

			<?php 
			$menus = get_registered_nav_menus();
			foreach ( $menus as $location => $description ) :
				if ( ! str_contains( $location, 'footer' ) ) continue; 
				if ( ! has_nav_menu( $location ) ) continue;

			?>

					<div class="footer-menu-wrapper full-width">
						<div class="footer-menu page-width">
							<h3><?php echo wp_get_nav_menu_name( $location ); ?></h3>
							<div class="chevron"></div>

							<?php
							wp_nav_menu( array( 
								'menu' => $location,
								'depth' => 0,
								'theme-location' => $location,
								'conatiner' => 'div',
								'container_class' => 'menu hidden',
								'fallback_cb' => false,
							));
							?>

						</div>
					</div>

			<?php endforeach; ?>

			</div><!-- footer-top -->
		</div><!-- footer-top-container -->
		<div id="footer-bottom-container" class="full-width">
			<div id="footer-bottom" class="page-width">
				<span>© <?php echo get_bloginfo("name") . " " . date("Y"); ?></span>
				<div>
				<span><a href="<?php echo get_permalink(get_option('wp_page_for_privacy_policy')); ?>">Privacy</a></span>
				<span class="sep"> | </span>
				<span><a href="<?php echo get_permalink(get_option('woocommerce_terms_page_id')); ?>">Terms & Conditions</a></span>
				</div>
			</div><!-- footer-bottom -->
		</div><!-- footer-bottom-container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

