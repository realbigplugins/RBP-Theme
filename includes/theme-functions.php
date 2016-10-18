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

/**
 * Determine brightness of Hex color similar to SASS lightness()
 * PHP version of http://stackoverflow.com/a/5477774
 * YIQ: https://en.wikipedia.org/wiki/YIQ
 * 
 * @param       string $hex Hex Color
 *                         
 * @since       1.1.0
 * @return      boolean True for light, false for dark
 */
function rbp_is_light( $hex ) {
    
    $hex = str_replace( '#', '', $hex );
    $hex = rbp_full_hex( $hex );
    
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );
    
    $yiq = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;
    
    return $yiq >= 128;
    
}

/**
 * Converts a shorthand Hex color to a full one
 * http://stackoverflow.com/a/1459284
 * 
 * @param       string $hex Hex Color
 *                              
 * @since       1.1.0
 * @return      string Hex Color
 */
function rbp_full_hex( $hex ) {
    
    if ( strlen( $hex ) == 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    
    return $hex;
    
}

/**
 * Darken a Hex Color, similar to SASS darken()
 * Based on: http://stackoverflow.com/a/11951022
 * 
 * @param       string  $hex        Hex Color
 * @param       integer $percentage Percentage by which to darken
 *                                                         
 * @since       1.1.0
 * @return      string  Darkened Hex Color
 */
function rbp_darken_hex( $hex, $percentage ) {
    
    $hex = str_replace( '#', '', $hex );
    $hex = rbp_full_hex( $hex );
    
    // Converts our percentage into a 255 step scale
    // Easier to work with and lines up with SASS darken()
    $steps = ( $percentage * -255 ) / 100;
    
    $rgb_colors = str_split( $hex, 2 );
    
    // Build our new Hex color
    $hex = '#';
    foreach ( $rgb_colors as $color ) {
        
        $color = hexdec( $color ); // We decimal now, boys
        $color = max( 0, min( 255, $color + $steps ) ); // Adjust color
        $hex .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT );
        
    }
    
    return $hex;
    
}

/**
 * Lighten a Hex Color, similar to SASS lighten()
 * Based on: http://stackoverflow.com/a/11951022
 * 
 * @param       string  $hex        Hex Color
 * @param       integer $percentage Percentage by which to lighten
 *                                                         
 * @since       1.1.0
 * @return      string  Lightened Hex Color
 */
function rbp_lighten_hex( $hex, $percentage ) {
    
    $hex = str_replace( '#', '', $hex );
    $hex = rbp_full_hex( $hex );
    
    // Converts our percentage into a 255 step scale
    // Easier to work with and lines up with SASS lighten()
    $steps = ( $percentage * 255 ) / 100;
    
    $rgb_colors = str_split( $hex, 2 );
    
    // Build our new Hex color
    $hex = '#';
    foreach ( $rgb_colors as $color ) {
        
        $color = hexdec( $color ); // We decimal now, boys
        $color = max( 0, min( 255, $color + $steps ) ); // Adjust color
        $hex .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT );
        
    }
    
    return $hex;
    
}