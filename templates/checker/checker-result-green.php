<?php
/**
 * Template to output the
 *
 * @package tgwfgreenchecker
 */

?>

<div class="tgwf-result__wrapper wp-block-cover alignfull">

	<span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient has-white-to-primary-gradient-background"></span>

	<div class="wp-block-cover__inner-container">
		<div class="tgwf-result__page-title">
			<h1>Result of Green Web Check</h1>
		</div>

		<div class="tgwf-result tgwf-result-overview">
			<div class="tgwf-result__image">
				<img class="tgwf-result__icon" src="<?php echo esc_url( URL_DIR ) . 'public/img/gwf-brand-icons/gwf-recycle-green.svg'; ?>" alt="Website hosted green">
			</div>

			<div class="tgwf-result__text">

				<p class="tgwf-result__result">
					<span class="tgwf-result__text--feedback">Congratulations!</span>
					<span class="tgwf-result__text--url"><?php echo esc_html( $green_check_result->url ); ?></span>
					<span class="tgwf-result__text--hosting-outcome">is hosted green</span>
				</p>
			</div>
		</div>

		<div class="tgwf-result tgwf-result-details">
			<div class="tgwf-result__empty">	
			</div>

			<div class="tgwf-result__hosted-by">

				<?php
				if ( isset( $green_check_result->hosted_by ) ) :
					?>

					<p style="font-weight: bold;">Hosted by: <a href="/directory/#<?php echo esc_html( $green_check_result->hosted_by_id ); ?>"><?php echo esc_html( $green_check_result->hosted_by ); ?></a></p>																					
					
				<?php
				endif;
				?>

				<p>This hoster is using green energy / compensation for its services.</p>

				<?php
				if ( isset( $green_check_result->hosted_by ) ) :
	
					if ( isset( $green_check_result->supporting_documents ) ) :
						$docs = $green_check_result->supporting_documents;

						if ( ! empty( $docs ) ) :
							?>
							<div class="tgwf-result__supporting-evidence">
								<p>Supporting evidence for this hoster's claims</p>
								<ul style="margin: 0;">
									<?php
									foreach ( $docs as $doc ) :
										?>
										<li><a href="<?php echo esc_html( $doc->link ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $doc->title ); ?></a></li>
										<?php
									endforeach;
									?>
								</ul>
							</div>
							<?php
						endif;
					endif;
					?>

					</div>
					<?php
				endif;
				?>
			</div>	
		</div>
</div>


<div class="wp-block-group">
	<div class="wp-block-group__inner-container" style="max-width: 789px; margin: auto;">

		<h2>Is this your website?</h2>
		<p>Save this image or use the code to display this badge on your website, and show the world you are green!</p>

		<div class="wp-block-columns" style="gap: 2rem;">
			<div class="wp-block-column">
				<h3>Image</h3>
				<img src="https://api.thegreenwebfoundation.org/greencheckimage/<?php echo esc_html( $green_check_result->url ); ?>?nocache=true" alt="This website is hosted Green - checked by thegreenwebfoundation.org">
			</div>

			<div class="wp-block-column">
				<h3>Code</h3>
				<pre><code><?php echo htmlspecialchars( '<img src="https://api.thegreenwebfoundation.org/greencheckimage/') . esc_html( $green_check_result->url ) . '?nocache=true' . htmlspecialchars( '" alt="This website is hosted Green - checked by thegreenwebfoundation.org">' ); ?></code></pre>
			</div>
		</div>
	</div>
</div>


<?php
