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

add_action( 'wp_print_styles', 'rbp_single_download_colors' );

/**
 * Add Post Meta-controlled Styling to the Download Single
 * I really don't like doing this, but this is about the only way to get DB-stored Colors into the Styling
 *
 * @since       1.1.0
 * @return      string
 */
function rbp_single_download_colors() {

	if ( is_single() && get_post_type() == 'download' ) :

		$primary_color = get_post_meta( get_the_ID(), '_rbm_primary_color', true );
		$primary_color = ( $primary_color ) ? $primary_color : '#12538f';

		$secondary_color = get_post_meta( get_the_ID(), '_rbm_secondary_color', true );
		$secondary_color = ( $secondary_color ) ? $secondary_color : '#51a0e9';

		?>

		<style type="text/css">

			/* Same styling as Downloads Archive, but controlled via Post Meta */
			.download-color-section {

				background-color: <?php echo $primary_color; ?>;
				border-bottom: 0.5rem solid <?php echo $secondary_color; ?>;

				color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?>;

			}

			.download-color-section ul * {

				color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?>;

			}

			.download-buy-link {

				background-color: <?php echo $primary_color; ?> !important;
				box-shadow: 7.5px 7.5px <?php echo $secondary_color; ?>;

				color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?> !important;

			}

			.download-buy-link:hover {

				background-color: <?php echo rbp_darken_hex( $primary_color, 15 ); ?> !important;
				box-shadow: 7.5px 7.5px <?php echo rbp_darken_hex( $secondary_color, 15 ); ?>;

				color: <?php echo ( rbp_is_light( rbp_darken_hex( $primary_color, 15 ) ) ) ? '#000' : '#fff'; ?> !important;

			}

			#download-buy .edd_price_options ul:after {

				border-top: solid 3px <?php echo $secondary_color; ?>;
				display: block;
				width: 100%;
				content: '<?php echo _x( 'All price options are billed yearly at a 20% discount. You may cancel your subscription at any time.', 'Price Options Disclaimer Text', THEME_ID ); ?>';
				font-style: italic;
				margin-top: 0.5em;
				padding-top: 0.5em;

			<?php if ( rbp_is_light( $primary_color ) ) : ?> color: <?php echo rbp_darken_hex( $secondary_color, 15 ); ?>;
			<?php else : ?> color: <?php echo $secondary_color; ?>;
			<?php endif; ?>
			}

			#download-buy .edd_price_options ul li.active {

			<?php if ( rbp_is_light( $secondary_color ) ) : ?> background-color: <?php echo rbp_darken_hex( $secondary_color, 15 ); ?>;
				color: #fff;
			<?php else : ?> background-color: <?php echo rbp_lighten_hex( $secondary_color, 15 ); ?>;
				color: #000;
			<?php endif; ?>

			}

			#download-buy .edd_price_options ul li.active * {

			<?php if ( rbp_is_light( $secondary_color ) ) : ?> color: #fff;
			<?php else : ?> color: #000;
			<?php endif; ?>

			}

			#download-buy .edd_price_options ul li.active del {

				color: <?php echo $secondary_color; ?>;

			}

			#download-buy .edd_price_options del {
				color: <?php echo $secondary_color; ?>;
			}

			#download-buy .edd_price_options input[type="radio"] ~ span:first-of-type:before {

				color: <?php echo $secondary_color; ?>;

			}

			#download-buy .edd_price_options input[type="radio"]:checked ~ span:first-of-type:before {

			<?php if ( rbp_is_light( $secondary_color ) ) : // Background color has been darkend accordingly above ?> color: #fff;
			<?php else : ?> color: #000;
			<?php endif; ?>

			}

			#download-buy .edd_purchase_submit_wrapper .support-link:before, #download-buy .edd_purchase_submit_wrapper .support-link:after {

			<?php if ( rbp_is_light( $primary_color ) ) : ?> border-color: <?php echo rbp_darken_hex( $secondary_color, 25 ); ?>;
			<?php else : ?> border-color: <?php echo rbp_lighten_hex( $secondary_color, 25 ); ?>;
			<?php endif; ?>

			}

			#download-buy .edd_purchase_submit_wrapper .button {

				color: <?php echo $primary_color; ?>;

			<?php if ( rbp_is_light( $primary_color ) ) : ?> background-color: #222;
			<?php else: ?> background-color: #fff;
			<?php endif; ?>

			}

			#download-buy .edd_purchase_submit_wrapper .button:hover {

				background-color: transparent;

			<?php if ( rbp_is_light( $primary_color ) ) : ?> color: #222;
				border-color: #222;
			<?php else: ?> color: #fff;
				border-color: #fff;
			<?php endif; ?>

			}

			#download-buy .edd_purchase_submit_wrapper .button.hollow {

				background-color: transparent !important;
				border-color: <?php echo $primary_color; ?> !important;
				color: <?php echo $primary_color; ?> !important;

			}

			#download-buy .edd_purchase_submit_wrapper .button.hollow:hover {

				background-color: <?php echo $primary_color; ?> !important;
				border-color: <?php echo $primary_color; ?> !important;
				color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?> !important;

			}

			#download-buy .edd-cart-added-alert {
			<?php if ( rbp_is_light( $primary_color ) ) : ?> color: <?php echo rbp_darken_hex( $secondary_color, 15 ); ?>;
			<?php else : ?> color: <?php echo $secondary_color; ?>;
			<?php endif; ?>
			}

			#download-buy .support-link {
			<?php if ( rbp_is_light( $primary_color ) ) : ?> color: <?php echo rbp_darken_hex( $secondary_color, 15 ); ?>;
			<?php else : ?> color: <?php echo $secondary_color; ?>;
			<?php endif; ?>
			}

			<?php if ( $external_url = get_post_meta( get_the_ID(), '_edd_external_product_url', true ) ) : ?>

			.single-download #download-buy .edd_download_purchase_form .edd_purchase_submit_wrapper {

				width: 100%;
				left: 0 !important;

			}

			<?php endif; ?>

			<?php if ( edd_item_in_cart( get_the_ID() ) && ! edd_single_price_option_mode( get_the_ID() ) ) : ?>
			/* Item already in cart */
			#download-buy .edd_download_purchase_form .edd_purchase_submit_wrapper {
				width: 100% !important;
				text-align: center !important;
				left: auto !important;
			}

			#download-buy .edd_download_purchase_form .edd_purchase_submit_wrapper .edd_go_to_checkout {
				width: auto;
				display: inline-block;
			}
			<?php endif; ?>

		</style>

	<?php endif;

}

get_header();
the_post();

// Don't show the add to cart stuff here as well as the sidebar. Reduntant
remove_action( 'the_content', 'edd_after_download_content', 10 );

$primary_color = get_post_meta( get_the_ID(), '_rbm_primary_color', true );
$primary_color = ( $primary_color ) ? $primary_color : '#12538f';
?>

	<div class="downloads-header download-color-section">

		<h1 class="title"><span itemprop="name"><?php the_title(); ?></span></h1>

		<div class="content">
			<?php the_content(); ?>
		</div>

		<?php the_post_thumbnail( 'medium' ); ?>

	</div>

	<div class="call-to-action">
		<a class="button large download-buy-link" href="#download-buy">
			<?php echo strip_tags( sprintf( __( 'Get started with %s now!', THEME_ID ), get_the_title() ) ); ?>
		</a>
	</div>

<?php $features = rbm_get_field( 'features' );

if ( ! empty( $features ) ) : ?>

	<div class="features-section">

		<?php

		$index = 0;

		foreach ( $features as $feature ) : ?>

			<div class="feature">

				<div class="row">

					<div class="feature-content small-12 medium-6 columns
                    <?php echo $index % 2 !== 0 ? 'medium-push-6' : ''; ?>">
						<h3><strong><?php echo $feature['title']; ?></strong></h3>
						<?php echo apply_filters( 'the_content', $feature['content'] ); ?>
					</div>

					<div class="feature-image small-12 medium-6 columns
                    <?php echo $index % 2 !== 0 ? 'medium-pull-6' : ''; ?>">
						<a href="<?php echo wp_get_attachment_url( $feature['image'], 'full' ); ?>">
							<?php echo wp_get_attachment_image( $feature['image'], 'full' ); ?>
						</a>
					</div>

				</div>

			</div>

			<?php

			$index ++;

		endforeach; ?>

	</div>

<?php endif; ?>

<?php $testimonials = rbm_get_field( 'testimonials' );

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

<?php $video_url = rbm_get_field( 'video' );

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

	<div id="download-buy" class="download-color-section">

		<?php echo edd_get_purchase_link( array(
			'download_id' => get_the_ID(),
			'text'        => sprintf( _x( 'Add %s to your cart', 'Add to Cart Text', THEME_ID ), get_the_title() ),
			'class'       => 'primary large expanded',
		) ); ?>

		<div class="text-center">
			<a href="/support/" class="support-link" title="Text">Questions or concerns?</a>
		</div>

	</div>

	<div class="download-meta-section">

		<div class="row">

			<?php

			$column_class = 'medium-12';

			if ( $requirements = rbm_get_field( 'requirements' ) ) : $column_class = 'medium-4'; endif;

			$external_url = get_post_meta( get_the_ID(), '_edd_external_product_url', true );

			if ( $external_url && $requirements ) : $column_class = 'medium-6'; endif; ?>

			<?php if ( $requirements ) : ?>

				<div class="download-meta requirements small-12 <?php echo $column_class; ?> columns">

					<div class="download-meta-container">

						<h3><?php echo _x( 'Requirements', 'Requirements Header', THEME_ID ); ?></h3>

						<ul>

							<?php foreach ( $requirements as $item ) : ?>
								<li><?php echo $item['requirement']; ?></li>
							<?php endforeach; ?>

						</ul>

					</div>

				</div>

			<?php endif; ?>

			<div class="download-meta support small-12 <?php echo $column_class; ?> columns">

				<div class="download-meta-container">

					<h3><?php echo _x( 'Support', 'Support Header', THEME_ID ); ?></h3>

					<ul>

						<?php if ( $documentation = get_post_meta( get_the_ID(), '_rbm_p2p_documentation', true ) ) :

							$documentation_link_text = _x( 'View plugin documentation', 'View Documentaion Link Text', THEME_ID );

							?>

							<li>
								<a href="<?php echo get_permalink( $documentation ); ?>"
								   title="<?php echo $documentation_link_text; ?>">
									<?php echo $documentation_link_text; ?>
								</a>
							</li>

						<?php endif; ?>

						<?php
						$support_link_text = _x( 'Contact support', 'Contact Support Link Text', THEME_ID );
						?>

						<li>
							<a href="/support/"
							   title="<?php echo $support_link_text; ?>"><?php echo $support_link_text; ?></a>
						</li>

					</ul>

				</div>

			</div>

			<?php if ( ! $external_url ) : ?>

				<div class="download-meta plugin-details small-12 <?php echo $column_class; ?> columns">

					<div class="download-meta-container">

						<h3><?php echo _x( 'Plugin Details', 'Plugin Details Header', THEME_ID ); ?></h3>

						<ul>

							<?php if ( $current_version = get_post_meta( get_the_ID(), '_edd_sl_version', true ) ) : ?>

								<li>
									<?php echo sprintf( _x( 'Version %s', 'Current Version Text', THEME_ID ), $current_version ); ?>
								</li>

							<?php endif; ?>

							<?php if ( $documentation ) : ?>

								<?php if ( $changelog = get_post_meta( get_the_ID(), '_edd_sl_changelog', true ) ) :

									$changelog_link_text = _x( 'Changelog', 'Changelog Link Text', THEME_ID );

									?>

									<li>
										<a href="<?php echo get_permalink( $documentation ); ?>#changelog"
										   title="<?php echo $changelog_link_text; ?>">
											<?php echo $changelog_link_text; ?>
										</a>
									</li>

								<?php endif; ?>

							<?php endif; ?>

						</ul>

					</div>

				</div>

			<?php endif; ?>

		</div>

	</div>

<?php get_footer();