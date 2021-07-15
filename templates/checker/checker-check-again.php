<?php
/**
 * Template that outputs a search field that encourages users to check for another site.
 *
 *  @package tgwfgreenchecker
 */

?>

<div class="row new-check">
	<div class="tgwf-search-form">
		<h2><?php _e( 'Do you want to perform another green check?','tgwf' ); ?></h2>	

		<form action="<?php echo esc_url( get_bloginfo( 'url' ) ) . '/green-web-check'; ?>" method="GET">
			<input name="url" class="form-control" type="text" placeholder="http://www.yourwebsite.com">
			<button type="submit" class="tgwf-search-form__button">Check&nbsp;&nbsp;<span class="fa fa-chevron-right"></span></button>
		</form>
	</div>
</div>

<?php
