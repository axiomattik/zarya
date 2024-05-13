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

</head>

<body <?php body_class(); ?>>

<?php get_template_part( 'template-parts/loader', 'none' ); ?>

<?php wp_body_open(); ?>

<div id="page">

	<div id="masthead-container">

		<header id="masthead">

			<nav id="navigation-menu">
				<input id="hamburger-toggle" type="checkbox"></input>
				<label for="hamburger-toggle" class="hamburger">
					<span></span>
					<span></span>
					<span></span>
				</label>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'navigation-menu',
						'depth' => '0',
						'container' => 'ul',
				)); ?>
				<div id="hamburger-overlay"></div>
			</nav><!-- #navigation-menu -->


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
				endif; ?>

				<p class="site-description"><?php echo get_bloginfo( 'description', 'display' ); ?></p>

				</div>
			</div><!-- #site-branding -->


			<div id="ecommerce-menu">
				<?php $uri = get_template_directory_uri(); ?>
				<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><img src="<?php echo $uri; ?>/assets/account.svg" alt="account icon"></a>
				<a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><img src="<?php echo $uri; ?>/assets/bag.svg" alt="cart icon"></a>
			</div><!-- #ecommerce-menu -->


		</header><!-- #masthead -->

	</div><!-- #masthead-container -->

	<div id="site-body">
