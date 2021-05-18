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

	<div id="masthead-container" class="full-width">

	<header id="masthead" class="site-header page-width">
			<nav id="hamburger-nav" class="main-navigation page-width">
				<button 
					id="hamburger-button"
					class="hamburger hamburger--collapse hamburger-button" 
					aria-label="Navigation Menu"
					aria-controls="primary-menu" 
					aria-expanded="false">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
					<?php esc_html_e( 'Menu', '_s' ); ?>
				</button>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'hamburger-menu',
						'menu_class' => 'hamburger-menu-no-js',
						'menu_id' => 'hamburger-menu',
						'container' => 'ul',
					)
				);
				?>
			</nav><!-- #site-navigation -->

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

		</header><!-- #masthead -->
	</div><!-- #masthead-container -->
	<div class="site-body">
