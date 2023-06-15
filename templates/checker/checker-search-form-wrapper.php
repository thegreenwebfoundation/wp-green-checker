<?php
/**
 * Partial to render out a wrapped, titled green web checker search form.
 *
 * @package tgwfgreenchecker
 */

?>

<div class="tgwf-search-form__wrapper">

	<div class="tgwf-image">
		<img width="250" height="250" src="<?php echo esc_url( URL_DIR ) . 'public/img/gwf-brand-icons/gwf-recycle-green.svg'; ?>" alt="TGWF recycle green icon">
	</div>

	<div class="tgwf-search-form reading-width">
		<h1>Is your website hosted green?</h1>

		<p>One day the Internet will run entirely on renewable energy. The Green Web Foundation believes that day should be within reach, and develops tools to speed up the transition towards a green Internet.</p>

		<?php require_once PDEV_DIR . 'templates/checker/checker-search-form.php'; ?>	
	</div>
</div>

<?php
