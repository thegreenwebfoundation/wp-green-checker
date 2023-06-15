<?php
/**
 * Template that outputs a search field that encourages users to check for another site.
 *
 *  @package tgwfgreenchecker
 */

if ( WP_Block_Patterns_Registry::get_instance()->is_registered( 'gwf/text-gradient-image' ) ) {
	?>

	<div class="wp-block-cover alignfull is-light pattern__text-gradient-image">
		<img class="wp-block-cover__image-background wp-image-4106" alt="" src="https://tgwf.local/wp-content/uploads/two-protestors_newsprint.jpg" />
		
		<div class="wp-block-cover__inner-container">
			<div class="wp-block-group has-background">
				<h2 class="has-neve-text-color-color has-text-color">Run another green check</h2>

				<?php require_once PDEV_DIR . 'templates/checker/checker-search-form.php'; ?>	
			</div>
		</div>
	</div>

	<?php
} else {
	?>
	<div class="tgwf-search-form tgwf-search-form__check-again wp-block-group alignfull has-nv-site-bg-color has-neve-link-hover-color-background-color has-text-color has-background">
	
	<div class="wp-block-group__inner-container" style="max-width: 789px;">

		<h2><?php _e( 'Perform another green check','tgwf' ); ?></h2>	

		<?php require_once PDEV_DIR . 'templates/checker/checker-search-form.php'; ?>	

	</div>
	<?php
}
?>



<?php
