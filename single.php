<?php
/**
 * The theme's single file use for displaying single posts.
 *
 * @since 0.1.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();
?>

<!-- Single HTML -->
<section id="site-content" class="row">
    <div class="columns small-12">
        <?php the_content(); ?>
    </div>
</section>

<?php
get_footer();