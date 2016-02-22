<?php
/**
 * The theme's page file use for displaying pages.
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
?>

	<section id="site-content" class="row">
		<div class="columns small-12">

			<h1 class="page-title">404</h1>

			Sorry, there doesn't seem to be anything here!
		</div>
	</section>

<?php
get_footer();