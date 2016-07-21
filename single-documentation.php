<?php
/**
 * The theme's single file use for displaying single Documenation Pages.
 * 
 * @since 1.0.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();

global $post;
        
$args = array( 
    'post_type' => 'documentation',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
);

$documentation_sections = new WP_Query( $args );

?>

	<div class="page-content row">

		<article id="top" <?php post_class( array( 'columns', 'small-12' ) ); ?>>

			<h1 class="page-title">
				<?php the_title(); ?>
			</h1>

			<?php the_content(); ?>

		</article>
        
        <?php if ( $documentation_sections->have_posts() ) : 
        
            while ( $documentation_sections->have_posts ) : $documentation_sections->the_post(); ?>

                <article id="<?php the_ID(); ?>" <?php post_class( array( 'columns', 'small-12' ) ); ?>>

                    <h1 class="page-title">
                        <?php the_title(); ?>
                    </h1>

                    <?php the_content(); ?>

                </article>

            <?php endwhile;

            wp_reset_postdata();
        
        endif; ?>

	</div>

<?php
get_footer();