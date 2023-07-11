<?php
/**
 * Template that outputs the green-web-check page.
 * This is where users search for sites, and review the results.
 *
 *  @package tgwfgreenchecker
 */

?>
<div class="tgwf-content__wrapper">
	<?php
	// If there were some search criteria passed in, perform the green web check.
	if ( isset( $_GET['url'] ) && ! empty( $_GET['url'] ) ) {

		$green_check_result = tgwf_run_site_check();

		// We have a result.
		if ( null !== $green_check_result ) {
			?>

			<?php
			// Case: Error.
			if ( isset( $green_check_result->error ) ) {
				?>

				<h1><?php _e( 'Invalid URL. Please try again', 'tgwf' ); ?></h1>

				<?php
			} elseif ( $green_check_result->green ) {
				// Case: URL is green.
				require_once PDEV_DIR . 'templates/checker/checker-result-green.php';

			} else {
				// Case: URL is not green.			
				require_once PDEV_DIR . 'templates/checker/checker-result-not-green.php';

			}
			?>

			<?php require_once PDEV_DIR . 'templates/checker/checker-check-again.php'; ?>	

			<?php //require_once PDEV_DIR . 'templates/checker/checker-ctas.php'; ?>

			<?php
		} else {
			// No result.
			?>

				<h1><?php _e( 'No result. Please try again', 'tgwf' ); ?></h1>
				<?php require_once PDEV_DIR . 'templates/checker/checker-check-again.php'; ?>							

			<?php
		}
	} else {
		// There is no search performed, show search bar for new search.
		require_once PDEV_DIR . 'templates/checker/checker-search-form-wrapper.php';
	}
?>

</div>

<?php
