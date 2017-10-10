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

$date_format = get_option( 'date_format', 'F j, Y' );

?>

<div class="page-content row">

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
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h1>
				<span class="timestamp"><span class="fa fa-clock-o"></span>&nbsp;<?php the_time( $date_format ); ?></span>&nbsp;<span class="author"><?php printf( __( 'by %s' ), get_the_author_meta( 'display_name' ) ); ?></span>
				<br /><br />
				
				<div class="media-object stack-for-small">
					
					<?php if ( has_post_thumbnail() ) : ?>

                        <div class="media-object-section image-section">
                                <div class="thumbnail">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_post_thumbnail( 'medium' ); ?>
                                    </a>
                                </div>
                        </div>
					
					<?php endif; ?>

					<div class="media-object-section main-section">

						<?php the_excerpt(); ?>

						<a href="<?php the_permalink(); ?>" class="button secondary alignright">
							Read more
						</a>
							
					</div>
					
				</div>

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

</div>
	
<?php
get_footer();