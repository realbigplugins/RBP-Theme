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

<div class="page-content row">

    <?php the_content() ?>
    
</div>

<?php
get_footer();