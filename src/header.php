<?php
/**
 * @package _s
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>

	<header id="masthead" class="site-header full-width">
		<div id="masthead-top" class="page-width">

			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$_s_description = get_bloginfo( 'description', 'display' );
				if ( $_s_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $_s_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<div id="ecommerce-menu" class="secondary-navigation">
				<?php $uri = get_template_directory_uri(); ?>
				<a href="/my-account/"><img src="<?php echo $uri; ?>/assets/account.svg" alt="account icon"></a>
				<a href="/cart/"><img src="<?php echo $uri; ?>/assets/bag.svg" alt="shopping bag icon"></a>
			</div>
		</div> <!-- masthead-top -->
		<div id="masthead-bottom" class="full-width"> 

			<nav id="site-navigation" class="main-navigation page-width">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', '_s' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'site-navigation-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->

		</div> <!-- masthead-bottom -->
	</header><!-- #masthead -->
	<div class="site-body">
