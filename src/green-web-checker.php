<?php
/**
 * Functions for running the green web checker.
 *
 *  @package tgwfgreenchecker
 */

/**
 * Perform a green website check.
 */
function tgwf_run_site_check() {
	$green_check_result = '';

	// Get the URL cleaned for passing through to the API.
	$greencheck = esc_url( trim( $_GET['url'] ) );
	$greencheck = str_replace( 'http://', '', $greencheck );
	$greencheck = str_replace( 'https://', '', $greencheck );
	$greencheck = explode( '/', $greencheck );

	// Request and decode the response.
	$response           = wp_remote_get( 'https://api.thegreenwebfoundation.org/greencheck/' . $greencheck[0] . '?nocache=true', [ 'timeout' => 10 ] );
	$green_check_result = json_decode( wp_remote_retrieve_body( $response ) );

	return $green_check_result;
}
