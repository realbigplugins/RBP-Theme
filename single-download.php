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

	<div class="row animate-on-scroll fade-in">

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

    <?php $testimonials = rbm_get_field( 'testimonials' );

    if ( ! empty( $testimonials ) ) :

        $index = 1;

        switch( count( $testimonials ) ) {
                
            case 1 :
                $column_class = 'medium-6';
                $max_columns = 1;
                break;
            default : 
                $column_class = 'medium-3';
                $max_columns = 2;
                break;
                
        }
        
        foreach ( $testimonials as $testimonial ) : ?>
        
            <?php if ( $index == 1 ) : ?>
                <div class="row">
            <?php endif; ?>
        
                <div class="small-12 <?php echo $column_class; ?> columns">
                    <?php echo get_avatar( $testimonial['gravatar_email'] ); ?>
                </div>

                <div class="small-12 <?php echo $column_class; ?> columns">
                    <?php echo apply_filters( 'the_content', $testimonial['content'] ); ?>
                </div>
                    
            <?php if ( $index == $max_columns ) : ?>
                
                </div>

            <?php 

                $index = 1;

            else : 

                $index++; 

            endif;
        
        endforeach;

        if ( $index !== 1 ) : ?>

            </div>

        <?php endif;

    endif;

    $features = rbm_get_field( 'features' );

    if ( ! empty( $features ) ) :

        $index = 0;
        
        foreach ( $features as $feature ) : ?>
        
            <div class="row">
                
                <?php if ( $index % 2 == 0 ) : ?>
        
                <div class="small-12 medium-4 columns">
                    <?php echo wp_get_attachment_image( $feature['image'], 'medium' ); ?>
                </div>
                
                <?php endif; ?>

                <div class="small-12 medium-8 columns">
                    <h3><?php echo $feature['title']; ?></h3>
                    <?php echo apply_filters( 'the_content', $feature['content'] ); ?>
                </div>
                
                <?php if ( $index % 2 !== 0 ) : ?>
        
                <div class="small-12 medium-4 columns">
                    <?php echo wp_get_attachment_image( $feature['image'], 'medium' ); ?>
                </div>
                
                <?php endif; ?>
                
            </div>

            <?php

            $index++;
        
        endforeach;

    endif;

    $requirements = rbm_get_field( 'requirements' );

    if ( ! empty( $requirements ) ) {
        
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

        <div class="row">
            
            <ul class="multi-column">
            
                <?php foreach( $requirements as $item ) : ?>
                
                    <li class="small-12 <?php echo $column_class; ?> columns">
                        <?php echo $item['requirement']; ?>
                    </li>

                <?php endforeach; ?>
                
            </ul>
            
        </div>

        <?php
        
    }

    $video_url = rbm_get_field( 'video' );

    if ( ! empty( $video_url ) ) : ?>

        <div class="row">
            
            <?php echo wp_oembed_get( $video_url ); ?>

        </div>

    <?php endif; 

get_footer();