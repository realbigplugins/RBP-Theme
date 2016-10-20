( function( $ ) {
    
    $( document ).ready( function() {
        
        // Bail if it doesn't exist. No need to create new listeners.
        if ( $( '.edd_price_options' ).length > 0 ) {
            
            
            // EDD doesn't provide a nice way to highlight a whole selected row.
            // Let's fix that
            
            $( '.edd_price_options input[type="radio"]:checked' ).closest( 'li' ).addClass( 'active' );
            
            $( '.edd_price_options input[type="radio"]' ).on( 'change', function() {
                
                $( '.edd_price_options li' ).removeClass( 'active' );
                $( this ).closest( 'li' ).addClass( 'active' );
                
            } );
            
        }
        
    } );
    
} )( jQuery );