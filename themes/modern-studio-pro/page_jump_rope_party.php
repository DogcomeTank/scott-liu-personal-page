<?php
/*
 * Template Name: Page - Jump Rope Party
 * description: >-
  Jump Rope Party Page template
 */

function enqueue_jump_rope_page() {
    wp_enqueue_script ( 'chartjs-script', get_stylesheet_directory_uri() . '/lib/chartjs.2.9.3.js' );
    wp_enqueue_script ( 'jump-rope-party-page-script', get_stylesheet_directory_uri() . '/js/page_jump_rope_party.js' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_jump_rope_page' );

get_header(); ?>


<canvas id="doubleJumpRecordChart"></canvas>



<?php get_footer(); ?>