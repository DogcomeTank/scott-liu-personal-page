<?php 
/**
 * Plugin Name: Scott Liu's Custom Functions
 * Plugin URI: NA
 * Description: All Functions for My Personal Website.
 * Version: 1.0
 * Author: Scott Liu
 * Author URI: https://scott-liu.ca/
 */



function create_custom_db_table() {
    // create custom tables
    $sql_jump_rope_party = "
        CREATE TABLE `sl_jump_rope_party` (
            `id` int NOT NULL,
            `wp_users_id` int NOT NULL,
            `record` int NOT NULL,
            `record_date` date NOT NULL
        );
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
    $record = $_POST['doubleRecord'];

    if ( !wp_verify_nonce( $_REQUEST['nonce'], "my_user_play_nonce")) {
        exit("No naughty business please");
    }   
   
    if(!$login){
        exit("Please login.");
    }

    print json_encode($record);
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
