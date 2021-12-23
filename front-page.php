<?php
/**
 * The theme's front-page file use for displaying the home page.
 *
 * @since   0.1.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

if ( has_blocks() ) : ?>

    <div class="page-content row">
        <?php the_content(); ?>
    </div>

<?php else : 

    $plugins_archive_link = get_post_type_archive_link( 'download' );
    $hire_us_page = get_page_by_title( 'Hire Us' );
    ?>

    <div class="page-content row">

        <section class="row text-center call-to-action animate-on-scroll fade-in">
            
            <div class="small-12 columns">
            
                <h1>
                    <?php echo get_theme_mod( 'home_tagline', __( 'Quality WordPress Plugins<br />Built With Love', THEME_ID ) ); ?>
                </h1>
                <a href="/<?php echo EDD_SLUG; ?>/" class="button large secondary slide-right">
                    <span class="button-text">
                        <?php echo get_theme_mod( 'home_button_text', __( 'View Our Plugins', THEME_ID ) ); ?>
                    </span>
                </a>
                
            </div>
            
        </section>
        
    </div>

<?php endif;

get_footer();