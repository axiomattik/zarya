<?php
/**
 * @package Zarya
 */

?>
	</div><!-- .site-body -->

	<footer id="site-footer">
		<div id="footer-top-container">
			<div id="footer-top">

			<?php 
			$menus = get_registered_nav_menus();
			foreach ( $menus as $location => $description ) :
				if ( ! str_contains( $location, 'footer' ) ) continue; 
				if ( ! has_nav_menu( $location ) ) continue;

			?>

					<div class="footer-menu-wrapper">
						<div class="footer-menu">
							<h3><?php echo wp_get_nav_menu_name( $location ); ?></h3>
							<div class="chevron"></div>

							<?php
							wp_nav_menu( array( 
								'menu' => $location,
								'depth' => 0,
								'theme-location' => $location,
								'container' => 'div',
								'container_class' => 'menu hidden', /* hidden class affects mobile not desktop */
								'fallback_cb' => false,
							));
							?>

						</div>
					</div>

			<?php endforeach; ?>

			</div><!-- footer-top -->
		</div><!-- footer-top-container -->

		<div id="footer-bottom-container">
			<div id="footer-bottom">
				<span>© <?php echo get_bloginfo("name") . " " . date("Y"); ?></span>
				<div>
				<span><a href="<?php echo get_permalink(get_option('wp_page_for_privacy_policy')); ?>">Privacy</a></span>
				<span class="sep"> | </span>
				<span><a href="<?php echo get_permalink(get_option('woocommerce_terms_page_id')); ?>">Terms & Conditions</a></span>
				</div>
			</div><!-- footer-bottom -->
		</div><!-- footer-bottom-container -->
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

