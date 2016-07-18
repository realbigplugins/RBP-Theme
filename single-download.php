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
?>

	<div id="site-content" class="row">

		<div class="product-title columns small-12 hide-for-medium-up">
			<h1 class="title"><?php the_title(); ?></h1>
		</div>

		<div class="product-image columns small-12 medium-4">
			<?php the_post_thumbnail( 'large' ); ?>

			<div class="product-actions">
				<?php if ( ! edd_has_variable_prices( get_the_ID() ) ) { ?>
					<h4 class="single-product-price"><?php edd_price( get_the_ID() ); ?></h4>
				<?php } ?>

				<?php echo edd_get_purchase_link( array(
                    'download_id' => get_the_ID(), 
                    'text' => 'Add to Cart', 
                    'class' => 'primary',
                 ) ); ?>

				<div class="product-categories">
					<?php the_terms( get_the_ID(), 'download_category', '<span class="product-categories-title">Categories:</span> ', ', ', '' ); ?>
				</div>

				<div class="product-tags">
					<?php the_terms( get_the_ID(), 'download_tag', '<span class="product-tags-title">Tags:</span> ', ', ', '' ); ?>
				</div>
			</div>
		</div>

		<div class="product-content columns small-12 medium-8">

			<h1 class="title hide-for-small-only"><?php the_title(); ?></h1>

			<div class="product-content content">
				<?php
				// Don't show the add to cart stuff here as well as the sidebar. Reduntant
				remove_action( 'the_content', 'edd_after_download_content', 10 );
				the_content( 'Read the rest of this entry &raquo;' );
				?>
			</div>
		</div>

	</div>

<?php
get_footer();