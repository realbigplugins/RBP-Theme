<?php
/**
 * Adds some utility functions
 * 
 * @since   1.1.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

require_once trailingslashit( get_template_directory() ) . 'vendor/autoload.php';

use function SSNepenthe\ColorUtils\{
    rgb, scale_color, is_light, lighten, darken
};

/**
 * Determine brightness of Hex color similar to SASS lightness()
 * 
 * @param       string $hex Hex Color
 * @param		integer Percentage of lightness to check against. 33% seems to match against what Foundation's defaults for button text color choices
 *                         
 * @since       1.1.0
 * @return      boolean True for light, false for dark
 */
function rbp_is_light( $hex, $percentage = 60 ) {
    
    return is_light( $hex, $percentage );
    
}

/**
 * Replicates SASS scale-color()
 * 
 * @param		string $hex  Hex Color
 * @param		array  $args Arguments, such as 'lightness'
 *                                         
 * @since		1.3.11
 * @return		string Scaled Hex Color
 */
function rbp_scale_color( $hex, $args ) {
	
	return scale_color( $hex, $args );
	
}

/**
 * Convert a Hex Color to RGB
 * 
 * @param		string $hex Hex Color
 *                         
 * @since		1.3.11
 * @return		array  RGB Color Array
 */
function rbp_hex_to_rgb( $hex ) {
	
	$rgb = rgb( $hex );
	
	return array(
		'r' => $rgb->getRed(),
		'g' => $rgb->getGreen(),
		'b' => $rgb->getBlue(),
	);
	
}

/**
 * Darken a Hex Color, similar to SASS darken()
 * 
 * @param       string  $hex        Hex Color
 * @param       integer $percentage Percentage by which to darken
 *                                                         
 * @since       1.1.0
 * @return      string  Darkened Hex Color
 */
function rbp_darken_hex( $hex, $percentage = 15 ) {

    return darken( $hex, $percentage );

}

/**
 * Lighten a Hex Color, similar to SASS lighten()
 * 
 * @param       string  $hex        Hex Color
 * @param       integer $percentage Percentage by which to lighten
 *                                                         
 * @since       1.1.0
 * @return      string  Lightened Hex Color
 */
function rbp_lighten_hex( $hex, $percentage = 15 ) {

    return lighten( $hex, $percentage );

}