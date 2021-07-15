<?php
/**
 * Template to output the
 *
 * @package tgwfgreenchecker
 */

?>

<h1>Result of the green web check &mdash; <?php echo $green_check_result->url; ?> is hosted <span class="tgw-green">green</span>!</h1>


<div class="tgwf-result">	

	<div class="tgwf-result__summary">
		<img class="tgwf-result__smiley" src="<?php echo URL_DIR . 'public/img/green-web-smiley-good.svg' ?>" alt="Website hosted green">

		<?php
		if ( isset( $green_check_result->hosted_by ) ) {
			?>
			<div>
				<span>Hosted by: <a href="/directory/#<?php echo esc_html( $green_check_result->hostedbyid );?>"><?php echo esc_html( $green_check_result->hosted_by ); ?></a></span>																					
			</div>
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
	</div>	
</div>

<?php require_once PDEV_DIR . 'templates/checker/checker-social.php'; ?>

<?php
