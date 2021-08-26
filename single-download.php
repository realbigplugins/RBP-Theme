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

<div class="container">
	<main>
		<ul class="breadcrumbs">
			<li><a href="/">Home</a></li>
			<li><a href="/plugins">Plugins</a></li>
			<li>
			<span class="show-for-sr">Current: </span> <?php the_title(); ?>
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
			<div class="heading-row">
				<p class="subheading">Introducing a powerful front-end Gradebook and Report Card System for LearnDash</p>
			</div>
		</div>

		<?php $video_url = rbm_fh_get_field( 'video' );

			if ( ! empty( $video_url ) ) : ?>

				<div class="video-section">
					<div class="responsive-embed widescreen">
						<?php echo wp_oembed_get( $video_url ); ?>
					</div>
				</div>

		<?php endif; ?>

		<div class="content">
			<?php the_content(); ?>
		</div>

		<hr />

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
	</main>
	<aside>
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
			<ul class="accordion" data-accordion data-allow-all-closed="true">
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
				<li class="accordion-item" data-accordion-item>
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

						<?php if ( $requirements = rbm_fh_get_field( 'requirements' ) ) : ?>

							<div class="grid-x padding-x">

								<div class="small-12 medium-5"><strong><?php echo _x( 'Requirements', 'Requirements Header', THEME_ID ); ?>:</strong></div>
								<div class="small-12 medium-7">
									<ul class="requirements">
										<?php foreach ( $requirements as $item ) : ?>
											<li><?php echo $item['requirement']; ?></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>

						<?php endif; ?>
					</div>
				</li>
			</ul>
		</div>
	</aside>
</div>

<?php get_footer();