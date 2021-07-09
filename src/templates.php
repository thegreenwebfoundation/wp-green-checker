<?php
/**
 * Functions that loads in template files for displaying content.
 * This are the sorts of files found in the template hierarchy.
 *
 * @package tgwfgreenchecker
 */

add_filter( 'template_include', 'tgwf_template_include' );

/**
 * Check to see if the theme has templates first.
 * If not, load the templates from the theme.
 *
 * @param string $template Defines name of template to search for.
 */
function tgwf_template_include( $template ) {

	if ( is_page( 'green-web-check' ) ) :

		$template = locate_template( 'page-green-web-check.php' );

		if ( ! $template ) {
			$template = require_once PDEV_DIR . 'templates/page-green-web-check.php';
		}
	endif;

	return $template;
}
