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

                    <?php if ( $index % 2 == 0 ) : ?>

                    <div class="small-6 medium-6 columns text-center">
                        <a href="<?php echo wp_get_attachment_url( $feature['image'], 'full' ); ?>">
                            <?php echo wp_get_attachment_image( $feature['image'], 'medium' ); ?>
                        </a>
                    </div>

                    <?php endif; ?>

                    <div class="small-6 medium-6 columns">
                        <h3><?php echo $feature['title']; ?></h3>
                        <?php echo apply_filters( 'the_content', $feature['content'] ); ?>
                    </div>

                    <?php if ( $index % 2 !== 0 ) : ?>

                    <div class="small-6 medium-6 columns text-center">
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

<?php endif; ?>

<?php $testimonials = rbm_get_field( 'testimonials' );

if ( ! empty( $testimonials ) ) : ?>

    <?php

    $index = 1;

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

    <div class="testimonials-section">

    <?php foreach ( $testimonials as $testimonial ) : ?>

        <?php if ( $index == 1 ) : ?>
            <div class="row">
        <?php endif; ?>

                <div class="testimonial small-12 medium-6<?php echo ( count( $testimonials ) == 1 ) ? ' medium-offset-3' : ' columns'; ?>">

                    <div class="testimonial-container">

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
        </div>

    <?php endif; ?>

    </div>

<?php endif; ?>

<div id="download-buy" class="download-color-section">
    
    <?php echo edd_get_purchase_link( array(
        'download_id' => get_the_ID(), 
        'text' => sprintf( _x( 'Add %s to your cart', 'Add to Cart Text', THEME_ID ), get_the_title() ),
        'class' => 'primary large expanded invert',
     ) ); ?>
    
</div>

<div class="download-meta-section">
    
    <div class="row">
    
        <?php 
        
        $column_class = 'medium-6';
        
        if ( $requirements = rbm_get_field( 'requirements' ) ) : $column_class = 'medium-4'; endif; ?>

        <div class="download-meta requirements small-12 <?php echo $column_class; ?> columns">

            <?php if ( $requirements ) : ?>

                <div class="download-meta-container">

                    <h3><?php echo _x( 'Requirements', 'Requirements Header', THEME_ID ); ?></h3>

                    <ul>

                        <?php foreach ( $requirements as $item ) : ?>
                            <li><?php echo $item['requirement']; ?></li>
                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>
            
        </div>
        
        <div class="download-meta support small-12 <?php echo $column_class; ?> columns">

            <div class="download-meta-container">

                <h3><?php echo _x( 'Support', 'Support Header', THEME_ID ); ?></h3>
                
                <ul>
                
                    <?php if ( $documentation = get_post_meta( get_the_ID(), '_rbm_p2p_documentation', true ) ) : 

                        $documentation_link_text = _x( 'View plugin documentation', 'View Documentaion Link Text', THEME_ID );

                    ?>
                    
                        <li>
                            <a href="<?php echo get_permalink( $documentation ); ?>" title="<?php echo $documentation_link_text; ?>">
                                <?php echo $documentation_link_text; ?>
                            </a>
                        </li>
                    
                    <?php endif; ?>

                    <?php
                        $support_link_text = _x( 'Contact support', 'Contact Support Link Text', THEME_ID );
                    ?>

                    <li>
                        <a href="/support/" title="<?php echo $support_link_text; ?>"><?php echo $support_link_text; ?></a>
                    </li>
                    
                </ul>

            </div>
            
        </div>
        
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
                                <a href="<?php echo get_permalink( $documentation ); ?>#changelog" title="<?php echo $changelog_link_text; ?>">
                                    <?php echo $changelog_link_text; ?>
                                </a>
                            </li>
                    
                        <?php endif; ?>
                    
                    <?php endif; ?>
                    
                </ul>

            </div>

        </div>
        
    </div>
    
</div>

<?php get_footer();