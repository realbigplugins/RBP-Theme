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

$plugins_archive_link = get_post_type_archive_link( 'download' );
$hire_us_page = get_page_by_title( 'Hire Us' );
?>

	<section id="site-content" class="row">
		<div class="plugins columns small-12 medium-6">
			<a href="<?php echo $plugins_archive_link ? $plugins_archive_link : '#'; ?>">
				<p class="plug">
					<img class="animate-on-hover" src="<?php echo get_template_directory_uri(); ?>/svg/plug.svg"/>
				</p>

				<h2>Plugins</h2>
			</a>
		</div>

		<div class="hire columns small-12 medium-6">
			<a href="<?php echo $hire_us_page ? get_permalink( $hire_us_page->ID ) : '#'; ?>">
				<p class="svg-rbm-logo">
					<img class="animate-on-hover" src="<?php echo get_template_directory_uri(); ?>/svg/rbm-logo.svg"/>
				</p>

				<h2>Hire Us</h2>
			</a>
		</div>
	</section>

<?php
get_footer();