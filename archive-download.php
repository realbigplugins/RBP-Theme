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

global $wp_query;
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

        <?php if ( function_exists( 'facetwp_display' ) ) : ?>

            <?php echo facetwp_display( 'facet', 'download_categories' ); ?>

        <?php elseif ( current_user_can( 'manage_options' ) ) : ?>

            <p>
                Please activate FacetWP and then add the following under Settings -> FacetWP -> Settings -> Import/Export in the Import Field:
            </p>

            <code>
                {"facets":[{"name":"download_categories","label":"Download Categories","type":"checkboxes","source":"tax/download_category","parent_term":"","modifier_type":"off","modifier_values":"","hierarchical":"yes","show_expanded":"no","ghosts":"no","preserve_ghosts":"no","operator":"or","orderby":"count","count":"9999","soft_limit":"10"}]}
            </code>

        <?php endif; ?>

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
            
            <div class="grid-x <?php echo $column_classes; ?>" data-equalizer data-equalize-by-row="true">

                <?php while ( have_posts() ) : the_post(); ?>

                        <div class="product cell">
                            
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