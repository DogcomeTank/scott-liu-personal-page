<?php 
/**
 * Plugin Name: Scott Liu's Custom Functions
 * Plugin URI: NA
 * Description: All Functions for My Personal Website.
 * Version: 1.0
 * Author: Scott Liu
 * Author URI: https://scott-liu.ca/
 */

//  if this file is called directly, abort
if( ! defined( 'WPINC' ) ){
    die;
}

// Menu setup
function sl_custom_plugin_settings_page(){
    // Add an item to the menu.
    add_menu_page(
        __( 'SL Custome Plugin Dashboard', 'textdomain' ), //page title
        __( 'Dashboard', 'textdomain' ), //menu title
        'manage_options',
        'sl-custom-dashboard', //slug
        'sl_cf_page_markup', //callback function
        'dashicons-carrot',
        2
    );
    add_submenu_page(
        'sl-custom-dashboard', //parent_slug
        __( '1st Settings', 'textdomain' ), //page_title
        __( 'Setting', 'textdomain' ),  //menu_title
        'manage_options',
        'sl-plugin-setting-1', //menu_slug
        'sl_cf_subpage_markup', //callable function
    );

    // add_submenu_page( 'sl-custom-dashboard', 'Dashboard', 'Menu Title',
    // 'manage_options', 'sl-dashboard');
}
add_action('admin_menu', 'sl_custom_plugin_settings_page');
function sl_cf_page_markup(){
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( get_admin_page_title() ); ?></h1>
    </div>

    <?php
}

function sl_cf_subpage_markup(){
    ?>
    <div class="wrap">
        <h1>Subpage - 1</h1>
    </div>

    <?php
}

// Menu setup END


function create_custom_db_table() {
    // create custom tables
    $sql_jump_rope_party = "
        CREATE TABLE `sl_jump_rope_party` (
            `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `wp_users_id` int NOT NULL,
            `record` int NOT NULL,
            `record_date` date NOT NULL
        ) COLLATE 'utf8_unicode_520_ci';
    ";
    sl_maybe_create_table( 'sl_jump_rope_party', $sql_jump_rope_party );
    
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'create_custom_db_table' );

function sl_maybe_create_table( $table_name, $create_ddl ) {
    global $wpdb;
 
    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
 
    if ( $wpdb->get_var( $query ) == $table_name ) {
        return true;
    }
 
    // Didn't find it try to create it..
    $wpdb->query( $create_ddl );
 
    // We cannot directly tell that whether this succeeded!
    if ( $wpdb->get_var( $query ) == $table_name ) {
        return true;
    }
    return false;
}

// ajax post start

add_action("wp_ajax_jump_rope_party_record", "jump_rope_party_record");
add_action("wp_ajax_nopriv_jump_rope_party_record", "my_must_login");

function jump_rope_party_record() {
    global $wpdb;
    $login = is_user_logged_in();
    $current_user = get_current_user_id();
    $record = '';
    $record = test_input($_POST['doubleRecord']);
    $result = ['record'=>1];
    // $dt = new DateTime("now", new DateTimeZone('America/Vancouver'));
    $today = date("Y-m-d");

    if ( !wp_verify_nonce( $_REQUEST['nonce'], "my_user_play_nonce")) {
        exit("No naughty business please");
    }   
   
    if(!$login){
        exit("Please login.");
    }

    $sql_get_record =  "
        SELECT * FROM `sl_jump_rope_party` WHERE `wp_users_id` = ".$current_user." AND `record_date` = '".$today."'
    " ;
    $has_record_today = $wpdb->get_results ($sql_get_record);
    $result['has_record'] = $has_record_today;
// 1. Check if has record
    if($has_record_today){
        $old_record = $has_record_today[0]->record;
        $result['old_record'] = $old_record;
// 2. Has record
        // check if number is integer

        if($old_record < $record){
        //  Update record if new number larger then the old one
            $wpdb->update('sl_jump_rope_party', array('record'=>$record), array('wp_users_id'=>$current_user, 'record_date' => $today));
        }
    }else{
// 3. No record
        // Insert new record
        $result['record'] = 0;
        $sql_insert_new_record = "INSERT INTO `sl_jump_rope_party` (`wp_users_id`, `record`, `record_date`)
        VALUES ('1', '65', '2020-04-03');";

        $table = "sl_jump_rope_party";
        $data = array('wp_users_id' => $current_user, 'record' => $record, 'record_date' =>$today );
        // $format = array('%s','%d');
        $wpdb->insert($table,$data);

    }

        print json_encode($result);
    die();

}
function my_must_login() {
    echo "You must log in to play";
    die();
 }
 
 
// custom_email
add_action( 'wp_ajax_custom_email', 'custom_email' );
add_action( 'wp_ajax_nopriv_custom_email', 'custom_email' );
function custom_email() {
    $title = test_input($_POST['title']);
    $description = test_input($_POST['description']);
    $email = test_input($_POST['email']);

    // +++++++++++++++++++++++++++
    // +++++++++++++++++++++++++++
    // // Email function works
    // +++++++++++++++++++++++++++
    // +++++++++++++++++++++++++++

    $to = $email;
    $subject = $title;
    $body = '
        <p>'.$description.'</p>
    ';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'Cc: my-personal@gmail.com';

    $mailResult = wp_mail( $to, $subject, $body, $headers );

    print json_encode($mailResult);
    wp_die(); 

}// custom_email
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




// End Ajax post