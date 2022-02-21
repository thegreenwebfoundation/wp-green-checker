<?php
/**
 * Handles all the style and script enqueues for the plugin.
 *
 *  @package tgwfgreenchecker
 */

add_action( 'wp', 'tgwf_register_scripts' );
add_action( 'wp_enqueue_scripts', 'tgwf_load_shortcode_styles' );


/**
 * Initialises the registration of scripts.
 */
function tgwf_register_scripts() {

	if ( is_page( 'directory' ) ) {
		add_action( 'wp_enqueue_scripts', 'tgwf_enqueue_directory_scripts' );
	}

	if ( is_page( 'green-web-check' ) ) {
		add_action( 'wp_enqueue_scripts', 'tgwf_enqueue_greencheck_scripts' );
	}
}

/**
 * Loads the scripts and styles required for the directory page.
 */
function tgwf_enqueue_directory_scripts() {
	// Enqueue styles.
	wp_enqueue_style( 'tgwf-directory', URL_DIR . 'public/css/directory.css', array(), filemtime( PDEV_DIR . 'public/css/directory.css' ), 'all' );
	wp_enqueue_style( 'tgwf-jqvmap', URL_DIR . 'public/css/jqvmap.css', array(), '1.0', 'all' );

	// Enqueue scripts.
	wp_enqueue_script( 'tgwf-directory', URL_DIR . 'public/js/directory.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'tgwf-scripts', URL_DIR . 'public/js/tgwf.js', array( 'jquery' ), '', false );
	wp_enqueue_script( 'tgwf-vmap', URL_DIR . 'public/js/jquery.vmap.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'tgwf-vmap-world', URL_DIR . 'public/js/maps/jquery.vmap.world.js', array( 'jquery' ), '1.0', true );
}


/**
 * Loads the scripts and styles required for the green web check page.
 */
function tgwf_enqueue_greencheck_scripts() {

	// Enqueue styles.
	wp_enqueue_style( 'tgwf-checker', URL_DIR . 'public/css/tgwfchecker.css', array(), filemtime( PDEV_DIR . 'public/css/tgwfchecker.css' ), 'all' );
	wp_enqueue_style( 'tgwf-searchform', URL_DIR . 'public/css/tgwf-searchform.css', array(), filemtime( PDEV_DIR . 'public/css/tgwf-searchform.css' ), 'all' );

	// Enqueue scripts.
	wp_enqueue_script( 'tgwf-app-link', URL_DIR . 'public/js/browserdetect.js' , array(), '1.0', true );
}

/**
 * Load styles on the condition the shortcode is one use in the page somewhere.
 */
function tgwf_load_shortcode_styles() {
	global $post;

	if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'green-checker-search-form' ) ) {
		wp_enqueue_style( 'tgwf-searchform', URL_DIR . 'public/css/tgwf-searchform.css', array(), filemtime( PDEV_DIR . 'public/css/tgwf-searchform.css' ), 'all' );
	}
}
