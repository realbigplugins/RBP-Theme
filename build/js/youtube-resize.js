// By Chris Coyier & tweaked by Mathias Bynens
// Further tweaked for our use-case by Eric Defore

( function( $ ) {

    // Find all YouTube videos
    var $allVideos = $( 'iframe[src*="youtube.com"]' );

    // Figure out and save aspect ratio for each video
    $allVideos.each( function() {

        $( this )
            .data( 'aspectRatio', this.height / this.width )

            // and remove the hard coded width/height
            .removeAttr( 'height' )
            .removeAttr( 'width' );

    } );

    // When the window is resized
    // (You'll probably want to debounce this)
    $( window ).resize( function() {

        // Resize all videos according to their own aspect ratio
        $allVideos.each( function() {

            var $el = $( this ),
                newWidth = $el.parent().width(); // Parent Container controls Aspect Ratio based on Width
            $el
                .width( newWidth )
                .height( newWidth * $el.data( 'aspectRatio' ) );

        });

    // Kick off one resize to fix all videos on page load
    } ).resize();

} )( jQuery );