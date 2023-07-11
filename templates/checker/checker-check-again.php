<?php
/**
 * Template that outputs a search field that encourages users to check for another site.
 *
 *  @package tgwfgreenchecker
 */

?>

<div class="wp-block-cover alignfull is-light gwf-check-again pattern__text-gradient-image">
	
	<div class="wp-block-cover__inner-container">
		<div class="wp-block-group gwf-check-again__text">
			<div class="wp-block-group__inner-container" style="margin-left: auto; margin-right: auto;">
				<h2 class="has-neve-text-color-color has-text-color">Run another green check</h2>

				<?php require_once PDEV_DIR . 'templates/checker/checker-search-form.php'; ?>	
			</div>
		</div>
	</div>
</div>

<?php
