<?php
/**
 * Template part that outputs the social share buttons.
 *
 * @package tgwfgreenchecker
 */

$excerpt    = $green_check_result->url . ' is hosted green.';
$page_title = rawurlencode( get_the_title() );
?>

<div class="tgwf__social-share">
	<!-- Social buttons -->
	<strong>Share this result on social media.</strong>
	<div id="social">
		<?php
		if ( ! isset( $_SERVER['HTTPS'] ) ) {
			$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		} else {
			$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		}
		?>

		<!-- LinkedIn -->
		<a id="twitter" class="social-button social-button__twitter" onclick="javascript:window.open(this.href, '','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" href="https://twitter.com/share?url=<?php echo $url; ?>&amp;text=<?php echo rawurlencode($excerpt); ?>" title="Deel op Twitter"><i></i>Twitter</a>

		<!-- Twitter -->
		<a id="linkedin" class="social-button social-button__linkedin" onclick="javascript:window.open(this.href, '','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo rawurlencode( $url ); ?>&amp;title=<?php echo esc_html( $page_title ); ?>&amp;summary=<?php echo rawurlencode( $excerpt ); ?>&amp;source=TheGreenWebFoundation.org"><i></i>Linkedin</a>

		<!-- Facebook -->	
		<a id="facebook" class="social-button social-button__facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_html( $url ); ?>&t=<?php echo $page_title; ?>" onclick="javascript:window.open(this.href, '','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><i></i>Facebook</a>		
	</div>
</div>

<?php
