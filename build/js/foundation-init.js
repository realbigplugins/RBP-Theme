( function( $ ) {

    $( document ).on( 'ready', function() {

        $( document ).foundation();  
        
        // Can't seem to hook into these events anywhere else
        $( '.off-canvas' ).on( 'opened.zf.offcanvas', function( event, ele ) {

            $( 'html' ).css( 'overflow-x', 'hidden' );

        } );
        
        $( '.off-canvas' ).on( 'closed.zf.offcanvas', function( event, ele ) {

            setTimeout( function() {
                $( 'html' ).css( 'overflow-x', 'initial' );
            }, 500 );

        } );

    } );

} )( jQuery );