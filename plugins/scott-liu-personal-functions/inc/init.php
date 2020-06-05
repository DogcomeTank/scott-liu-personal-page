<?php
/**
 * @package sl-custom-functions
 */

 namespace SL;

 class init{

    function __construct(){

    }

    public static function register_services(){
        //echo "working";
    }

     public static function activate(){
         flush_rewrite_rules();
     }
 }