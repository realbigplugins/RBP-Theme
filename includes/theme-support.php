<?php
/**
 * Adds theme support for the theme.
 *
 * Feel free to remove any un-wanted support (most is already commented out)
 * @since   1.0.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Adds support for the "Featured Image". Pass the second argument to only allow for specified post types.
 *
 * Second argument: post, page, etc
 */
add_theme_support( 'post-thumbnails' );

/**
 * Declares the use of HTML5 in WP templates. Pass the second argument to only allow for specified templates.
 *
 * Second argument: comment-list, comment-form, search-form, gallery, caption
 */
add_theme_support( 'html5' );

/**
 * If enabled, WP will deal with providing the title tag, instead of the theme (since 4.1).
 */
add_theme_support( 'title-tag' );

/**
 * Adds support of post formats. Second argument sets which post formats are available.
 */
//add_theme_support( 'post-formats', array(
//	'aside',
//	'gallery',
//	'link',
//	'image',
//	'quote',
//	'status',
//	'video',
//	'audio',
//	'chat',
//));

/**
 * Adds support for a custom header image set in Appearance.
 */
//add_theme_support( 'custom-header', array(
//	'default-image'          => '',
//	'random-default'         => false,
//	'width'                  => 0,
//	'height'                 => 0,
//	'flex-height'            => false,
//	'flex-width'             => false,
//	'default-text-color'     => '',
//	'header-text'            => true,
//	'uploads'                => true,
//	'wp-head-callback'       => '',
//	'admin-head-callback'    => '',
//	'admin-preview-callback' => '',
//) );

/**
 * Adds support for a custom background image set in Appearance.
 */
//add_theme_support( 'custom-background', array(
//	'default-color'          => '',
//	'default-image'          => '',
//	'wp-head-callback'       => '_custom_background_cb',
//	'admin-head-callback'    => '',
//	'admin-preview-callback' => ''
//) );

/**
 * Enables post and comment RSS feed links to the head.
 */
//add_theme_support( 'automatic-feed-links' );

/**
 * Adds theme support for full-width and wide-width blocks in the block editor
 */
add_theme_support( 'align-wide' );

add_theme_support( 'editor-styles' );
add_editor_style( 'dist/assets/css/app.css' );