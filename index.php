<?php
/**
 * Displays archive of posts.
 *
 * @since   1.0.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();
?>

<?php if ( have_posts() ) : ?>
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( array(
            'columns',
            'small-12'
        ) ); ?>>

            <h1 class="post-title">
                <a href="<?php the_permalink(); ?>" class="force-color">
                    <?php the_title(); ?>
                </a>
            </h1>

            <?php the_excerpt(); ?>

            <a href="<?php the_permalink(); ?>" class="button dark">
                Read more
            </a>

        </article>
    <?php endwhile; ?>

    <div class="columns small-12">
    <?php
        the_posts_pagination( array(
            'prev_text'          => 'Previous page',
            'next_text'          => 'Next page',
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . 'Page' . ' </span>',
        ) );
        ?>
    </div>

<?php else: ?>

    <div class="columns small-12">
        Nothing found, sorry!
    </div>

<?php endif; ?>

<?php
get_footer();