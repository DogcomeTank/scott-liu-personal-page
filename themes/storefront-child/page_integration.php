<?php
/*
 * Template Name: Page - Integration
 */

function enqueue_page_integration() {
    wp_enqueue_style ( 'integration-style', get_stylesheet_directory_uri() . '/css/page-integration.css' );
    wp_enqueue_script ( 'integration-script', get_stylesheet_directory_uri() . '/js/page-integration.js' ,  array(), time(),  'true' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_page_integration' );

get_header();
?>


<div class="w3-container">
    <div class="machine">
        <img src="https://scott-liu.ca/wp-content/uploads/2020/06/DialArtboard-1-copy-2.svg" class="dial" id="dial"
            onclick="rotate();">
        <img src="https://scott-liu.ca/wp-content/uploads/2020/06/FillArtboard-1-copy-2.svg" class="fill-arm"
            id="fill-arm" onclick="rotate();">
    </div>

    <div>
    <p>Dial Rotation: <span id="dial-rotation">0.0000</span></p>
    <p>Fill Arm Rotation: <span id="fill-arm-rotation">0.0000</span></p>
    </div>

    <div class="w3-row">
        <div class="w3-col s3">
            <h5>Slow</h5>
            <p><button id="dial-ccw-slow-btn" class="w3-button w3-black w3-round"><i class="fas fa-undo"></i> Dial</button></p>
            <p><button id="fill-ccw-slow-btn" class="w3-button w3-black w3-round"><i class="fas fa-undo"></i> Fill Arm</button></p>
        </div>
        <div class="w3-col s3">
        <h5>Fast</h5>
            <p><button id="dial-ccw-fast-btn" class="w3-button w3-black w3-round"><i class="fas fa-undo"></i> Dial</button></p>
            <p><button id="fill-ccw-fast-btn" class="w3-button w3-black w3-round"><i class="fas fa-undo"></i> Fill Arm</button></p>
        </div>
        <div class="w3-col s3">
            <h5>Slow</h5>
            <p><button id="dial-cw-slow-btn" class="w3-button w3-black w3-round"><i class="fas fa-redo"></i> Dial</button></p>
            <p><button id="fill-cw-slow-btn" class="w3-button w3-black w3-round"><i class="fas fa-redo"></i> Fill Arm</button></p>
        </div>
        <div class="w3-col s3">
        <h5>Fast</h5>
            <p><button id="dial-cw-fast-btn" class="w3-button w3-black w3-round"><i class="fas fa-redo"></i> Dial</button></p>
            <p><button id="fill-cw-fast-btn" class="w3-button w3-black w3-round"><i class="fas fa-redo"></i> Fill Arm</button></p>
        </div>
    </div>


    
    
</div>



<script>


</script>

<?php get_footer(); ?>