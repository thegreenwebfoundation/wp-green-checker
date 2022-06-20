<?php
/**
 * Template to output a not green web check result.
 *
 *  @package tgwfgreenchecker
 */

?>

<h1>Result of the green web check &mdash; <?php echo esc_html( $green_check_result->url ); ?> is not hosted <span class="tgw-green">green</span>!</h1>

<div class="tgwf-result">	

	<div class="tgwf-result__summary">
		<img class="tgwf-result__smiley" src="<?php echo URL_DIR . 'public/img/green-web-smiley-bad.svg' ?>" alt="Website hosted grey">
	</div>

	<div class="">
		<h3>Show the world this website is not green.</h3>
		
		<div>
			<p>Unfortunately, this website is hosted grey or we are not sure about the greenness of the hoster.</p>
			<p>For the check to work, (technical) information about green hosters worldwide is needed. This information is stored in our <a href="https://www.thegreenwebfoundation.org/green-web-datasets/">Green Web database</a>.</p>
			<p>Do you think this information is incorrect? Read our guide <a href="https://www.thegreenwebfoundation.org/support/why-does-my-website-show-up-as-grey-in-the-green-web-checker/">Why does my website show up as grey in the Green Web Checker</a> for an explaination and next steps.</p>
		</div>
	</div>
</div>

<div class="">
	<strong>Save this image or use the code below to implement this badge on your website.</strong></p>
	<img src="https://api.thegreenwebfoundation.org/greencheckimage/<?php echo esc_html( $green_check_result->url ); ?>" alt="This website is hosted grey - checked by thegreenwebfoundation.org">

	<pre><?php echo htmlspecialchars('<img src="https://api.thegreenwebfoundation.org/greencheckimage/') . esc_html( $green_check_result->url ) . htmlspecialchars('" alt="This website is hosted Green - checked by thegreenwebfoundation.org">');?></pre>

	<?php $excerpt = esc_html( $green_check_result->url ) . ' is not hosted green.'; ?>
	<span>Maybe you want to share this result with the hosting company? This creates leverage for your call to become green!<br></span>
</div>

<?php require_once PDEV_DIR . 'templates/checker/checker-social.php'; ?>

<?php
