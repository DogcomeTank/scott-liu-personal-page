<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

// END ENQUEUE PARENT ACTION

// Custom Code
function enqueue_general() {
    wp_enqueue_style ( 'general-style', get_stylesheet_directory_uri() . '/css/general-style.css',array(), '1.0' );
    wp_enqueue_style ( 'w3-css-style', get_stylesheet_directory_uri() . '/lib/w3.css',array(), '1.0' );
	
	if(is_page('lottie-integration')){
		wp_enqueue_script ( 'lottie-script','https://cdnjs.com/libraries/bodymovin',array(), '1.0',true );
    }
}

add_action( 'wp_enqueue_scripts', 'enqueue_general' );

// Disable admin bar
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    show_admin_bar(false);
}
// Disable admin bar

// Footer credit
add_filter( 'storefront_credit_links_output', 'sl_change_footer_credit', 10, 1 );
function sl_change_footer_credit($links_output){
    $links_output = '';
    return $links_output;
}

// End Footer Credit


// End Custom Code
