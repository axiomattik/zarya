<?php
/**
 * @package _s
 */

?>
	</div><!-- .site-body -->

	<footer id="colophon" class="site-footer">
		<div id="footer-top">
			<?php
			wp_nav_menu(
				array(
					'theme-location' => 'footer-menu-1',
					'menu_id' => 'footer-menu-1',
				)
			);
			?>

			<?php
			wp_nav_menu(
				array(
					'theme-location' => 'footer-menu-2',
					'menu_id' => 'footer-menu-2',
				)
			);
			?>

			<?php
			wp_nav_menu(
				array(
					'theme-location' => 'footer-menu-3',
					'menu_id' => 'footer-menu-3',
				)
			);
			?>
		</div>
		<div id="footer-bottom">
			<div id="footer-bottom-left">

			</div>

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
			</div>
		</div>
	</footer><!-- #colophon -->

	<?php global $template; echo basename($template); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
