<?php
/**
 * @package Zarya
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet"> 

</head>

<body <?php body_class(); ?>>

<?php get_template_part( 'template-parts/loader', 'none' ); ?>

<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'zarya' ); ?></a>

	<div id="masthead-container" class="full-width">

		<header id="masthead" class="site-header page-width">

			<nav id="hamburger-nav" class="main-navigation">
				<button 
					id="hamburger-button"
					class="hamburger hamburger--collapse hamburger-button" 
					aria-label="Navigation Menu"
					aria-controls="primary-menu" 
					aria-expanded="false">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
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

			</nav><!-- #hamburger-nav -->

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
				$zarya_description = get_bloginfo( 'description', 'display' );
				if ( $zarya_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $zarya_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<div id="ecommerce-menu" class="secondary-navigation">
				<?php $uri = get_template_directory_uri(); ?>
				<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><img src="<?php echo $uri; ?>/assets/account.svg" alt="account icon"></a>
				<a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><img src="<?php echo $uri; ?>/assets/bag.svg" alt="cart icon"></a>
			</div>


		</header><!-- #masthead -->

		<nav id="site-navigation" class="main-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'desktop-menu',
					'menu_class' => 'desktop-menu page-width',
					'menu_id' => 'desktop-menu',
					'container' => 'div',
				)
			);
			?>
		</nav>


	</div><!-- #masthead-container -->
	<div class="site-body">
