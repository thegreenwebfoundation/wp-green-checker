<?php
/**
 * Template part that outputs the social share buttons.
 *
 * @package tgwfgreenchecker
 */

?>

<!-- Social buttons -->
<br><strong>Share this result on social media.</strong><br>
<div id="social">
	<?php
	if ( !isset($_SERVER['HTTPS'] ) ) { 
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	} else {
		$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 		
	}
	global $excerpt;
	$title = urlencode(get_the_title());

	?>

	<!-- LinkedIn -->
	<a id="twitter" class="social-button" onclick="javascript:window.open(this.href, '','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" href="https://twitter.com/share?url=<?php echo $url; ?>&amp;text=<?php echo urlencode($excerpt);?>" title="Deel op Twitter"><i class="fa fa-twitter fa-fw"></i>Twitter</a>

	<!-- Twitter -->
	<a id="linkedin" class="social-button" onclick="javascript:window.open(this.href, '','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode( $url );?>&amp;title=<?php echo $title;?>&amp;summary=<?php echo urlencode( $excerpt );?>&amp;source=TheGreenWebFoundation.org"><i class="fa fa-linkedin fa-fw"></i>Linkedin</a>

	<!-- Facebook -->	
	<a id="facebook" class="social-button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>&t=<?php echo $title; ?>" onclick="javascript:window.open(this.href, '','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i>&nbsp;&nbsp;Facebook</a>		
</div>	

<?php
