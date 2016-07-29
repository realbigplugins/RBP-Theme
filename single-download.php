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

	<div class="row product-row animate-on-scroll fade-in">
        
        <div class="product-title columns small-12 hide-for-medium hide-for-large">
			<h1 class="title"><span itemprop="name"><?php the_title(); ?></span></h1>
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
                
                <?php if ( $documentation = get_post_meta( get_the_ID(), '_rbm_p2p_documentation', true ) ) : ?>
                    <div class="documentation">
                        <a href="<?php echo get_permalink( $documentation ); ?>">
                            <?php printf( __( 'View Documentation for %s', THEME_ID ), get_the_title() ); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
			</div>
		</div>

	</div>

    <?php $testimonials = rbm_get_field( 'testimonials' );

    if ( ! empty( $testimonials ) ) : ?>

        <?php

        $index = 1;
        $first = true;

        switch( count( $testimonials ) ) {
                
            case 1 :
                $max_columns = 1;
                break;
            default : 
                $max_columns = 2;
                break;
                
        }

        $image_column_class = 'small-4';
        $column_class = 'small-8';

        ?>

        <div class="testimonials alternating-branding">
        
        <?php foreach ( $testimonials as $testimonial ) : ?>
        
            <?php if ( $index == 1 ) : ?>
                <div class="row animate-on-scroll fade-in">
                    <div class="small-12 columns">
            <?php endif; ?>
                        
                <?php if ( $first ) : ?>
                        
                    <h3><?php _e( 'Testimonials', THEME_ID ); ?></h3>
                        
                <?php
                        
                    $first = false;
                        
                endif ?>
                    
                <div class="testimonial-container small-12 medium-6<?php echo ( count( $testimonials ) == 1 ) ? ' medium-offset-3' : ' columns'; ?>">
        
                    <div class="<?php echo $image_column_class; ?> columns">
                        <?php echo get_avatar( $testimonial['gravatar_email'] ); ?>
                    </div>

                    <div class="<?php echo $column_class; ?> columns">
                        
                        <blockquote><?php echo apply_filters( 'the_content', '"' . $testimonial['content'] . '"' ); ?></blockquote>
                        
                        <div class="testimonial-header">
                            <h5>
                                <?php echo $testimonial['name']; ?>
                            </h5>
                            <?php echo $testimonial['company']; ?>
                        </div>
                        
                    </div>
                    
                </div>
                    
            <?php if ( $index == $max_columns ) : ?>
                    
                </div>
            </div>

            <?php 

                $index = 1;

            else : 

                $index++; 

            endif;
        
        endforeach;

        if ( $index !== 1 ) : ?>

                </div>
            </div>

        <?php endif; ?>

        </div>

    <?php endif;

    $features = rbm_get_field( 'features' );

    if ( ! empty( $features ) ) : ?>

        <div class="features alternating-branding">

        <?php 
            
        $index = 0;
        
        foreach ( $features as $feature ) : ?>

            <div class="row animate-on-scroll fade-in">
                <div class="small-12 columns">

                <?php if ( $index == 0 ) : ?>

                    <h3><?php _e( 'Features', THEME_ID ); ?></h3>

                <?php endif; ?>

                <?php if ( $index % 2 == 0 ) : ?>

                <div class="small-6 medium-4 columns">
                    <a href="<?php echo wp_get_attachment_url( $feature['image'], 'full' ); ?>">
                        <?php echo wp_get_attachment_image( $feature['image'], 'medium' ); ?>
                    </a>
                </div>

                <?php endif; ?>

                <div class="small-6 medium-8 columns">
                    <h3><?php echo $feature['title']; ?></h3>
                    <?php echo apply_filters( 'the_content', $feature['content'] ); ?>
                </div>

                <?php if ( $index % 2 !== 0 ) : ?>

                <div class="small-6 medium-4 columns">
                    <a href="<?php echo wp_get_attachment_url( $feature['image'], 'full' ); ?>">
                        <?php echo wp_get_attachment_image( $feature['image'], 'medium' ); ?>
                    </a>
                </div>

                <?php endif; ?>

                </div>
            </div>

            <?php

            $index++;
        
        endforeach; ?>
            
        </div>

    <?php endif;

    $video_url = rbm_get_field( 'video' );

    if ( ! empty( $video_url ) ) : ?>

        <div class="video alternating-branding">

            <div class="row animate-on-scroll fade-in">
                <div class="small-12 columns">
                
                <h3><?php _e( 'Video Preview', THEME_ID ); ?></h3>
                
                <div class="video-container">

                    <?php echo wp_oembed_get( $video_url ); ?>
                    
                </div>

                </div>
            </div>
            
        </div>

    <?php endif; 

    $requirements = rbm_get_field( 'requirements' );

    if ( ! empty( $requirements ) ) : 
        
        $index = 1;

        switch( count( $requirements ) ) {
                
            case 1 :
                $column_class = 'medium-12';
                break;
            case 2 : 
                $column_class = 'medium-6';
            default : 
                $column_class = 'medium-4';
                break;
                
        }
        
        ?>

        <div class="requirements alternating-branding">

            <div class="row animate-on-scroll fade-in">
                <div class="small-12 columns">
                
                    <h3><?php _e( 'Requirements', THEME_ID ); ?></h3>

                    <ul class="multi-column">

                        <?php foreach( $requirements as $item ) : ?>

                            <li class="small-12 <?php echo $column_class; ?> columns">
                                <?php echo $item['requirement']; ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>
            </div>
            
        </div>

        <?php
        
    endif; ?>

    <div class="purchase-alt alternating-branding">
        
        <div class="row text-center animate-on-scroll fade-in">
            
            <div class="small-12 columns">
            
                <h2><?php printf( __( 'Buy %s Now!', THEME_ID ), get_the_title() ); ?></h2>

                <?php echo edd_get_purchase_link( array(
                    'download_id' => get_the_ID(), 
                    'text' => 'Add to Cart', 
                    'class' => 'large primary',
                 ) ); ?>
                
            </div>
            
        </div>
        
    </div>

<?php get_footer();