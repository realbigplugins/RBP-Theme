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

	<section class="store-template">
        
        <div class="animate-on-scroll scale-in-up">

            <?php if ( have_posts() ) : ?>

                <?php
                global $posts;
                
                $self_hosted = array_filter( $posts, function( $post ) {
                    return ( get_post_meta( $post->ID, '_edd_external_product_url', true ) ) ? false : true;
                } );
            
                $external = array_udiff( $posts, $self_hosted, function ( $post_a, $post_b ) {
                    return $post_a->ID - $post_b->ID;
                } );
            
                $downloads = array(
                    array(
                        'posts' => $self_hosted,
                    ),
                    array(
                        'posts' => $external,
                        'label' => _x( 'Our Plugins on other Sites', 'External Downloads Header', THEME_ID ),
                    ),
                );
            
                foreach( $downloads as $download_group ) : 
            
                    // Get column classes
                    switch ( count( $download_group['posts'] ) ) {
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
            
                    $index = 1;
            
                    echo ( isset( $download_group['label'] ) ) ? '<h2>' . $download_group['label'] . '</h2>': '';
            
                    foreach( $download_group['posts'] as $post ) : 
            
                        ?>

                        <?php if ( $index == 1 ) : ?>

                            <div class="row">

                        <?php endif; ?>

                            <div class="product columns <?php echo $column_classes; ?>">
                                <a href="<?php the_permalink(); ?>">
                                    <h2 class="title"><?php the_title(); ?></h2>
                                </a>

                                <div class="product-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'product-image' ); ?>
                                    </a>
                                    <?php if ( function_exists( 'edd_price' ) ) { ?>
                                        <div class="product-price">
                                            <?php
                                            if ( edd_has_variable_prices( get_the_ID() ) ) {
                                                // if the download has variable prices, show the first one as a starting price
                                                echo 'Starting at: ';
                                                edd_price( get_the_ID() );
                                            } else {
                                                edd_price( get_the_ID() );
                                            }
                                            ?>
                                        </div><!--end .product-price-->
                                    <?php } ?>
                                </div>
                                <?php if ( function_exists( 'edd_price' ) ) { ?>
                                    <div class="product-buttons">
                                        <?php if ( ! edd_has_variable_prices( get_the_ID() ) ) { ?>
                                            <?php echo edd_get_purchase_link( array( 
                                                    'download_id' => get_the_ID(), 
                                                    'text' => 'Add to Cart',
                                                    'class' => 'primary' 
                                            ) ); ?>
                                        <?php } ?>
                                        <a href="<?php the_permalink(); ?>" class="button primary">View Details</a>
                                    </div><!--end .product-buttons-->
                                <?php } ?>
                            </div><!--end .product-->

                        <?php if ( $index == $max_columns ) : ?>

                            </div>

                        <?php

                            $index = 1;

                        else : 

                            $index++; 

                        endif; ?>

                    <?php endforeach; ?>

                    <?php if ( $index !== 1 ) : ?>

                        </div> 

                    <?php endif; ?>
        
                <?php endforeach; ?>

            <?php else : ?>

                <div class="entry">
                    <h2 class="title">Not Found</h2>

                    <p>Sorry, but you are looking for something that isn't here.</p>
                    <?php get_search_form(); ?>
                </div><!--end .entry-->

            <?php endif; ?>
        
        </div>

	</section>

<?php
get_footer();