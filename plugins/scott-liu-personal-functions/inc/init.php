<?php
/**
 * @package sl-custom-functions
 */

namespace Sl;

final class init{

function __construct(){
    // Sl\Pages\Admin::register();
}

public static function register_services(){
    echo `
        <h1>XxxxxxxxxxXxxxxxxxxxXxxxxxxxxxXxxxxxxxxxXxxxxxxxxx</h1>
    `;
}

    public static function activate(){
        flush_rewrite_rules();
    }
}