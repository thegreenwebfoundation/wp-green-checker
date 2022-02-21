<?php
/**
 * Partial to render out the green web checker search form.
 *
 * @package tgwfgreenchecker
 */

?>

<div class="tgwf-search-form__wrapper">
	<div class="tgwf-search-form">
		<h1>Is your website hosted <span style="color: #55AA3C">green</span>?</h1>

		<p style="border-left: 6px solid #55AA3C; padding: 1rem; font-size: 1.1em; font-weight: bold;">One day the Internet will run entirely on renewable energy. The Green Web Foundation believes that day should be within reach, and develops tools to speed up the transition towards a green Internet</p>

		<?php // Form posts results back into the /green-web-check page URL, which runs tgwf_run_site_check(). ?>
		<form action="<?php echo esc_url( get_bloginfo( 'url' ) ) . '/green-web-check'; ?>" method="GET">
			<input name="url" class="form-control" type="text" placeholder="https://www.yourwebsite.com">
			<button type="submit" class="tgwf-search-form__button">Check&nbsp;&nbsp;<span class="fa fa-chevron-right"></span></button>
		</form>
	</div>
</div>

<?php
