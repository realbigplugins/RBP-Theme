<?php
/**
 * EDD single download template.
 *
 * @since   0.1.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();
the_post();

// Don't show the add to cart stuff here as well as the sidebar. Reduntant
remove_action( 'the_content', 'edd_after_download_content', 10 );

$primary_color = get_post_meta( get_the_ID(), '_rbm_primary_color', true );
$primary_color = ( $primary_color ) ? $primary_color : '#12538f';

$secondary_color = get_post_meta( get_the_ID(), '_rbm_secondary_color', true );
$secondary_color = ( $secondary_color ) ? $secondary_color : '#51a0e9';
?>
<style type="text/css">
	:root {
		--disclaimer: '<?php echo _x( 'All price options are billed yearly. You may cancel your subscription at any time.', 'Price Options Disclaimer Text', THEME_ID ); ?>';
		--primary-color: <?php echo $primary_color; ?>;
		--secondary-color: <?php echo $secondary_color; ?>;
	}
</style>

<div class="container grid-container">
	<div class="grid-x grid-margin-x grid-margin-y">
		<main class="small-12 medium-7 cell">
			<ul class="breadcrumbs">
				<li><a href="/">Home</a></li>
				<li><a href="/plugins">Plugins</a></li>
				<li>
					<span class="show-for-sr">Current: </span><?php the_title(); ?>
				</li>
			</ul>

			<!--Hide for the moment
			<div class="banner-image">
				<?php //the_post_thumbnail( 'large' ); ?>
			</div>-->

			<div class="product-heading">
				<div class="heading-row">
					<?php the_post_thumbnail( 'thumbnail' ); ?>

					<?php add_filter( 'the_title', 'rbp_alternate_download_title' ); ?>
					<h1 class="title"><span itemprop="name"><?php the_title(); ?></span></h1>
					<?php remove_filter( 'the_title', 'rbp_alternate_download_title' ); ?>
				</div>

				<?php if ( $subheading = rbm_fh_get_field( 'subheading' ) ) : ?>
				<div class="heading-row">
					<p class="subheading"><?php echo $subheading; ?></p>
				</div>
				<?php endif; ?>
			</div>

			<?php if ( has_blocks() ) : ?>

				<div class="content">
					<?php the_content(); ?>
				</div>

			<?php else : ?>

				<div class="content">
					<?php the_content(); ?>
				</div>

				<?php $features = rbm_fh_get_field( 'features' );

				if ( ! empty( $features ) ) : ?>

					<div class="features-section">

						<?php

						$index = 0;

						foreach ( $features as $feature ) : ?>

							<div class="feature">

								<div class="row" data-equalizer data-equalize-on="medium">

									<div class="feature-content small-12 medium-6 columns
									<?php echo $index % 2 !== 0 ? 'medium-push-6' : ''; ?>" data-equalizer-watch>
										<div class="medium-vertical-align">
											<h3><strong><?php echo $feature['title']; ?></strong></h3>
											<?php echo apply_filters( 'the_content', $feature['content'] ); ?>
										</div>
									</div>

									<div class="feature-image small-12 medium-6 columns
									<?php echo $index % 2 !== 0 ? 'medium-pull-6' : ''; ?>" data-equalizer-watch>
										<div class="medium-vertical-align">
											<a href="<?php echo wp_get_attachment_url( $feature['image'], 'full' ); ?>">
												<?php echo wp_get_attachment_image( $feature['image'], 'full' ); ?>
											</a>
										</div>
									</div>

								</div>

							</div>

							<?php

							$index ++;

						endforeach; ?>

					</div>

				<?php endif; ?>

				<?php $testimonials = rbm_fh_get_field( 'testimonials' );

				if ( ! empty( $testimonials ) ) : ?>

					<?php

					$index = 1;

					switch ( count( $testimonials ) ) {

						case 1 :
							$max_columns = 1;
							break;
						default :
							$max_columns = 2;
							break;

					}

					?>

					<div class="testimonials-section">

					<?php foreach ( $testimonials as $testimonial ) : ?>

						<?php if ( $index == 1 ) : ?>
							<div class="row">
						<?php endif; ?>

						<div
							class="testimonial small-12 medium-6<?php echo ( count( $testimonials ) == 1 ) ? ' medium-offset-3' : ' columns'; ?>">

							<div class="testimonial-container">

								<div class="testimonial-top row">

									<div class="small-9 columns testimonial-meta">

										<?php echo get_avatar( $testimonial['gravatar_email'], 96, null, false, array(
											'class' => 'alignleft',
										) ); ?>

										<h6 class="testimonial-name">
											<strong>
												<?php echo $testimonial['name']; ?>
											</strong>
										</h6>
												<span class="testimonial-company">
													<?php echo $testimonial['company']; ?>
												</span>

									</div>

									<div class="small-3 columns testimonial-quotation-mark">
										<span class="fa fa-4x fa-quote-left"></span>
									</div>

								</div>

								<div class="testimonial-bottom row">

									<div class="small-12 columns testimonial-content">

										<blockquote><?php echo apply_filters( 'the_content', '"' . $testimonial['content'] . '"' ); ?></blockquote>

									</div>

								</div>

							</div>

						</div>

						<?php if ( $index == $max_columns ) : ?>

							</div>

							<?php

							$index = 1;

						else :

							$index ++;

						endif;

					endforeach;

					if ( $index !== 1 ) : ?>

						</div>
						</div>

					<?php endif; ?>

					</div>

				<?php endif; ?>

				<?php $video_url = rbm_fh_get_field( 'video' );

				if ( ! empty( $video_url ) ) : ?>

					<div class="video-section">

						<div class="row">
							<div class="small-12 columns">

								<div class="video-container">

									<?php echo wp_oembed_get( $video_url ); ?>

								</div>

							</div>
						</div>

					</div>

				<?php endif; ?>

			<?php endif; ?>

		</main>
		<aside class="small-12 medium-5 cell">
			<div class="aside-container">
				<div id="download-buy" class="download-color-section<?php echo ( edd_is_bundled_product( get_the_ID() ) ) ? ' is-bundle' : ''; ?>">

					<?php echo edd_get_purchase_link( array(
						'download_id' => get_the_ID(),
						'text'        => sprintf( _x( 'Buy %s', 'Buy Button Text', THEME_ID ), get_the_title() ),
						'class'       => 'primary large',
					) ); ?>

					<div class="text-center">
						<a href="/support/" class="support-link" title="Questions or concerns?">Questions or concerns?</a>
					</div>

				</div>
				<ul class="accordion" data-accordion data-allow-all-closed="true" data-multi-expand="true">
					<li class="accordion-item" data-accordion-item>
						<!-- Accordion tab title -->
						<a href="#" class="accordion-title">What's included</a>

						<!-- Accordion tab content: it would start in the open state due to using the `is-active` state class. -->
						<div class="accordion-content" data-tab-content>
							<ul class="included-features">
								<li>1 year of plugin updates</li>
								<li>1 year of support</li>
								<li>14-day money back guarantee</li>
							</ul>
						</div>
					</li>
					<li class="accordion-item" data-accordion-item>
						<!-- Accordion tab title -->
						<a href="#" class="accordion-title">Support</a>

						<!-- Accordion tab content: it would start in the open state due to using the `is-active` state class. -->
						<div class="accordion-content" data-tab-content>

							<?php if ( $documentations = rbm_cpts_get_p2p_children( 'documentation' ) ) :

								$documentation_link_text = _x( 'View plugin documentation', 'View Documentaion Link Text', THEME_ID );

								$documentation = array_shift( $documentations );
								?>

								<a href="<?php echo get_permalink( $documentation ); ?>"
								class="button secondary"
								title="<?php echo $documentation_link_text; ?>">
									<?php echo $documentation_link_text; ?>
								</a>

							<?php endif; ?>

							<?php $support_link_text = _x( 'Contact support', 'Contact Support Link Text', THEME_ID ); ?>
							
							<a href="/support/" class="button" title="<?php echo $support_link_text; ?>"><?php echo $support_link_text; ?></a>
								
						</div>
					</li>
					<?php if ( get_post_meta( get_the_ID(), '_edd_sl_version', true ) || rbm_fh_get_field( 'requirements' ) ) : ?>
						<li class="accordion-item is-active" data-accordion-item>
							<!-- Accordion tab title -->
							<a href="#" class="accordion-title">Details and Compatability</a>

							<!-- Accordion tab content: it would start in the open state due to using the `is-active` state class. -->
							<div class="accordion-content" data-tab-content>
								<?php if ( $current_version = get_post_meta( get_the_ID(), '_edd_sl_version', true ) ) : ?>
									<div class="grid-x">
										<div class="small-12 medium-5"><strong><?php echo _x( 'Version', 'Current Version Text', THEME_ID ); ?>: </strong></div>
										<div class="small-12 medium-7">
											<?php echo $current_version; ?>

											<?php if ( $documentation && class_exists( 'EDD_SL_Download' ) ) : 

												$sl_download = new EDD_SL_Download( get_the_ID() );

												?>

												<?php if ( $changelog = $sl_download->get_changelog() ) :

													$changelog_link_text = _x( 'Changelog', 'Changelog Link Text', THEME_ID );
													?>
													<br />
													<a href="<?php echo get_permalink( $documentation ); ?>#changelog"
													title="<?php echo $changelog_link_text; ?>">
														<?php echo $changelog_link_text; ?>
													</a>

												<?php endif; ?>

											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>

								<?php 

								$readme = false;
								if ( function_exists( 'rbm_get_readme' ) ) {
									$readme = rbm_get_readme();
								}

								if ( $readme ) {

									if ( function_exists( 'rbm_get_custom_readme_headers' ) && function_exists( 'rbm_get_readme_header' ) ) : 

										$custom_headers = rbm_get_custom_readme_headers();

										$custom_headers = array_filter( $custom_headers, function( $key, $text ) {

											if ( strpos( $key, 'tested' ) === false ) return false;

											return true;

										}, ARRAY_FILTER_USE_BOTH );

										// The only default header for this in WP is for WP itself
										// WP's official header text doesn't specify it is WordPress though, so we've added that here
										$all_headers = array_unique( array_merge( array(
											'WordPress' => 'tested',
										), $custom_headers ) );

										$found_headers = array_filter( $all_headers, function( $key, $text ) use ( $readme ) {

											return array_key_exists( $key, $readme );

										}, ARRAY_FILTER_USE_BOTH );
									
										if ( ! empty( $found_headers ) ) : ?>

											<div class="grid-x padding-x">

												<div class="small-12 medium-5 cell">
													<strong><?php echo _x( 'Tested With', 'Tested With Header', THEME_ID ); ?>:</strong>
												</div>

												<div class="small-12 medium-7 cell">
													<ul class="tested-to">

														<?php foreach ( $found_headers as $text => $key ) : 

															$value = rbm_get_readme_header( $key );

															if ( ! $value ) continue;

															if ( array_key_exists( $text, $custom_headers ) ) : 

																$text = preg_replace( '/tested up to/i', '', $text );	

															endif;
															
														?>

															<li><?php echo $text; ?> v<?php echo $value; ?></li>

														<?php endforeach; ?>

													</ul>
												</div>

											</div>

										<?php endif;

									endif;

								}

								$requirements = rbm_fh_get_field( 'requirements' );

								$found_headers = array();

								if ( function_exists( 'rbm_get_custom_readme_headers' ) && function_exists( 'rbm_get_readme_header' ) ) : 

									$custom_headers = rbm_get_custom_readme_headers();

									$custom_headers = array_filter( $custom_headers, function( $key, $text ) {

										if ( strpos( $key, 'requires' ) === false ) return false;

										return true;

									}, ARRAY_FILTER_USE_BOTH );

									// WP uses some not especially descriptive names for WP vs PHP headers, so this helps account for this
									// The data has already been read via rbm_get_readme(), so we don't need to worry about the array keys below not matching
									$all_headers = array_unique( array_merge( array(
										//'Tested up to WordPress' => 'tested',
										'WordPress' => 'requires',
										'PHP' => 'requires_php',
									), $custom_headers ) );

									$found_headers = array_filter( $all_headers, function( $key, $text ) use ( $readme ) {

										return array_key_exists( $key, $readme );

									}, ARRAY_FILTER_USE_BOTH );

								endif;
								
								if ( ! empty( $found_headers ) || $requirements ) : ?>

									<div class="grid-x padding-x">

										<div class="small-12 medium-5 cell">
											<strong><?php echo _x( 'Requirements', 'Requirements Header', THEME_ID ); ?>:</strong>
										</div>

										<div class="small-12 medium-7 cell">
											<ul class="requirements">

												<?php if ( ! empty( $found_headers ) ) : 

													foreach ( $found_headers as $text => $key ) : 

														$value = rbm_get_readme_header( $key );

														if ( ! $value ) continue;

														if ( array_key_exists( $text, $custom_headers ) ) : 

															$text = preg_replace( '/Requires/i', '', $text );

														endif; ?>

														<li><?php echo $text; ?> v<?php echo $value; ?> <?php _e( 'or higher', 'real-big-plugins' ); ?></li>

														<?php

													endforeach;

												else : ?>
												
													<?php foreach ( $requirements as $item ) : ?>
														<li><?php echo $item['requirement']; ?></li>
													<?php endforeach; ?>

												<?php endif; ?>

											</ul>
										</div>

									</div>

								<?php endif; ?>
							</div>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</aside>
	</div>
</div>

<?php get_footer();