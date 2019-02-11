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
	'open-sans' => '//fonts.googleapis.com/css?family=Open+Sans:400italic,700,400,800',
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
		get_template_directory_uri() . '/dist/assets/css/app.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);

	// Theme script
	wp_register_script(
		THEME_ID,
		get_template_directory_uri() . '/dist/assets/js/script.js',
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
        get_template_directory_uri() . '/dist/assets/css/style.css',
        null,
        defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
    );
    
    // Login styles
    wp_register_style(
        THEME_ID . '-login',
        get_template_directory_uri() . '/dist/assets/css/login.css',
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
 * Conditionally Add Account or Login Links to the Menu
 * 
 * @param       string $items The HTML list content for the menu items
 * @param       object $args  An object containing wp_nav_menu() arguments
 *                                                               
 * @since       1.2.1
 * @return      string The HTML list content for the menu items
 */
add_filter( 'wp_nav_menu_items', 'rbp_conditional_menu_items', 10, 2 );
function rbp_conditional_menu_items( $items, $args ) {
    
    if ( is_user_logged_in() && $args->theme_location == 'primary-right' ) {
        $items .= '<li><a href="/checkout/purchase-history/">' . _x( 'My Account', 'My Account Menu Item Text', THEME_ID ) . '</a></li>';
    }
    else if ( ! is_user_logged_in() && $args->theme_location == 'primary-right' ) {
        $items .= '<li><a href="/login/">' . _x( 'Login', 'Login Menu Item Text', THEME_ID ) . '</a></li>';
    }
    
    return $items;
    
}

/**
 * Adds MailChimp JS to <head>
 * 
 * @since		1.3.2
 * @return		void
 */
add_action( 'wp_head', function() {
	
	?>

<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/82db87321b6e03e3d7c4d9445/91d077eb907a6caf00fcf02d2.js");</script>

	<?php
	
} );

/**
 * Google Site Verification
 * 
 * @since		1.3.4
 * @return		void
 */
add_action( 'wp_head', function() {
	
	?>

<meta name="google-site-verification" content="3Nq8ltyd1lGWOrfOU-TUAmX5hjC6Ap0UMxap8URgK0o" />

	<?php
	
} );

// Include other static files
require_once __DIR__ . '/includes/shortcodes/mailchimp-embed.php';

add_filter( 'gform_get_form_filter_3', 'realbigplugins_add_form_response_time_notice', 10, 2 );

/**
 * Add notice above our Support Form about our hours
 * 
 * @param		string $form_string The form markup, including the init scripts (unless the gform_init_scripts_footer filter was used to move them to the footer)
 * @param		array  $form        The form currently being processed
 *                                                      
 * @since		{{VERSION}}
 * @return		string HTML
 */
function realbigplugins_add_form_response_time_notice( $form_html, $form ) {
	
	?>

	<div class="callout secondary">
		
		<h4>
			Support Turnaround
		</h4>
		
		<p>
			Support hours are Monday through Friday, 9:00 a.m. to 5:00 p.m. Eastern Time. Tickets are answered in the order in which they are received. Average response time is one business day.
		</p>
		
	</div>

	<?php 
	
	$callout = ob_get_clean();
	
	return $callout . $form_html;
	
}