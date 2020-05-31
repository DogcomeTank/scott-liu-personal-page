<?php
/*
 * Template Name: Page - Jump Rope Party - V2
 * description: >-
  Jump Rope Party Page template
 */

function enqueue_jump_rope_page() {
    wp_enqueue_style ( 'jump-rope-party-page-style', get_stylesheet_directory_uri() . '/css/page-jump-rope-party.css' );
    wp_enqueue_script ( 'chartjs-script', get_stylesheet_directory_uri() . '/lib/chartjs.2.9.3.js' );
    wp_enqueue_script( 'jump-rope-party-page-script-V2', get_stylesheet_directory_uri() . '/js/page_jump_rope_party.js' , array(), '1.1.0',  'true' );



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
    wp_localize_script( 'jump-rope-party-page-script-V2', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'nonce'=>$nonce, 'user_record'=>$user_records));

}
add_action( 'wp_enqueue_scripts', 'enqueue_jump_rope_page' );


get_header(); ?>

<div style="margin-top: 28px; margin-bottom: 28px;">
  <button class="w3-bar-item w3-button" onclick="chartsTaps('AllChart')">All</button>
  <button class="w3-bar-item w3-button" onclick="chartsTaps('myRecord')">My Record</button>
  <button class="w3-bar-item w3-button" onclick="chartsTaps('faq')">FAQ</button>
</div>

<div class="">
    <div id="AllChart" class="w3-container theTapItem">
        <canvas id="doubleJumpRecordChart"></canvas>
    </div>

    <div id="myRecord" class="w3-container theTapItem" style="display:none">
        <canvas id="myJumpRecordChart"></canvas>
    </div>

    <div id="faq" class="w3-container theTapItem" style="display:none">
    <h2>What is Jump Rope Party? </h2><span><i style="color: #FD7E14; width: 40px; height: 40px; padding:10px;border-radius:50%;box-shadow:0 0 5px rgba(0,0,0,.17); text-align: center;"
            class="fas fa-question"></i></span>
    </div>
</div>


<div id="recordInput">
    <input class="c-checkbox" type="checkbox" id="checkbox">
    <div class="c-formContainer">
        <form class="c-form" id="doubleJumpRecordForm">
            <input class="c-form__input" id="double-record" placeholder="My Highest Double" type="number" min="0"
                required>
            <label class="c-form__buttonLabel" for="checkbox">
                <button class="c-form__button" type="submit">Update</button>
            </label>
            <label class="c-form__toggle" for="checkbox" data-title="Update My Record"></label>
        </form>
    </div>


</div>


<?php get_footer(); ?>