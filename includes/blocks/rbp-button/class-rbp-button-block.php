<?php
/**
 * Block: Button
 *
 * @since 2.0.0
 */

defined( 'ABSPATH' ) || die();

/**
 * Class RBP_Button_Block
 *
 * @since 2.0.0
 */

final class RBP_Button_Block extends RBP_Block {

	/**
	 * RBP_Button_Block constructor.
	 *
	 * @since 2.0.0
	 *
	 * @param string $path
	 */
	function __construct( $path ) {

        parent::__construct( $path );

		remove_filter( 'allowed_block_types', array( $this, 'remove_core_button_block' ) );

	}

	/**
	 * Callback outputted by the dynamic block.
	 *
	 * @since 2.0.0
	 */
	function render_callback( $attributes ) {
		
		ob_start();

		$classes = array(
			'button',
		);

		if ( isset( $attributes['size'] ) && $attributes['size'] ) {
			$classes[] = $attributes['size'];
		}

		if ( isset( $attributes['align'] ) && $attributes['align'] ) {
			$classes[] = 'align' . $attributes['align'];
		}

		if ( isset( $attributes['slide_direction'] ) && $attributes['slide_direction'] ) {
			$classes[] = 'slide-' . $attributes['slide_direction'];
		}

		if ( isset( $attributes['color'] ) && $attributes['color'] ) {
			$classes[] = $attributes['color'];
		}

		if ( isset( $attributes['invert'] ) && $attributes['invert'] ) {
			$classes[] = 'invert';
		}

		if ( isset( $attributes['hollow'] ) && $attributes['hollow'] ) {
			$classes[] = 'hollow';
		}

		if ( isset( $attributes['expand'] ) && $attributes['expand'] ) {
			$classes[] = 'expanded';
		}

		?>

		<a href="<?php echo esc_attr( $attributes['url'] ); ?>" class="<?php echo implode( ' ', $classes ); ?>" <?php echo ( isset( $attributes['new_tab'] ) && $attributes['new_tab'] ) ? ' target="_blank"' : ''; ?>>
			<?php echo wp_kses_post( $attributes['content'] ); ?>
		</a>

		<?php

		return ob_get_clean();

	}

	/**
	 * This removes the default Button block as an option since we want to use our own stuff instead
	 *
	 * @param   array  $allowed_block_types  Allowed Gutenberg Blocks
	 *
	 * @since	2.0.0
	 * @return  array                        Allowed Gutenberg Blocks
	 */
	function remove_core_button_block( $allowed_block_types ) {
		
		if ( isset( $allowed_block_types['core/button'] ) ) {
			unset( $allowed_block_types['core/button'] );
		}

		if ( isset( $allowed_block_types['core/buttons'] ) ) {
			unset( $allowed_block_types['core/buttons'] );
		}

		return $allowed_block_types;

	}

}