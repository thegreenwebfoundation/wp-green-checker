<?php
/**
 * Template to output a not green web check result.
 *
 *  @package tgwfgreenchecker
 */

?>

<h1>Result of the green web check &mdash; <?php echo $greencheck[0]; ?> is not hosted <span class="tgw-green">green</span>!</h1>

<div class="tgwf-result">	

	<div class="tgwf-result__summary">
		<img class="tgwf-result__smiley" src="<?php echo URL_DIR . 'public/img/green-web-smiley-bad.svg' ?>" alt="Website hosted grey">

		<div>
			<p><?php _e( 'Unfortunately, this website is hosted grey or we are not sure about the greenness of the hoster. For the check to work, (technical) information about green hosters worldwide is needed. This information is stored in the Green Hosts database.</p>
			<p>Do you believe this information is incorrect?', 'tgwf' ); ?><a href="https://admin.thegreenwebfoundation.org">Login to our database.</a></p>
		</div>
	</div>

	<div class="">
		<strong>Show the world this website is not green.</strong><br>							
		<img src="https://api.thegreenwebfoundation.org/greencheckimage/<?php echo $greencheck[0]; ?>" alt="This website is hosted grey - checked by thegreenwebfoundation.org">
		<p>Save this image or use the code below to implement this badge on your website.</p>
		<pre><?php echo htmlspecialchars('<img src="https://api.thegreenwebfoundation.org/greencheckimage/') . $greencheck[0] . htmlspecialchars('" alt="This website is hosted Green - checked by thegreenwebfoundation.org">');?></pre>

		<?php $excerpt = $greencheck[0] . ' is not hosted green.'; ?>
		<span>Maybe you want to share this result with the hosting company? This creates leverage for your call to become green!<br></span>
	</div>
</div>

<?php require_once PDEV_DIR . 'templates/checker/checker-social.php'; ?>

<?php
