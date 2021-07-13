<?php
/**
 * Handles all the style and script enqueues for the plugin.
 *
 *  @package tgwfgreenchecker
 */

add_action( 'wp', 'tgwf_register_scripts' );
add_action( 'wp_footer', 'tgwf_register_shortcode_styles' );


/**
 * Initialises the registration of scripts.
 */
function tgwf_register_scripts() {

	if ( is_front_page() ) {
		add_action( 'wp_enqueue_scripts', 'tgwf_enqueue_home_scripts' );
	}

	if ( is_page( 'directory' ) ) {
		add_action( 'wp_enqueue_scripts', 'tgwf_enqueue_directory_scripts' );
	}

	if ( is_page( 'green-web-check' ) ) {
		add_action( 'wp_enqueue_scripts', 'tgwf_enqueue_greencheck_scripts' );
	}
}

/**
 * Loads the scripts and styles required for the homepage.
 */
function tgwf_enqueue_home_scripts() {
	wp_enqueue_script( 'tgwf-scripts', URL_DIR . 'public/js/tgwf.js' , array( 'tgwf-jquery', 'tgwf-moment' ), '1.0', false );
}

/**
 * Loads the scripts and styles required for the directory page.
 */
function tgwf_enqueue_directory_scripts() {
	// Enqueue styles.
	wp_enqueue_style( 'tgwf-jqvmap', URL_DIR . 'public/css/jqvmap.css', array(), '1.0', 'all' );

	// Enqueue scripts.
	wp_enqueue_script( 'tgwf-directory', URL_DIR . 'public/js/directory.js', array( 'jquery' ), '1.0', true );						
	wp_enqueue_script( 'tgwf-scripts', URL_DIR . 'public/js/tgwf.js' , array('jquery'), '', false );		
	wp_enqueue_script( 'tgwf-vmap', URL_DIR . 'public/js/jquery.vmap.js' , array('jquery'), '1.0', true );
	wp_enqueue_script( 'tgwf-vmap-world', URL_DIR . 'public/js/maps/jquery.vmap.world.js' , array('jquery'), '1.0', true );
	wp_enqueue_script( 'tgwf-directory', URL_DIR . 'public/js/directory.js', array(), '1.0', true );						
}


/**
 * Loads the scripts and styles required for the green web check page.
 */
function tgwf_enqueue_greencheck_scripts() {

	// Enqueue styles.
	wp_enqueue_style( 'tgwf-searchform', URL_DIR . 'public/css/tgwf-searchform.css', array(), '1.0', 'all' );

	wp_enqueue_script( 'tgwf-app-link', URL_DIR . 'public/js/browserdetect.js' , array(), '1.0', true );  
}



/**
 * Load scripts and styles conditionally and async.
 */
function tgwf_register_shortcode_styles() {

	global $post;

	// Only load your scripts and styles if the post contains your shortcode.
	if ( ! has_shortcode( $post->post_content, 'green-checker-search-form' ) ) :
		return;
	endif;

	// Need this line when not working locally.
	$response = wp_remote_get( URL_DIR . '/public/css/tgwf-searchform.css' );

	// Need this line when working locally.
	//$response = wp_remote_get( 'http://tgwf.local/wp-content/plugins/wp-green-checker/public/css/tgwf-searchform.css' );

	if ( is_array( $response ) && ! is_wp_error( $response ) ) {
		$headers = $response['headers']; // Array of http header lines.
		$body    = $response['body']; // The content.
		echo '<style>' . $body . '</style>';
	}
}
