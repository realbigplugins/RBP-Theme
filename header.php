<?php
/**
 * The theme's header file that appears on EVERY page.
 * 
 * @since   1.0.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js off-canvas-fix">
    
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <!--[if lt IE 9]>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/vendor/js/html5.js"></script>
<![endif]-->

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
            
		<?php if ( ! edd_is_checkout() ) : ?>

			<div class="off-canvas position-left nav-menu" id="offCanvasLeft" data-off-canvas>

				<?php wp_nav_menu( array(
					'container' => false,
					'menu' => __( 'Primary Left Menu', THEME_ID ),
					'menu_class' => 'menu show-for-small-only',
					'theme_location' => 'primary-left',
					'items_wrap'      => '<ul id="%1$s" class="vertical %2$s">%3$s</ul>',
					'fallback_cb' => false,
					'walker' => new Foundation_Nav_Walker(),
				) ); ?>

				<?php wp_nav_menu( array(
					'container' => false,
					'menu' => __( 'Primary Right Menu', THEME_ID ),
					'menu_class' => 'menu show-for-small-only',
					'theme_location' => 'primary-right',
					'items_wrap'      => '<ul id="%1$s" class="vertical %2$s">%3$s</ul>',
					'fallback_cb' => false,
					'walker' => new Foundation_Nav_Walker(),
				) ); ?>

			</div>

		<?php endif; ?>

		<div class="off-canvas-content" data-off-canvas-content data-sticky-container>

			<div id="notice-banner" class="banner text-center">
				<p>
					PayPal is currently unavailable as a payment method. You can still use a credit card for payment securely on our website in the meantime. <br />
					We appologize for the inconvenience. 
				</p>
			</div>

			<nav class="sticky top-bar" data-sticky data-sticky-on="small" data-margin-top="1" style="width:100%" data-top-anchor="notice-banner:bottom">

				<div class="top-bar-left mobile-menu show-for-small-only">
					<div class="menu-icon-wrapper">

						<?php if ( ! edd_is_checkout() ) : ?>

							<button class="menu-icon" type="button" data-toggle="offCanvasLeft" aria-expanded="false" aria-controls="offCanvasLeft"></button>

						<?php else : // Make a fake hamburger button so the height stays the same ?>

							<button type="button"></button>

						<?php endif; ?>

					</div>
				</div>

				<div class="top-bar-left nav-menu">

					<?php if ( ! edd_is_checkout() ) : ?>

						<?php wp_nav_menu( array(
							'container' => false,
							'menu' => __( 'Primary Left Menu', THEME_ID ),
							'menu_class' => 'menu hide-for-small-only',
							'theme_location' => 'primary-left',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'fallback_cb' => false,
							'walker' => new Foundation_Nav_Walker(),
						) ); ?>

					<?php else : // Make a fake Menu Item so the height stays the same ?>

						<ul class="menu fake hide-for-small-only">
							<li><a>&nbsp;</a></li>
						</ul>

					<?php endif; ?>

				</div>

				<div class="top-bar-section top-bar-logo nav-menu">
					<ul class="menu">
						<li>
							<a href="<?php bloginfo( 'url' ); ?>" title="<?php _e( 'Home', THEME_ID ); ?>">
								<span class="stacked-rbm-logo"><span></span></span>
							</a>
						</li>
					</ul>
				</div>

				<div class="top-bar-right nav-menu">

					<?php if ( ! edd_is_checkout() ) : ?>

						<?php wp_nav_menu( array(
							'container' => false,
							'menu' => __( 'Primary Right Menu', THEME_ID ),
							'menu_class' => 'menu hide-for-small-only',
							'theme_location' => 'primary-right',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'fallback_cb' => false,
							'walker' => new Foundation_Nav_Walker(),
						) ); ?>

					<?php else : // Make a fake Menu Item so the height stays the same ?>

						<ul class="menu fake hide-for-small-only">
							<li><a>&nbsp;</a></li>
						</ul>

					<?php endif; ?>

				</div>
			</nav>

			<section id="site-content"<?php echo ( is_front_page() ) ? ' style="background-image: url(' . wp_get_attachment_image_url( get_theme_mod( 'home_background' ), 'full' ) . '); background-size: cover;"' : ''; ?>>
