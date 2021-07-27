<?php
/**
 * Functions that loads in template files for displaying content.
 * This are the sorts of files found in the template hierarchy.
 *
 * @package tgwfgreenchecker
 */

add_filter( 'the_content', 'tgwf_green_web_check_page_content' );

/**
 * Checks if we have a page called '/green-web-check'.
 * If we do, replace the page content with the green web check page content.
 *
 * @param string $content The post's content.
 */
function tgwf_green_web_check_page_content( $content ) {

	// Check if we're inside the main loop in a single Post.
	if ( is_page( 'green-web-check' ) && in_the_loop() && is_main_query() ) {
		// Use output buffering to prevent json errors in the editor.
		ob_start();
		require_once PDEV_DIR . 'templates/green-web-check-page-content.php';
		$content = ob_get_clean();
		return $content;
	}

	return $content;
}
