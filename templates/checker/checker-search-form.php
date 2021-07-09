<?php
/**
 * Partial to render out the green web checker search form.
 *
 * @package tgwfgreenchecker
 */

?>

<div class="row">
	<div class="col-md-7 col-md-offset-2">
		<h1>Is your website hosted <span class="tgw-green">green</span>?</h1>
		<blockquote class="tgw-medium-grey">One day the Internet will run entirely on renewable energy. The Green Web Foundation believes that day should be within reach, and develops tools to speed up the transition towards a green Internet</blockquote>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form action="green-web-check" method="GET">
			<div class="col-md-8 col-sm-8 input">
				<input name="url" class="form-control input-lg" type="text" placeholder="http://www.yourwebsite.com">
			</div>		
			<div class="col-md-3 col-sm-3">
				<button type="submit" class="go-button">Check&nbsp;&nbsp;<span class="fa fa-chevron-right"></span></button>
			</div>
		</form>
	</div>
</div>

<?php
