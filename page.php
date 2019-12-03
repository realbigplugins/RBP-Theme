<?php
/**
 * The theme's page file use for displaying pages.
 * 
 * @since   1.0.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();

// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.
if ( has_post_thumbnail() ) : ?>
	<header class="featured-hero" role="banner" data-interchange="[<?php echo the_post_thumbnail_url('featured-small'); ?>, small], [<?php echo the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php echo the_post_thumbnail_url('featured-large'); ?>, large], [<?php echo the_post_thumbnail_url('featured-xlarge'); ?>, xlarge]">
	</header>
<?php endif;

?>	

<div class="page-content row">

    <article id="page-<?php the_ID(); ?>" <?php post_class( array( 'columns', 'small-12' ) ); ?>>

        <h1 class="page-title">
            <?php the_title(); ?>
        </h1>

        <?php the_content(); ?>

    </article>
    
</div>

<?php
get_footer();