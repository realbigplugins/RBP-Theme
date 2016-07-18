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
<html <?php language_attributes(); ?> class="no-js">
    
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

    <body <?php body_class( 'off-canvas-wrapper' ); ?>>

        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

            <div class="off-canvas-content" data-off-canvas-content>

                <nav class="top-bar">
                    
                    <div class="top-bar-left mobile-menu show-for-small-only">
                        <div class="menu-icon-wrapper">
                            <button class="menu-icon" type="button" data-toggle="offCanvasLeft" aria-expanded="false" aria-controls="offCanvasLeft"></button>
                        </div>
                    </div>
                    
                    <div class="top-bar-left nav-menu">
                        
                        <?php wp_nav_menu( array(
                            'container' => false,
                            'menu' => __( 'Primary Left Menu', THEME_ID ),
                            'menu_class' => 'menu hide-for-small-only',
                            'theme_location' => 'primary-left',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'fallback_cb' => false,
                            'walker' => new Foundation_Nav_Walker(),
                        ) ); ?>
                        
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

                        <?php wp_nav_menu( array(
                            'container' => false,
                            'menu' => __( 'Primary Right Menu', THEME_ID ),
                            'menu_class' => 'menu hide-for-small-only',
                            'theme_location' => 'primary-right',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'fallback_cb' => false,
                            'walker' => new Foundation_Nav_Walker(),
                        ) ); ?>
                        
                    </div>
                </nav>

                <section id="site-content">
