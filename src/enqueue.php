<?php
/**
 * Handles all the style and script enqueues for the plugin.
 *
 *  @package tgwfgreenchecker
 */

add_action( 'wp', 'tgwf_register_scripts' );

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

	// Enqueue scripts.
	wp_enqueue_script( 'tgwf-directory', URL_DIR . 'public/js/directory.js', array(), '1.0', true );						
	wp_enqueue_script( 'tgwf-scripts', URL_DIR . 'public/js/tgwf.js' , array('tgwf-jquery'), '', false );		
	wp_enqueue_script( 'tgwf-vmap', URL_DIR . 'public/js/jquery.vmap.js' , array('tgwf-jquery'), '1.0', true );
	wp_enqueue_script( 'tgwf-vmap-world', URL_DIR . 'public/js/maps/jquery.vmap.world.js' , array('tgwf-jquery'), '1.0', true );
	wp_enqueue_script( 'tgwf-directory', URL_DIR . 'public/js/directory.js', array(), '1.0', true );						
}


/**
 * Loads the scripts and styles required for the green web check page.
 */
function tgwf_enqueue_greencheck_scripts() {
	wp_enqueue_script( 'tgwf-app-link', URL_DIR . 'js/browserdetect.js' , array(), '1.0', true );  
}
