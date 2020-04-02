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
    $nonce = wp_create_nonce("my_user_play_nonce");
    wp_localize_script( 'jump-rope-party-page-script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'nonce'=>$nonce));
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