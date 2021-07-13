<?php
/**
 * Partial to render out the green web checker search form.
 *
 * @package tgwfgreenchecker
 */

?>

<div class="tgwf-search-form__wrapper">
	<h1>Is your website hosted <span style="color: #55AA3C">green</span>?</h1>

	<p style="border-left: 6px solid #55AA3C; padding: 1rem;">One day the Internet will run entirely on renewable energy. The Green Web Foundation believes that day should be within reach, and develops tools to speed up the transition towards a green Internet</p>

	<form action="green-web-check" method="GET">
		<input name="url" class="form-control input-lg" type="text" placeholder="http://www.yourwebsite.com">
		<button type="submit" class="go-button">Check&nbsp;&nbsp;<span class="fa fa-chevron-right"></span></button>
	</form>

</div>

<?php
