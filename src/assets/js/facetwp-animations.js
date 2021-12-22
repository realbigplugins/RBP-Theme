( function( $ ) {

    var loaded = false,
        $posts = false;
    
    // Ensure this does not fire on page load
    $( document ).on( 'facetwp-refresh', function() {

        console.log( $posts );

        if ( loaded ) {

            $posts.each( function( index, element ) {
                $( element ).addClass( 'is-loading' );
            } );

        }
        else {
            loaded = true;
        }

    } );
    
    $( document ).on( 'facetwp-loaded ', function() {

        if ( $( '.facetwp-template' ).find( '[class*="category-"]' ) ) {
            $posts = $( '.facetwp-template' ).find( '[class*="category-"]' );
        }
        else {
            $posts = $( '.facetwp-template' ).find( '[class*="post-"]' );
        }
            
        $posts.each( function( index, element ) {
            $( element ).removeClass( 'is-loading' );
        } );
        
        $( document ).trigger( 'facetwp-animations-done' );

    } );
        
    $( document ).on( 'facetwp-animations-done', function() {

        $( '.facetwp-template iframe' ).each( function( index, element ) {

            // Force reload. Fixes some weird browser cache issues when hitting the back button
            $( element ).attr( 'src', $( element ).attr( 'src' ) );

        } );

    } );

} )( jQuery );