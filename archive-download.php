<?php
/**
 * Download archive page (for EDD).
 *
 * @since   0.1.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();
?>

<section class="downloads-header">
	
	<?php if ( is_tax() ) : ?>
	
		<h3>
			All <?php echo get_queried_object()->name; ?> Plugins
		</h3>
	
	<?php else : ?>
    
		<h3>Our Plugins</h3>
		Made with <span class="cursive">love</span>
	
	<?php endif; ?>
    
</section>

<div class="page-content row">

    <section class="store-template">

        <?php echo facetwp_display( 'facet', 'categories' ); ?>

        <div class="animate-on-scroll scale-in-up">

            <?php if ( have_posts() ) : ?>

                <?php
                // Get column classes
                global $posts;
                switch ( count( $posts ) ) {
                    case 1:
                        $column_classes = 'small-up-1';
                        break;
                    case 2:
                        $column_classes = 'small-up-1 medium-up-2';
                        break;
                    default:
                        $column_classes = 'small-up-1 medium-up-2 large-up-3';
                        break;
                }
                ?>
            
            <div class="row <?php echo $column_classes; ?>" data-equalizer data-equalize-by-row="true">

                <?php while ( have_posts() ) : the_post(); ?>

                        <div class="product column">
                            
                            <div class="product-container">
                                
                                <div class="product-container-top" data-equalizer-watch>

                                    <div class="product-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'product-image' ); ?>
                                        </a>
                                    </div>
                            
                                    <a href="<?php the_permalink(); ?>">
                                        <h4 class="title"><strong><?php the_title(); ?></strong></h4>
                                    </a>
                                    
                                    <?php the_excerpt(); ?>
                                    
                                </div>
                                
                                <hr />
                                
                                <div class="product-container-bottom">
                                    
                                    <a href="<?php the_permalink(); ?>" class="button secondary">View Details</a>
                                    
                                </div>
                                
                            </div>
                                
                        </div><!--end .product-->

                <?php endwhile; ?>

            </div>

            <div class="pagination">
                <?php echo facetwp_display( 'facet', 'load_more_pager' ); ?>
            </div>

        <?php else : ?>

            <div class="entry">
                <h2 class="title">Not Found</h2>

                <p>Sorry, but you are looking for something that isn't here.</p>
                <?php get_search_form(); ?>
            </div><!--end .entry-->

        <?php endif; ?>

    </section>

</div>

<?php
get_footer();