<?php
/**
 * Empty cart page
 *
 * This template overrides /woocommerce/cart/cart-empty.php.
 * 
 * Change List
 *
 * - add basket icon 
 * - change empty cart message (could be in functions.php)
 * - add 'zarya-button' class to 'return to shop' button
 * - change 'return to shop' button text to 'keep shopping' (again, functions.php)
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

//TODO: There is a bug where if all items are removed from the basket then the 'your basket is empty' message is displayed as a notification at the top of the screen instead of in the page body. 


/* Display the cart icon */
$uri = get_template_directory_uri(); ?>
<div id="empty-cart-container">
	<img src="<?php echo $uri; ?>/assets/bag.svg" alt="cart icon">

<?php


/* Change the empty cart message */
function zarya_empty_cart_message() {
	return __( 'Your basket is empty', 'zarya' );
}
add_filter( 'wc_empty_cart_message', 'zarya_empty_cart_message' );


/* Change the 'return to shop' button text */
function zarya_return_to_shop_text() {
	return __( 'Keep Shopping', 'zarya' );
}
add_filter( 'woocommerce_return_to_shop_text', 'zarya_return_to_shop_text' );


/*
 * @hooked wc_empty_cart_message - 10
 */
do_action( 'woocommerce_cart_is_empty' );

//TODO: /* If not signed in, display message and link to sign in */

if ( ! is_user_logged_in() ) : ?>
	<p>Missing items from your basket? <a>Sign in</a></p>
<?php endif; ?>
	


<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<p class="return-to-shop">
		<a class="zarya-button button wc-backward<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php
				/**
				 * Filter "Return To Shop" text.
				 *
				 * @since 4.6.0
				 * @param string $default_text Default text.
				 */
				echo esc_html( apply_filters( 'woocommerce_return_to_shop_text', __( 'Return to shop', 'woocommerce' ) ) );
			?>
		</a>
	</p>
<?php endif; ?>

</div><!-- empty-cart-container -->
