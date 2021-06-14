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
			foreach ($menus as $slug => $name):
				if ( strpos( $slug, "footer" ) === 0 ): ?>

					<div class="footer-menu-wrapper full-width">
						<div class="footer-menu page-width">
							<h3><?php echo $name; ?></h3>
							<div class="chevron"></div>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => $slug,
									'depth' => 1,
									'menu_class' => 'menu hidden',
								)
							);
							?>
						</div>
					</div>

				<?php endif;
			endforeach;
			?>
			</div><!-- footer-top -->
		</div><!-- footer-top-container -->
		<div id="footer-bottom-container" class="full-width">
			<div id="footer-bottom" class="page-width">
				<div id="footer-bottom-left">

				</div><!-- footer-bottom-left -->

				<div id="footer-bottom-right">
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'zarya' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( 'Proudly powered by %s', 'zarya' ), 'WordPress' );
							?>
						</a>
						<span class="sep"> | </span>
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( 'Theme: %1$s by %2$s.', 'zarya' ), 'zarya', '<a href="https://automattic.com/">Automattic</a>' );
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
