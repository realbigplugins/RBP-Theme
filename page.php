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