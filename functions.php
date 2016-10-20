<?php
/**
 * The theme's functions file that loads on EVERY page, used for uniform functionality.
 *
 * @since   0.1.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Make sure PHP version is correct
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
	wp_die( 'ERROR in RealBigPlugins theme: PHP version 5.3 or greater is required.' );
}

// Make sure no theme constants are already defined (realistically, there should be no conflicts)
if ( defined( 'THEME_VERSION' ) || defined( 'THEME_ID' ) || isset( $theme_fonts ) ) {
    wp_die( 'ERROR in Real Big Plugins theme: There is a conflicting constant. Please either find the conflict or rename the constant.' );
}

define( 'EDD_SLUG', 'plugins' );

/**
 * Define Constants based on our Stylesheet Header. Update things only once!
 */

$theme_header = wp_get_theme();

define( 'THEME_ID', $theme_header->get( 'TextDomain' ) );
define( 'THEME_VERSION', $theme_header->get( 'Version' ) );

/**
 * Fonts for the theme. Must be hosted font (Google fonts for example).
 */
$theme_fonts = array(
	'open-sans' => '//fonts.googleapis.com/css?family=Open+Sans:300italic,700,300,800',
    'font-awesome' => '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
    'leckerli-one' => '//fonts.googleapis.com/css?family=Leckerli+One',
);

/**
 * Setup theme properties and stuff.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function () {

	// Add theme support
	require_once __DIR__ . '/includes/theme-support.php';

	// Allow shortcodes in text widget
	add_filter( 'widget_text', 'do_shortcode' );
} );

/**
 * Register theme files.
 *
 * @since 0.1.0
 */
add_action( 'init', function () {

	global $theme_fonts;

	// Theme styles
	wp_register_style(
		THEME_ID,
		get_template_directory_uri() . '/style.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);

	// Theme script
	wp_register_script(
		THEME_ID,
		get_template_directory_uri() . '/script.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Theme fonts
	if ( ! empty( $theme_fonts ) ) {
		foreach ( $theme_fonts as $ID => $link ) {
			wp_register_style(
				THEME_ID . "-font-$ID",
				$link
			);
		}
	}
} );

/**
 * Enqueue theme files.
 *
 * @since 0.1.0
 */
add_action( 'wp_enqueue_scripts', function () {

	global $theme_fonts;

	// Theme styles
	wp_enqueue_style( THEME_ID );

	// Theme script
	wp_enqueue_script( THEME_ID );

	// Theme fonts
	if ( ! empty( $theme_fonts ) ) {
		foreach ( $theme_fonts as $ID => $link ) {
			wp_enqueue_style( THEME_ID . "-font-$ID" );
		}
	}
} );

/**
 * Register nav menus.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function () {
	register_nav_menu( 'primary', 'Primary Menu' );
} );

/**
 * Register sidebars.
 *
 * @since 0.1.0
 */
add_action( 'widgets_init', function () {

    // Footer left
    register_sidebar( array(
    	'name' => 'Footer Left',
    	'id' => 'footer-left',
    	'description' => 'Displays in the left side of the footer.',
    	'before_title' => '<h3 class="footer-widget-title">',
    	'after_title' => '</h3>',
    ) ); 
    
    // Footer center
    register_sidebar( array(
    	'name' => 'Footer Center',
    	'id' => 'footer-center',
    	'description' => 'Displays in the center of the footer.',
    	'before_title' => '<h3 class="footer-widget-title">',
    	'after_title' => '</h3>',
    ) ); 
    
    // Footer right
    register_sidebar( array(
    	'name' => 'Footer Right',
    	'id' => 'footer-right',
    	'description' => 'Displays in the right side of the footer.',
    	'before_title' => '<h3 class="footer-widget-title">',
    	'after_title' => '</h3>',
    ) );
    
} );

add_action( 'wp_footer', function () {

	if ( ! is_user_logged_in() ) :
		?>
		<script>
			(function (i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] || function () {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o),
					m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-37145568-3', 'auto');
			ga('send', 'pageview');

		</script>
	<?php
	endif;
    
} );

/**
 * Setup theme properties and stuff
 * 
 * @since 1.0.0
 * @return void
 */
add_action( 'after_setup_theme', function () {

    // Add theme support
    require_once __DIR__ . '/includes/theme-support.php';
    
    // Add miscellaneous helper functions
    require_once __DIR__ . '/includes/theme-functions.php';

    // Nav Walker for Foundation
    require_once __DIR__ . '/includes/class-foundation_nav_walker.php';
    
    // Walker for Foundation Magellan via wp_list_pages()
    require_once __DIR__ . '/includes/class-foundation_magellan_walker.php';

    // Allow shortcodes in text widget
    add_filter( 'widget_text', 'do_shortcode' );

} );

/**
 * Register our CSS/JS
 * 
 * @since 1.0.0
 * @return void
 */
add_action( 'init', function() {

    global $theme_fonts;

    // Theme styles
    wp_register_style(
        THEME_ID,
        get_template_directory_uri() . '/style.css',
        null,
        defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
    );
    
    // Login styles
    wp_register_style(
        THEME_ID . '-login',
        get_template_directory_uri() . '/login.css',
        null,
        defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
    );

    // Theme fonts
    if ( ! empty( $theme_fonts ) ) {
        foreach ( $theme_fonts as $ID => $link ) {
            wp_register_style(
                THEME_ID . "-font-$ID",
                $link
            );
        }
    }

} );

/**
 * Enqueue our CSS/JS on the Frontend
 * 
 * @since 1.0.0
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

    global $theme_fonts;

    wp_enqueue_style( THEME_ID );

    // Theme fonts
    if ( ! empty( $theme_fonts ) ) {
        foreach ( $theme_fonts as $ID => $link ) {
            wp_enqueue_style( THEME_ID . "-font-$ID" );
        }
    }

} );

/**
 * Enqueue our CSS/JS on the Login Screen
 * 
 * @since 1.0.0
 * @return void
 */
add_action( 'login_enqueue_scripts', function() {
    
    wp_enqueue_style( THEME_ID . '-login' );
    
} );

/**
 * Register Nav Menus
 * 
 * @since 1.0.0
 * return void
 */
add_action( 'after_setup_theme', function () {
    
    register_nav_menu( 'primary-left', 'Primary Left Menu' );
    
    register_nav_menu( 'primary-right', 'Primary Right Menu' );

} );

/**
 * Run Big Brother scripts only for non-logged in Users
 * 
 * @since 1.0.0
 * return void
 */
add_action( 'wp_footer', function () {

    if ( ! is_user_logged_in() ) :
?>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-37145568-3', 'auto');
    ga('send', 'pageview');

</script>
<?php
    endif;

} );

/**
 * Make YouTube videos not show suggested videos at the end
 * 
 * @param string $return HTML
 * @param object $data Data Object returned from oEmbed provider
 * @param string $url URL String
 * 
 * @since 1.1.0
 * @return HTML
 */
add_filter( 'oembed_dataparse', function( $return, $data, $url ) {
    
    if ( $data->provider_name == 'YouTube' ) {
        
        $return = str_replace( '?feature=oembed"', '?feature=oembed&rel=0" class="youtube-embed"', $return );
    }
    
    return $return;
    
}, 10, 3 );

/**
 * Register Customizer Controls
 * @param object $wp_customize    WP Customizer Object
 *                                              
 * @since 1.1.0
 * @return void
 */
add_action( 'customize_register', function( $wp_customize ) {
    
    $wp_customize->add_section( 'rbp_home_section' , array(
            'title'      => __( 'Home Page Settings', THEME_ID ),
            'priority'   => 30,
        ) 
    );
    
    $wp_customize->add_setting( 'home_background', array(
            'default'     => 1,
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'home_background', array(
        'label'        => __( 'Home Page Background', THEME_ID ),
        'section'    => 'rbp_home_section',
        'settings'   => 'home_background',
        'mime_type'  => 'image',
        'active_callback' => 'is_front_page',
    ) ) );
    
    $wp_customize->add_setting( 'home_tagline', array(
            'default'     => __( 'Quality WordPress Plugins<br />Built With Love', THEME_ID ),
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home_tagline', array(
        'label'        => __( 'Home Page Tagline', THEME_ID ),
        'section'    => 'rbp_home_section',
        'settings'   => 'home_tagline',
        'active_callback' => 'is_front_page',
    ) ) );
    
    $wp_customize->add_setting( 'home_button_text', array(
            'default'     => __( 'View Our Plugins', THEME_ID ),
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home_button_text', array(
        'label'        => __( 'Home Page Tagline', THEME_ID ),
        'section'    => 'rbp_home_section',
        'settings'   => 'home_button_text',
        'active_callback' => 'is_front_page',
    ) ) );
    
} );

/**
 * Add Post Meta-controlled Styling to the Download Single
 * I really don't like doing this, but this is about the only way to get DB-stored Colors into the Styling
 * 
 * @since       1.1.0
 * @return      HTML
 */
add_action( 'wp_print_styles', function() {
    
    if ( is_single() && get_post_type() == 'download' ) : 

        $primary_color = get_post_meta( get_the_ID(), '_rbm_primary_color', true );
        $primary_color = ( $primary_color ) ? $primary_color : '#12538f';
    
        $secondary_color = get_post_meta( get_the_ID(), '_rbm_secondary_color', true );
        $secondary_color = ( $secondary_color ) ? $secondary_color : '#51a0e9';
    
        ?>

        <style type="text/css">
            
            /* Same styling as Downloads Archive, but controlled via Post Meta */
            .download-color-section {
                
                background-color: <?php echo $primary_color; ?>;
                border-bottom: 0.5rem solid <?php echo $secondary_color; ?>;
                
                color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?>;
                
            }
            
            .download-color-section ul * {
                
                color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?>;
                
            }
            
            .download-color-section .button {
                
                background-color: <?php echo $primary_color; ?> !important;
                color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?> !important;
                
            }
            
            .download-color-section .button:hover {
                
                background-color: <?php echo rbp_darken_hex( $primary_color, 15 ); ?> !important;
                color: <?php echo ( rbp_is_light( rbp_darken_hex( $primary_color, 15 ) ) ) ? '#000' : '#fff'; ?> !important;
                
            }
            
            .download-color-section .button.hollow {
                
                background-color: transparent !important;
                border-color: <?php echo $primary_color; ?> !important;
                color: <?php echo $primary_color; ?> !important;
                
            }
            
            .download-color-section .button.hollow:hover {
                
                background-color: <?php echo $primary_color; ?> !important;
                border-color: <?php echo $primary_color; ?> !important;
                color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?> !important;
                
            }
            
            .download-color-section .button.invert {
                
                background-color: #fff !important;
                color: <?php echo $primary_color; ?> !important;
                
            }
            
            .download-color-section .button.invert:hover {
                
                background-color: <?php echo $primary_color; ?> !important;
                color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?> !important;
                
            }
            
            .download-buy-link {
                
                background-color: <?php echo $primary_color; ?> !important;
                box-shadow: 7.5px 7.5px <?php echo $secondary_color; ?>;
                
                color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?> !important;
                
            }
            
            .download-buy-link:hover {
                
                background-color: <?php echo rbp_darken_hex( $primary_color, 15 ); ?> !important;
                box-shadow: 7.5px 7.5px <?php echo rbp_darken_hex( $secondary_color, 15 ); ?>;
                
                color: <?php echo ( rbp_is_light( rbp_darken_hex( $primary_color, 15 ) ) ) ? '#000' : '#fff'; ?> !important;
                
            }
            
            #download-buy .edd_price_options ul:after {
            
                border-top: solid 3px <?php echo $secondary_color; ?>;
                color: <?php echo $secondary_color; ?>;
                display: block;
                width: 100%;
                content: '<?php echo _x( 'All price options are billed yearly. You may cancel your subscription at any time.', 'Price Options Disclaimer Text', THEME_ID ); ?>';
                font-style: italic;
                margin-top: 0.5em;
                padding-top: 0.5em;

            }
            
            #download-buy .edd_price_options ul li.active {
                
                <?php if ( rbp_is_light( $secondary_color ) ) : ?>
                    background-color: <?php echo rbp_darken_hex( $secondary_color, 15 ); ?>;
                    color: #fff;
                <?php else : ?>
                    background-color: <?php echo rbp_lighten_hex( $secondary_color, 15 ); ?>;
                    color: #000;
                <?php endif; ?>
                
            }
            
            #download-buy .edd_price_options ul li.active * {
                
                <?php if ( rbp_is_light( $secondary_color ) ) : ?>
                    color: #fff;
                <?php else : ?>
                    color: #000;
                <?php endif; ?>
                
            }
            
            #download-buy .edd_price_options del {
                color: <?php echo $secondary_color; ?>;
            }
            
            #download-buy .edd_price_options input[type="radio"] ~ span:first-of-type:before {
                
                color: <?php echo $secondary_color; ?>;
                
            }
            
            #download-buy .edd_price_options input[type="radio"]:checked ~ span:first-of-type:before {
                
                <?php if ( rbp_is_light( $secondary_color ) ) : // Background color has been darkend accordingly above ?>
                    color: #fff;
                <?php else : ?>
                    color: #000;
                <?php endif; ?>
                
            }
            
            #download-buy .edd_purchase_submit_wrapper .support-link {   
                color: <?php echo $secondary_color; ?>;
            }
            
            #download-buy .edd_purchase_submit_wrapper .support-link:hover {   
                
                <?php if ( rbp_is_light( $primary_color ) ) : ?>
                    color: <?php echo rbp_darken_hex( $secondary_color, 25 ); ?>;
                <?php else : ?>
                    color: <?php echo rbp_lighten_hex( $secondary_color, 25 ); ?>;
                <?php endif; ?>
                
            }
            
            #download-buy .edd_purchase_submit_wrapper .support-link:before, #download-buy .edd_purchase_submit_wrapper .support-link:after {   
                
                <?php if ( rbp_is_light( $primary_color ) ) : ?>
                    border-color: <?php echo rbp_darken_hex( $secondary_color, 25 ); ?>;
                <?php else : ?>
                    border-color: <?php echo rbp_lighten_hex( $secondary_color, 25 ); ?>;
                <?php endif; ?>
                
            }
            
        </style>

    <?php endif;
    
} );

/**
 * EDD could really use a few more Action Hooks around here...
 * Since this is HTML we can't use CSS Pseudo Selectors to toss it in there
 * 
 * @param       string $purchase_form Purchase Form HTML
 * @param       array  $args          Purchase Form $args
 *                                                  
 * @since       1.1.0
 * @return      string Purchase Form HTML
 */
add_filter( 'edd_purchase_download_form', function( $purchase_form, $args ) {
    
    $preg_match_bool = preg_match( '/<div class="edd_purchase_submit_wrapper">(.*?)<\/div>/ims', $purchase_form, $matches );
    
    if ( $preg_match_bool ) {
        
        $link_text = _x( 'Questions or concerns?', 'Download Single Support Link Text', THEME_ID );
    
        // Between the HTML Tags
        $injected_link = $matches[1] . '<a href="/support/" class="support-link" title="' . $link_text . '">' . $link_text . '</a>';
        
        $purchase_form = str_replace( $matches[1], $injected_link, $purchase_form );
            
    }
    
    return $purchase_form;
    
}, 10, 2 );

// Include other static files
require_once __DIR__ . '/includes/shortcodes/mailchimp-embed.php';