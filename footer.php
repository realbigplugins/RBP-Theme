<?php
/**
 * The theme's footer file that appears on EVERY page.
 *
 * @since 1.0.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<?php if ( ! edd_is_checkout() ) : ?>

	<footer id="site-footer">

		<div class="site-footer-top text-center row">
			<div class="columns small-12">
				<h1 class="site-footer-head">Subscribe to our Newsletter</h1>
				<p class="site-footer-subhead">
					Subscribe to our newsletter to receive special discounts, new product announcements and helpful resources from Real Big Plugins.
				</p>

				<?php get_template_part( 'includes/html-mailchimp-signup-form' ); ?>
			</div>
		</div>

		<div class="site-footer-divider"></div>

		<div class="site-footer-bottom row">

			<?php foreach (
				array(
					'footer-left',
					'footer-center',
					'footer-right',
				) as $sidebar
			) : ?>

				<ul class="<?php echo $sidebar; ?> site-footer-bottom-widgets small-12 medium-4 columns">

					<?php dynamic_sidebar( $sidebar ); ?>

				</ul>

			<?php endforeach; ?>

		</div>

	</footer>

<?php endif; ?>

<?php wp_footer(); ?>

</body>

</html>