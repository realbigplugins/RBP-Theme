<?php
/**
 * The theme's single file use for displaying single posts.
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

$date_format = get_option( 'date_format', 'F j, Y' );

?>

<div class="page-content row">

    <article id="page-<?php the_ID(); ?>" <?php post_class( array( 'columns', 'small-12' ) ); ?>>
		
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="thumbnail">
				<?php the_post_thumbnail( 'medium', array(
					'class' => 'attachment-medium size-medium wp-post-image alignleft',
				) ); ?>
			</div>
		<?php endif; ?>

        <h1 class="page-title">
            <?php the_title(); ?>
        </h1>
		
		<span class="timestamp"><span class="fa fa-clock-o"></span>&nbsp;<?php the_time( $date_format ); ?></span>&nbsp;<span class="author"><?php printf( __( 'by %s' ), get_the_author_meta( 'display_name' ) ); ?></span>
		<br /><br />

        <?php the_content(); ?>

    </article>
	
	<div class="small-12 columns about-author">
		
		<h3><?php _e( 'About the Author' ); ?></h3>
		
		<div class="row">
	
			<div class="small-2 columns avatar-column text-center">
				<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
			</div>

			<div class="small-10 columns content-column">
				
				<h5><?php echo get_the_author_meta( 'display_name' ); ?></h5>
				<?php if ( $website = get_the_author_meta( 'url' ) ) : ?>
					<a href="<?php echo $website; ?>" target="_blank">
						<?php echo get_the_author_meta( 'url' ); ?>
					</a>
					<br /><br />
				<?php endif; ?>
				
				<?php echo apply_filters( 'the_content', get_the_author_meta( 'description' ) ); ?>
				
			</div>
			
		</div>
	
	</div>
	
	<?php if ( comments_open() ) : ?>

		<div class="columns small-12">
			<?php comments_template(); ?>
		</div>
	
	<?php endif; ?>
    
</div>

<?php
get_footer();