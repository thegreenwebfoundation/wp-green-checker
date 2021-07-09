<?php
/**
 * Template that outputs a search field that encourages users to check for another site.
 *
 *  @package tgwfgreenchecker
 */

?>

<div class="row new-check">
	<div class="col-md-12"> 
		<h2><?php _e('Do you want to perform another green check?','tgwf'); ?></h2>	
	</div>		
	<form action="" method="GET">
		<div class="col-md-8 col-sm-8 input">
			<input name="url" class="form-control input-lg" type="text" placeholder="http://www.yourwebsite.com">
		</div>		
		<div class="col-md-3 col-sm-3">
			<button type="submit" class="go-button">Check&nbsp;&nbsp;<span class="fa fa-chevron-right"></span></button>
		</div>
	</form>
</div>

<?php
