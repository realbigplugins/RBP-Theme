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

</div> <!-- .page-content -->

<?php if ( ! edd_is_checkout() ) : ?>

    <footer id="site-footer">

        <div class="row">

            <?php 

            $footer_sidebars = array(
                'footer-left',
                'footer-center',
                'footer-right',
            ); 

            foreach ( $footer_sidebars as $sidebar ) : ?>

                <div class="small-12 medium-4 columns">

                    <?php dynamic_sidebar( $sidebar ); ?>

                </div>

            <?php endforeach; ?>

        </div>

    </footer>

<?php endif; ?>

</div> <!-- #site-content -->

<?php wp_footer(); ?>

</body>

</html>