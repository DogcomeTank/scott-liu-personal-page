<?php
/*
 * Template Name: Page - Jump Rope Party
 * description: >-
  Jump Rope Party Page template
 */

function enqueue_jump_rope_page() {
    wp_enqueue_style ( 'jump-rope-party-page-style', get_stylesheet_directory_uri() . '/css/page-jump-rope-party.css' );
    wp_enqueue_script ( 'chartjs-script', get_stylesheet_directory_uri() . '/lib/chartjs.2.9.3.js' );
    wp_enqueue_script ( 'jump-rope-party-page-script', get_stylesheet_directory_uri() . '/js/page_jump_rope_party.js' );
    

    // get record for chartjs
    global $wpdb;
    $sql_get_user_records = "SELECT wp_users.user_nicename, sl_jump_rope_party.record, sl_jump_rope_party.record_date FROM `sl_jump_rope_party`
        INNER JOIN wp_users
        ON wp_users_id = wp_users.ID
        ORDER BY sl_jump_rope_party.record_date 
        LIMIT 150
    ";
    
    $user_records = $wpdb->get_results ($sql_get_user_records);
    $user_records = json_encode($user_records);
    $nonce = wp_create_nonce("my_user_play_nonce");
    wp_localize_script( 'jump-rope-party-page-script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'nonce'=>$nonce, 'user_record'=>$user_records));

}
add_action( 'wp_enqueue_scripts', 'enqueue_jump_rope_page' );


get_header(); ?>


<canvas id="doubleJumpRecordChart"></canvas>


<div id="recordInput">
    <input class="c-checkbox" type="checkbox" id="checkbox">
    <div class="c-formContainer">
        <form class="c-form" id="doubleJumpRecordForm">
            <input class="c-form__input" id="double-record" placeholder="My Highest Double" type="number" min="0" required>
            <label class="c-form__buttonLabel" for="checkbox">
                <button class="c-form__button" type="submit">Update</button>
            </label>
            <label class="c-form__toggle" for="checkbox" data-title="Update My Record"></label>
        </form>
    </div>


</div>


<?php get_footer(); ?>