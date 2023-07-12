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
		<h2>Does your website run on green energy?</h2>

		<p>The internet is the world's largest coal-powered machine. Check if your website runs on green energy — and help make the internet fossil-free.</p>

		<?php require_once PDEV_DIR . 'templates/checker/checker-search-form.php'; ?>	
	</div>
</div>

<?php
