<?php
/**
 * Zarya Theme Customizer
 *
 * @package Zarya
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function zarya_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'zarya_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'zarya_customize_partial_blogdescription',
			)
	);
	}

	/* Colours */




  /* Carousel */

  $wp_customize->add_section( 'zarya_carousel', array(
    'title' => __( 'Carousel', 'zarya' ),
    'priority' => 35,
    'capability' => 'edit_theme_options'
  ) );

	$wp_customize->add_setting( 'zarya_carousel_image_url', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_url'
	) );

	$wp_customize->add_control( 'zarya_carousel_image_url', array(
		'type' => 'url',
		'label' => 'Image URL',
		'section' => 'zarya_carousel',
	) );


	$wp_customize->add_setting( 'zarya_carousel_button_text', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'zarya_carousel_button_text', array(
		'type' => 'text',
		'label' => 'Button Text',
		'section' => 'zarya_carousel',
	) );


	$wp_customize->add_setting( 'zarya_carousel_button_link', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_url'
	) );

	$wp_customize->add_control( 'zarya_carousel_button_link', array(
		'type' => 'url',
		'label' => 'Button Link URL',
		'section' => 'zarya_carousel',
	) );




}
add_action( 'customize_register', 'zarya_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function zarya_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function zarya_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zarya_customize_preview_js() {
	wp_enqueue_script( 'zarya-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), ZARYA_VERSION, true );
}
add_action( 'customize_preview_init', 'zarya_customize_preview_js' );
