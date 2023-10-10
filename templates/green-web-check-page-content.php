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

			<?php require_once PDEV_DIR . 'templates/checker/checker-ctas.php'; ?>

			<?php
		} else {
			// No result.
			?>

			<div class="tgwf-result__wrapper wp-block-cover alignfull">

				<div class="wp-block-cover__inner-container">
					<div class="tgwf-result__page-title">
						<h1><?php _e( 'Sorry, we have a problem', 'tgwf' ); ?></h1>
					</div>

					<div class="tgwf-result tgwf-result-details">
						<p><?php _e( "The most likely cause of the problem is that we can't connect to the Green Web Dataset.", 'tgwf' ); ?></p>
						<p><?php _e( "It might be offline, or your web browser might be offline. Please try again.", 'tgwf' ); ?></p>
					</div>
				</div>
			</div>


			<?php require_once PDEV_DIR . 'templates/checker/checker-check-again.php'; ?>
			<?php require_once PDEV_DIR . 'templates/checker/checker-ctas.php'; ?>						

			<?php
		}
	} else {
		// There is no search performed, show search bar for new search.
		require_once PDEV_DIR . 'templates/checker/checker-search-form-wrapper.php';
	}
?>

</div>

<?php
