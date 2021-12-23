<?php
/**
 * Block class framework
 *
 * @since {{VERSION}}
 */

defined( 'ABSPATH' ) || die();

/**
 * Class RBP_Block
 *
 * Template for each block.
 *
 * @since {{VERSION}}
 */
abstract class RBP_Block {

	/**
	 * The block ID (tag).
	 *
	 * @since {{VERSION}}
	 *
     * @var string $path
	 */
    public $path;

    /**
	 * RBP_Block constructor.
	 *
	 * @since {{VERSION}}
	 *
	 * @param string $path
	 */
	function __construct( $path ) {

        $this->path = $path;

        add_action( 'init', array( $this, 'register_block' ), 11 );

	}

	/**
	 * Registers the block.
	 *
	 * @since {{VERSION}}
	 */
	function register_block() {

        $args = array(
            'render_callback' => array( $this, "render_callback" ),
        );

        // register_block_script_handle() is hard-coded to only use plugins_url()
        // Why, WP. Why would you do this.

        $block_meta = json_decode( file_get_contents( trailingslashit( $this->path ) . 'block.json' ), true );

        $relative_path = wp_normalize_path( str_replace( get_template_directory(), '', $this->path ) );

        $script_asset = require trailingslashit( $this->path ) . 'build/index.asset.php';

        wp_register_script( 
            $block_meta['editorScript'], 
            get_template_directory_uri() . $relative_path . 'build/index.js',
            $script_asset['dependencies'],
            defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER
        );

        if ( isset( $block_meta['editorStyle'] ) ) {

            wp_register_style(
                $block_meta['editorStyle'],
                get_template_directory_uri() . $relative_path . 'build/index.css',
                array(),
                defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER
            );

        }

		$block = register_block_type_from_metadata(
		    $this->path,
			$args
		);

        $test = true;

	}

    function render_callback( $attributes ) {
        // Override me
    }
	
}