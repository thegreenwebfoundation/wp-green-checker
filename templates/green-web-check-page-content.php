<?php
/**
 * Template that outputs the green-web-check page.
 * This is where users search for sites, and review the results.
 *
 *  @package tgwfgreenchecker
 */

$green_check_result = tgwf_run_site_check();

if ( isset( $_GET["url"] ) && ! empty( $_GET["url"] ) ) {

	// We have a result.
	if ( $green_check_result != null ) {
		?>

		<?php
		// Case: Error.
		if ( isset( $green_check_result->error ) ) {
			?>
			<h1><?php _e( 'Invalid URL. Please try again', 'tgwf' ); ?></h1>
			<?php

		} elseif ( $green_check_result->green ) {
			// Case: URL is green.
			?>

			<h1>Result of the green web check &mdash; <?php echo $greencheck[0]; ?> is hosted <span class="tgw-green">green</span>!</h1>

			<div class="text-center smiley">							
				<img class="img-responsive center-block" src="<?php echo URL_DIR . 'public/img/green-web-smiley-good.svg' ?>" alt="Website hosted green">

				<?php
				if ( isset( $green_check_result->hostedby ) ) { 
					?>
					<span>Hosted by: <a href="/directory/#<?php echo $green_check_result->hostedbyid;?>"><?php echo $green_check_result->hostedby; ?></a></span>																					
					<?php
				}
				?>
			</div>

			<div class="">
				<span>Congratulations! The website is hosted green. This hoster is using green energy / compensation for its services.</span><br><br>
				<strong>Is this your website? Implement this badge on your website and show the world you are green.</strong><br>							
				<img src="https://api.thegreenwebfoundation.org/greencheckimage/<?php echo $greencheck[0]; ?>?nocache=true" alt="This website is hosted Green - checked by thegreenwebfoundation.org">
				<p>Save this image or use the code below to implement this badge on your website.</p>
				<pre><?php echo htmlspecialchars( '<img src="https://api.thegreenwebfoundation.org/greencheckimage/') . $greencheck[0] . "?nocache=true"  .   htmlspecialchars('" alt="This website is hosted Green - checked by thegreenwebfoundation.org">');?></pre>

				<?php
				$excerpt = $greencheck[0] . ' is hosted green.';
				require_once PDEV_DIR . 'templates/checker/checker-social.php';
				?>
			</div>										

			<?php
		} else {
			/* Case: URL is not green */ ?>					
			<h1>Result of the green web check &mdash; <?php echo $greencheck[0]; ?> is not hosted <span class="tgw-green">green</span>!</h1>


			<div class="">							
				<img class="img-responsive center-block" src="<?php echo URL_DIR . 'public/img/green-web-smiley-bad.svg' ?>" alt="Website hosted grey">
				<span><?php _e('Unfortunately, this website is hosted grey or we are not sure about the greenness of the hoster. For the check to work, (technical) information about green hosters worldwide is needed. This information is stored in the Green Hosts database.<br><br>Do you believe this information is incorrect? ','tgwf'); ?><a href="https://admin.thegreenwebfoundation.org">Login to our database.</a></span>
			</div>


			<div class="">
				<strong>Show the world this website is not green.</strong><br>							
				<img src="https://api.thegreenwebfoundation.org/greencheckimage/<?php echo $greencheck[0]; ?>" alt="This website is hosted grey - checked by thegreenwebfoundation.org">
				<p>Save this image or use the code below to implement this badge on your website.</p>
				<pre><?php echo htmlspecialchars('<img src="https://api.thegreenwebfoundation.org/greencheckimage/') . $greencheck[0] . htmlspecialchars('" alt="This website is hosted Green - checked by thegreenwebfoundation.org">');?></pre>

				<?php $excerpt = $greencheck[0] . ' is not hosted green.'; ?>
				<span>Maybe you want to share this result with the hosting company? This creates leverage for your call to become green!<br></span>

				<?php require_once PDEV_DIR . 'templates/checker/checker-social.php'; ?>
			</div>

			<?php
		}
		?>

		<div class="">
			<?php require_once PDEV_DIR . 'templates/checker/checker-check-again.php'; ?>
		</div>	

		<?php require_once PDEV_DIR . 'templates/checker/checker-app-blurb.php'; ?>

		<?php
	} else {
		// No result.
		?>
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<h1><?php _e( 'No result. Please try again', 'tgwf' ); ?></h1>
				<?php require_once PDEV_DIR . 'templates/checker/checker-check-again.php'; ?>							
			</div>
		</div>
		<?php
	}
} else {
	// There is no search performed, show search bar for new search.

	require_once PDEV_DIR . 'templates/checker/checker-search-form.php';
}
