<?php
/**
 * @package _s
 */

?>
	</div><!-- .site-body -->

	<footer id="colophon" class="site-footer full-width">
		<div id="footer-top-container" class="full-width">
			<div id="footer-top" class="page-width">

				<div>
					<h3>Help and Support</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-left',
							'depth' => 1,
						)
					);
					?>
				</div>

				<div>
					<h3>About <?php echo get_bloginfo('name'); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-middle',
							'depth' => 1,
							'fallback_cb' => false,
						)
					);
					?>
				</div>

				<div>
					<h3>Shop</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-right',
							'depth' => 1,
						)
					);
					?>
				</div>
			</div><!-- footer-top -->
		</div><!-- footer-top-container -->
		<div id="footer-bottom-container" class="full-width">
			<div id="footer-bottom" class="page-width">
				<div id="footer-bottom-left">

				</div><!-- footer-bottom-left -->

				<div id="footer-bottom-right">
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', '_s' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( 'Proudly powered by %s', '_s' ), 'WordPress' );
							?>
						</a>
						<span class="sep"> | </span>
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( 'Theme: %1$s by %2$s.', '_s' ), '_s', '<a href="https://automattic.com/">Automattic</a>' );
							?>
					</div><!-- .site-info -->
				</div><!-- footer-bottom-right -->
			</div><!-- footer-bottom -->
		</div><!-- footer-bottom-container -->
	</footer><!-- #colophon -->

	<?php global $template; echo basename($template); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
