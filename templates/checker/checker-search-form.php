<?php
/**
 * Partial to render out the green web checker search form.
 *
 * @package tgwfgreenchecker
 */

?>

<div class="tgwf-search-form__wrapper">

	<div class="tgwf-image">
		<img width="200" height="200" src="<?php echo esc_url( URL_DIR ) . 'public/img/TGWF-recycle-green.svg'; ?>" alt="TGWF recycle green icon">
	</div>

	<div class="tgwf-search-form">
		<h1>Is your website hosted green?</h1>

		<p style="padding-bottom: 1rem;">One day the Internet will run entirely on renewable energy. The Green Web Foundation believes that day should be within reach, and develops tools to speed up the transition towards a green Internet.</p>

		<?php // Form posts results back into the /green-web-check page URL, which runs tgwf_run_site_check(). ?>
		<form action="<?php echo esc_url( get_bloginfo( 'url' ) ) . '/green-web-check'; ?>" method="GET">
			<input name="url" class="form-control" type="text" placeholder="https://www.yourwebsite.com">
			<div class="tgwf-search-form__button wp-block-button is-style-secondary">
				<button type="submit" class="wp-block-button__link">Check</button>
			</div>
		</form>
	</div>
</div>

<?php
