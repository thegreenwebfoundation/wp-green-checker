<?php
/**
 * A place for all the shortcodes needed for the green web checker.
 *
 * @package tgwfgreenchecker
 */

// Register shortcodes so they exist.
add_action(
	'init',
	function() {
		add_shortcode( 'green-checker-search-form', 'green_checker_search_form' );
	}
);


/**
 * Shortcode to output search form for checking website.
 */
function green_checker_search_form() {

	// Use output buffering to prevent json errors in the editor.
	ob_start();
	require_once PDEV_DIR . 'templates/checker/checker-search-form-wrapper.php';
	return ob_get_clean();
}
