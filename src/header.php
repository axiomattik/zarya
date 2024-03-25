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
<div id="page">

	<div id="masthead-container">

		<header id="masthead">

			<nav id="hamburger-nav">
				<button 
					id="hamburger-button"
					class="collapse" 
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

			<div id="site-branding">
				<div id="logo-container"><?php the_custom_logo(); ?></div>
				<div id="title-desc-container">
				<?php if ( is_front_page() && is_home() ) : ?>
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
				</div>
			</div><!-- #site-branding -->

			<div id="ecommerce-menu">
				<?php $uri = get_template_directory_uri(); ?>
				<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><img src="<?php echo $uri; ?>/assets/account.svg" alt="account icon"></a>
				<a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><img src="<?php echo $uri; ?>/assets/bag.svg" alt="cart icon"></a>
			</div><!-- #ecommerce-menu -->


		</header><!-- #masthead -->

		<nav id="site-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'desktop-menu',
					'menu_id' => 'desktop-menu',
					'container' => 'div',
				)
			);
			?>
		</nav>


	</div><!-- #masthead-container -->
	<div id="site-body">
