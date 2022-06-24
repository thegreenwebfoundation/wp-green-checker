<?php
/**
 * Template to output a not green web check result.
 *
 *  @package tgwfgreenchecker
 */

?>

<h1>Result of the green web check &mdash; <?php echo esc_html( $green_check_result->url ); ?> is not hosted <span class="tgw-green">green</span></h1>

<div class="tgwf-result">	

	<div class="tgwf-result__summary">
		<img class="tgwf-result__smiley" src="<?php echo URL_DIR . 'public/img/green-web-smiley-bad.svg' ?>" alt="Website hosted grey">
	</div>

	<div class="">
		<h3>Oh dear!</h3>
		
		<div>
			<p>Unfortunately, this website is hosted grey or we are not sure about the greenness of the hoster.</p>
			<p>For the check to work, (technical) information about green hosters worldwide is needed. This information is stored in our <a href="https://www.thegreenwebfoundation.org/green-web-datasets/">Green Web database</a>.</p>
		</div>
	</div>
</div>

<div class="">

	<div class="wp-block-group alignfull has-neve-text-color-color has-nv-light-bg-background-color has-text-color has-background">
		<div class="wp-block-group__inner-container" style="max-width: 789px;">

			<h2 class="has-nv-c-2-color has-text-color">Want to green this result?</h2>
			<p>Here's how you can turn that frown upside down...</p>

			<div class="wp-block-columns" style="gap: 2rem;">
				<div class="wp-block-column" style="display: flex; flex-direction: column;">
					<h3>For website owners: share this result with your hosting provider</h3>
					<p style="flex-grow: 1;">Talk to your hosting provider and ask them to work with us so we can gather data and evidence about their renewable energy use. You can use our sample emails to help you raise the issue.</p>
				
					<div class="wp-block-buttons">
						<div class="wp-block-button">
							<a class="wp-block-button__link" href="https://www.thegreenwebfoundation.org/sample-emails/">View sample emails</a>
						</div>
					</div>

				</div>

				<div class="wp-block-column" style="display: flex; flex-direction: column;">
					<h3>For hosting providers: submit data or corrections</h3>
					<p style="flex-grow: 1;">If you think this data is incorrect and would like to query or update it, read our guide for an explanation and next steps.</p>
	
					<div class="wp-block-buttons">
						<div class="wp-block-button">
							<a class="wp-block-button__link" href="https://www.thegreenwebfoundation.org/support/why-does-my-website-show-up-as-grey-in-the-green-web-checker/">Read guide</a>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</div>

</div>

<?php
