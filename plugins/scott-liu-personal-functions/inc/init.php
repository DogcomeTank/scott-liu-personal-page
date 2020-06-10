<?php
/**
 * @package sl-custom-functions
 */

namespace Sl;

final class init{

    /**
     *  Store all classes that need to initiarize 
     *  @return array off classes
     */
    public static function get_services(){
        return [
            Pages\Admin::class
        ];
    }

    /**
     *  Loop through the classes and initialize them 
     *  @return array off classes
     */
    public static function register_services(){
        foreach (self::get_services() as $class){
            $service = self::instantiate($class);
            if(method_exists($service, 'register')){
                $service->register();
            }
            
        }
    }

    /**
     * Initialize the class
     * @param class $class
     * @return class instance new instance of class
     */
    private static function instantiate($class){
        $service = new $class();
        return $service;
    }

    public static function activate(){
        flush_rewrite_rules();
    }
}