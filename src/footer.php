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
				<span>© <?php echo get_bloginfo("name") . " " . date("Y"); ?></span>
				<div>
				<span><a href="/privacy-policy/">Privacy</a></span>
				<span class="sep"> | </span>
				<span><a href="/terms-and-conditions/">Terms & Conditions</a></span>
				</div>
			</div><!-- footer-bottom -->
		</div><!-- footer-bottom-container -->
	</footer><!-- #colophon -->

	<?php global $template; echo basename($template); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
