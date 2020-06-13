<?php
/*
 * Template Name: Page - About Me
 */

function enqueue_about_me() {
    wp_enqueue_style ( 'about-me-style', get_stylesheet_directory_uri() . '/css/page-about-me.css' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_about_me' );

get_header();
?>


<h2 style="text-align:center">About Me</h2>

<div class="card-a">
  <img src="https://scott-liu.ca/wp-content/uploads/2020/04/Scott-Liu-768x1024.png" alt="John" style="width:100%">
  <h1>Scott Liu</h1>
  <p class="title-a">Full Stack Developer, Electrician, Mechanical Technician, Graphic Designer</p>
  <div class="social-link" style="margin: 24px 0;">
    <a href="https://github.com/DogcomeTank"><i class="fab fa-github"></i></a>  
    <a href="https://www.linkedin.com/in/scott-liu-47912849/"><i class="fab fa-linkedin"></i></a> 
  </div>
  <p><button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Contact</button></p>
</div>


<div class="w3-container">
  

  <div id="id01" class="w3-modal" style="display: none;">
    <div class="w3-modal-content w3-card-4">
      <header class="w3-container w3-pale-yellow"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2 class="w3-margin">My Email</h2>
      </header>
      <div class="w3-container">
        <p>Coming Soon</p>
      </div>

    </div>
  </div>
</div>


<?php get_footer(); ?>

