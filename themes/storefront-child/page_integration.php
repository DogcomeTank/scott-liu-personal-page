<?php
/*
 * Template Name: Page - Integration
 */

function enqueue_page_integration() {
    wp_enqueue_style ( 'integration-style', get_stylesheet_directory_uri() . '/css/page-integration.css' );
    wp_enqueue_script ( 'integration-script', get_stylesheet_directory_uri() . '/js/page-integration.js' ,  array(), time(),  'true' );

    // get the setting for dial and fill arm
    global $wpdb;
    $sql_dial_fill_setting = "SELECT * FROM sl_dial_fill_setting";
    
    $settings = $wpdb->get_results ($sql_dial_fill_setting);
    $settings_json = json_encode($settings);
    $nonce = wp_create_nonce("my_user_play_nonce");
    wp_localize_script( 'integration-script', 'dialFillSettings', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'nonce'=>$nonce, 'settings'=>$settings_json));
}

add_action( 'wp_enqueue_scripts', 'enqueue_page_integration' );

get_header();
?>


<div class="w3-container">
    <p>
        <button id="run-btn" class="w3-button w3-green w3-round">Run</button>
        <button id="stop-btn" class="w3-button w3-red w3-round">Stop</button>
        <button id="reset-btn" class="w3-button w3-yellow w3-round">Reset</button>
    </p>
    <div class="machine">
        <img src="https://scott-liu.ca/wp-content/uploads/2020/06/DialArtboard-1-copy-2.svg" class="dial" id="dial">
        <img src="https://scott-liu.ca/wp-content/uploads/2020/06/FillArtboard-1-copy-2.svg" class="fill-arm"
            id="fill-arm">
    </div>

    <div>
        <p>Dial Rotation: <span id="dial-rotation">0.0000</span></p>
        <p>Fill Arm Rotation: <span id="fill-arm-rotation">0.0000</span></p>
    </div>

    <div class="w3-row">
        <div class="w3-col s3">
            <h5>Slow</h5>
            <p><button id="dial-ccw-slow-btn" class="w3-button w3-black w3-round"><i class="fas fa-undo"></i>
                    Dial</button></p>
            <p><button id="fill-ccw-slow-btn" class="w3-button w3-black w3-round"><i class="fas fa-undo"></i> Fill
                    Arm</button></p>
        </div>
        <div class="w3-col s3">
            <h5>Fast</h5>
            <p><button id="dial-ccw-fast-btn" class="w3-button w3-black w3-round"><i class="fas fa-undo"></i>
                    Dial</button></p>
            <p><button id="fill-ccw-fast-btn" class="w3-button w3-black w3-round"><i class="fas fa-undo"></i> Fill
                    Arm</button></p>
        </div>
        <div class="w3-col s3">
            <h5>Slow</h5>
            <p><button id="dial-cw-slow-btn" class="w3-button w3-black w3-round"><i class="fas fa-redo"></i>
                    Dial</button></p>
            <p><button id="fill-cw-slow-btn" class="w3-button w3-black w3-round"><i class="fas fa-redo"></i> Fill
                    Arm</button></p>
        </div>
        <div class="w3-col s3">
            <h5>Fast</h5>
            <p><button id="dial-cw-fast-btn" class="w3-button w3-black w3-round"><i class="fas fa-redo"></i>
                    Dial</button></p>
            <p><button id="fill-cw-fast-btn" class="w3-button w3-black w3-round"><i class="fas fa-redo"></i> Fill
                    Arm</button></p>
        </div>
    </div>




</div>



<script>


</script>

<?php get_footer(); ?>