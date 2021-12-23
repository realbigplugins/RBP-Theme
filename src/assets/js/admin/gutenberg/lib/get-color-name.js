/**
 * Gets a Color Name based on the Color Hex
 *
 * @param   string  color   Color Hex
 * @param   array   colors  Array of Color Objects
 *
 * @since   {{VERSION}}
 * @return  string          Color Name
 */
 function getColorName( color, colors ) {

    var colors = colors.filter( function( colorObj ) {
        return colorObj.color == color;
    } );

    if ( typeof( colors[0] ) == 'undefined' ) return false;

    return colors[0].name;

}

export {
    getColorName,
};