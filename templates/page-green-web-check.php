<?php 
/**
 * Template that outputs the green-web-check page.
 * This is where users search for sites, and review the results.
 */

get_header(); ?>

<?php 
global $greencheckResult;

if (isset($_GET["url"]) && !empty($_GET["url"])) {		
	if ($greencheckResult != null) { /* We have a result */ ?>
		<div class="container site-main" id="main" role="main">
			<div class="row">	
				<div class="col-md-8 col-md-offset-2">
					<div class="row">
						
						<?php
						
						/* Case: Error */
						if ( isset($greencheckResult->error)) { ?>
							<div clas="col-md-12">
								<h1><?php _e('Invalid URL. Please try again','tgwf'); ?></h1>
							</div>																
						

						<?php
						/* Case: URL is green */ 
						} elseif ( $greencheckResult->green ) { ?>
						
							<div clas="col-md-12">
								<h1>Result of the green web check &mdash; <?php echo $greencheck[0]; ?> is hosted <span class="tgw-green">green</span>!</h1>
							</div>
							<div class="col-md-5 col-sm-5 col-xs-12 text-center smiley">							
								<img class="img-responsive center-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/green-web-smiley-good.svg" alt="Website hosted green">
								<?php
									if ( isset($greencheckResult->hostedby) ) { ?>
										<span>Hosted by: <a href="/directory/#<?php echo $greencheckResult->hostedbyid;?>"><?php echo $greencheckResult->hostedby; ?></a></span>																					
								<?php } ?>
							</div>
							<hr class="visible-xs-block">				
							<div class="col-md-7 col-sm-7 col-xs-12">
								<span>Congratulations! The website is hosted green. This hoster is using green energy / compensation for its services.</span><br><br>
								<strong>Is this your website? Implement this badge on your website and show the world you are green.</strong><br>							
								<img src="https://api.thegreenwebfoundation.org/greencheckimage/<?php echo $greencheck[0]; ?>?nocache=true" alt="This website is hosted Green - checked by thegreenwebfoundation.org">
								<p>Save this image or use the code below to implement this badge on your website.</p>
								<pre><?php echo htmlspecialchars('<img src="https://api.thegreenwebfoundation.org/greencheckimage/') . $greencheck[0] . "?nocache=true"  .   htmlspecialchars('" alt="This website is hosted Green - checked by thegreenwebfoundation.org">');?></pre>

								<?php
								$excerpt = $greencheck[0] . ' is hosted green.'; 
								get_template_part( 'greencheck', 'social' ); 
								?>											
							</div>										


	
						<?php } else { 
						/* Case: URL is not green */ ?>					
							<div clas="col-md-12">
								<h1>Result of the green web check &mdash; <?php echo $greencheck[0]; ?> is not hosted <span class="tgw-green">green</span>!</h1>
							</div>
							<div class="col-md-5 col-sm-5 col-xs-12 smiley">							
								<img class="img-responsive center-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/green-web-smiley-bad.svg" alt="Website hosted grey">
								<span><?php _e('Unfortunately, this website is hosted grey or we are not sure about the greenness of the hoster. For the check to work, (technical) information about green hosters worldwide is needed. This information is stored in the Green Hosts database.<br><br>Do you believe this information is incorrect? ','tgwf'); ?><a href="https://admin.thegreenwebfoundation.org">Login to our database.</a></span>
							</div>
							<hr class="visible-xs-block">				
							<div class="col-md-7 col-sm-7 col-xs-12">
								<strong>Show the world this website is not green.</strong><br>							
								<img src="https://api.thegreenwebfoundation.org/greencheckimage/<?php echo $greencheck[0]; ?>" alt="This website is hosted grey - checked by thegreenwebfoundation.org">
								<p>Save this image or use the code below to implement this badge on your website.</p>
								<pre><?php echo htmlspecialchars('<img src="https://api.thegreenwebfoundation.org/greencheckimage/') . $greencheck[0] . htmlspecialchars('" alt="This website is hosted Green - checked by thegreenwebfoundation.org">');?></pre>
																									
								<?php
								$excerpt = $greencheck[0] . ' is not hosted green.'; ?>
								<span>Maybe you want to share this result with the hosting company? This creates leverage for your call to become green!<br></span>
								<?php get_template_part( 'greencheck', 'social' ); 
								?>	
							</div>
																					
						<?php } ?>

					</div>
					<div class="row">
						<?php get_template_part( 'greencheck', 'search' ); ?>
					</div>						
				</div>
			</div>
		</div>
		<?php get_template_part( 'greencheck', 'app' ); ?>


	<?php }	else { /* No result */ ?>
		<div class="container site-main">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="row">
						<h1><?php _e('No result. Please try again','tgwf'); ?></h1>
						<?php get_template_part( 'greencheck', 'search' ); ?>							
					</div>
				</div>
			</div>
		</div>
		
	<?php }
} else { 


	/* There is no search performed, show search bar for new search */
	?>
	<div class="container site-main">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h1>Is your website hosted <span class="tgw-green">green</span>?</h1>
				<blockquote class="tgw-medium-grey">One day the Internet will run entirely on renewable energy. The Green Web Foundation believes that day should be within reach, and develops tools to speed up the transition towards a green Internet</blockquote>					
				<form action="" method="GET">
					<div class="col-md-8 col-sm-8 input">
						<input name="url" class="form-control input-lg" type="text" placeholder="http://www.yourwebsite.com">
					</div>		
					<div class="col-md-3 col-sm-3">
						<button type="submit" class="go-button">Check&nbsp;&nbsp;<span class="fa fa-chevron-right"></span></button>
					</div>
				</form>
			</div>
		</div>
	</div>	
<?php } ?>

<?php get_footer(); ?>
