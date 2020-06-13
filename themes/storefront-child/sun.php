<?php
/*
 * Template Name: Page - Sun Animation
 */

function enqueue_sun_page() {
    wp_enqueue_style ( 'sun-style', get_stylesheet_directory_uri() . '/css/sun.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_sun_page' );

// $dt = new DateTime("now", new DateTimeZone('America/Vancouver'));
date_default_timezone_set('America/Vancouver');

get_header(); ?>

<div class="sun-container">
<div class="sun">
  <div class="sunrays">
    <span />
    <span />
    <span />
  </div>
  
  <div class="face">
    <div class="left eye"></div>
    <div class="right eye"></div>
    <div class="left cheek"></div>
    <div class="right cheek"></div>
    <div class="mouth"></div>
  </div>
</div>

</div>


<?php get_footer(); ?>