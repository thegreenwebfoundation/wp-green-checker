<?php
/**
 * Template to output a not green web check result.
 *
 *  @package tgwfgreenchecker
 */

?>

<div class="tgwf-result__wrapper tgwf-result-not-green wp-block-cover alignfull">

	<span aria-hidden="true" class="wp-block-cover__background"></span>

	<?php require_once PDEV_DIR . 'templates/checker/checker-result-header.php'; ?>

			<div class="tgwf-result__image">
				<img class="tgwf-result__icon" src="<?php echo URL_DIR . 'public/img/gwf-brand-icons/gwf-not-hosted-green-icon.svg' ?>" alt="Website hosted grey">
			</div>

			<div class="tgwf-result__text" style="margin-top: 1rem;">
				<p class="tgwf-result__result">
					<span class="tgwf-result__text--feedback">With regret</span>
					<span class="tgwf-result__text--hosting-outcome">No evidence found for</span>
					<span class="tgwf-result__text--url"><?php echo esc_html( $green_check_result->url ); ?></span>
				</p>
			</div>
		</div>

		<div class="tgwf-result tgwf-result-details">
			<div class="tgwf-result__empty">	
			</div>

			<div class="tgwf-result__hosted-by has-background-gradient has-white-to-grey-gradient-background">
				<p>Unfortunately, we can't find any evidence in our <a style="color: white;" href="https://www.thegreenwebfoundation.org/green-web-dataset/">Green Web Dataset</a> that this website runs on green energy.</p>
				<p>For a check to return a green result, we need evidence to demonstrate what steps are being taken to avoid, reduce or offset the emissions caused by the digital infrastructure used.</p>
				<p><a style="color: white;" href="https://www.thegreenwebfoundation.org/support/why-does-my-website-show-up-as-grey-in-the-green-web-checker/">Why does my website show up as grey in the Green Web Checker?</a>
			
				<p class="mb-0" style="text-align: right;">Our take on <a style="color: white;" href="https://www.thegreenwebfoundation.org/support/why-does-green-hosting-matter/">why green hosting matters.</a></p>

			</div>
		</div>
	</div>
</div>

<div class="wp-block-group mt-0 mb-0">
	<div class="wp-block-group__inner-container">

		<h2 class="">Want to turn this result green?</h2>
		<p>How you can turn that frown upside down.</p>

		<div class="wp-block-columns mb-0" style="gap: 2rem; margin-top: 2rem;">
			<div class="wp-block-column" style="display: flex; flex-direction: column;">
				<h3>For website owners</h3>
				<p style="flex-grow: 1; padding-top: 0;"><span style="font-weight: 700">Share this result with your hosting provider.</span> Talk to your hosting provider and ask them to work with us so we can gather data and evidence about their renewable energy use. You can use our sample emails to help you raise your concerns.</p>
			
				<div class="wp-block-buttons">
					<div class="wp-block-button">
						<a class="wp-block-button__link" href="https://www.thegreenwebfoundation.org/sample-emails/">View sample emails</a>
					</div>
				</div>

			</div>

			<div class="wp-block-column" style="display: flex; flex-direction: column;">
				<h3>For hosting providers</h3>
				<p style="flex-grow: 1; padding-top: 0;"><span style="font-weight: 700;">Submit data or corrections.</span> If you think this result is incorrect and would like to query or update it, read our guide for an explanation and next steps.</p>

				<div class="wp-block-buttons">
					<div class="wp-block-button">
						<a class="wp-block-button__link" href="https://www.thegreenwebfoundation.org/support/why-does-my-website-show-up-as-grey-in-the-green-web-checker/">Read guide</a>
					</div>
				</div>
			
			</div>
		</div>
	</div>
</div>



<?php
