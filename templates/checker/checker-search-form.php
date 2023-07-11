<?php
/**
 * Partial to render just the green web checker search form and nothing else.
 *
 * @package tgwfgreenchecker
 */

?>

<?php

// Form posts results back into the /green-web-check page URL, which runs tgwf_run_site_check(). ?>
<form action="<?php echo esc_url( get_bloginfo( 'url' ) ) . '/green-web-check'; ?>" method="GET">

	<input name="url" class="form-control" type="text" placeholder="https://www.yourwebsite.com">

	<div class="tgwf-search-form__button wp-block-button is-style-primary">
		<button type="submit" class="wp-block-button__link">Check</button>
	</div>
</form>

<?php