<?php
/**
 * @package sl-custom-functions
 */

namespace Sl\Pages;

class Admin{
    function __construct(){}

    // public function register(){
    //     // echo "yes";
    // }

    public function register(){
        // Add plugin menu
        add_action('admin_menu', array($this, 'sl_custom_plugin_settings_page'));
    }

     // Menu setup
    public function sl_custom_plugin_settings_page(){
        

        // Add an item to the menu.
        add_menu_page(
            __( 'SL Custom Plugin Dashboard', 'textdomain' ), //page title
            __( 'SL Functions', 'textdomain' ), //menu title
            'manage_options',
            'sl-custom-dashboard', //slug
            // 'admin_page_content', //callback function
            array($this, 'admin_page_content'), //callback function
            'dashicons-carrot',
            2
        );
        add_submenu_page(
            'sl-custom-dashboard', //parent_slug
            __( 'SL Dashboard', 'textdomain' ), //page_title
            __( 'Dashboard', 'textdomain' ),  //menu_title
            'manage_options',
            'sl-plugin-dashboard', //menu_slug
            array($this, 'sl_cf_subpage_markup'), //callable function
        );
        add_submenu_page(
            'sl-custom-dashboard', //parent_slug
            __( 'Settings', 'textdomain' ), //page_title
            __( 'Setting', 'textdomain' ),  //menu_title
            'manage_options',
            'sl-plugin-setting', //menu_slug
            array($this, 'sl_cf_subpage_markup'), //callable function
        );
        remove_submenu_page('sl-custom-dashboard', 'sl-custom-dashboard');

    }

    public function admin_page_content() {
		require_once plugin_dir_path( dirname( __FILE__, 2 ) ) . 'templates/admin.php';
	}

    public function sl_cf_subpage_markup(){
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( get_admin_page_title() ); ?></h1>
        </div>

        <?php
    }
    // Menu setup END
}