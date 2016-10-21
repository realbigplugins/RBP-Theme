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
    
    <h3>Our Plugins</h3>
    Made with <span class="cursive">love</span>
    
</section>

<div class="page-content row">

    <section class="store-template">

        <div class="animate-on-scroll scale-in-up">

            <?php if ( have_posts() ) : $index = 1; ?>

                <?php
                // Get column classes
                global $posts;
                switch ( count( $posts ) ) {
                    case 1:
                        $column_classes = 'small-12';
                        $max_columns = 1;
                        break;
                    case 2:
                        $column_classes = 'small-12 medium-6';
                        $max_columns = 2;
                        break;
                    default:
                        $column_classes = 'small-12 medium-4';
                        $max_columns = 3;
                        break;
                }
                ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php if ( $index == 1 ) : ?>

                        <div class="row">

                    <?php endif; ?>

                        <div class="product columns <?php echo $column_classes; ?>">
                            
                            <div class="product-container">
                                
                                <div class="product-container-top">

                                    <div class="product-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'product-image' ); ?>
                                        </a>
                                    </div>
                            
                                    <a href="<?php the_permalink(); ?>">
                                        <h4 class="title"><?php the_title(); ?></h4>
                                    </a>
                                    
                                    <?php the_excerpt(); ?>
                                    
                                </div>
                                
                                <hr />
                                
                                <div class="product-container-bottom">
                                    
                                    <a href="<?php the_permalink(); ?>" class="button secondary">View Details</a>
                                    
                                </div>
                                
                            </div>
                                
                        </div><!--end .product-->

                    <?php if ( $index == $max_columns ) : ?>

                        </div>

                    <?php

                        $index = 1;

                    else : 

                        $index++; 

                    endif; ?>

                <?php endwhile; ?>

                <?php if ( $index !== 1 ) : ?>

                    </div> 

                <?php endif; ?>

            </div>

            <div class="pagination">
                <?php
                global $wp_query;

                $big = 999999999; // need an unlikely integer

                echo paginate_links( array(
                    'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'  => '?paged=%#%',
                    'current' => max( 1, get_query_var( 'paged' ) ),
                    'total'   => $wp_query->max_num_pages
                ) );
                ?>
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