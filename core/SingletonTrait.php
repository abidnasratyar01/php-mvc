<?php

namespace core;
use Exception;

/**
 * Traits are used to declare methods that can be used in multiple classes, hence, SingletonTrait is declared with the purpose 
 * to allow only a single instance of the class that uses this trait to be created and/or gives access to the created instance, 
 * hence, Classes like Request and Driver uses mentioned trait of Singleton for instance creation. 
 */

trait SingletonTrait
{
    /**
     * Private variable used to provide characteristic of statically possessing the instance of the class that uses this trait.
     *
     * @var Object
     */
    private static $instance;
    
    /**
     * Magic method declared private, so it can not be accessible to clone class instance outside class. When it is not accessible 
     * outside the class, so it can not be used to create a copy of an object which ruins the purpose of single instance of class. 
     */
    private function __clone() 
    {
        throw new Exception('Cannot clone Class Instance', 403);
    }

    /**
     * Magic method declared private, so it can prevent de-serializing of class instance outside class. When it is not accessible 
     * outside the class, so it can not be used to reconstruct the object from a series of bytes or a string in order to instantiate
     * the object of the class that uses this trait, for consumption.
     */
    private function __wakeup()
    {
        throw new Exception('Cannot unserialize Class Instance', 403);
    }

    /**
     * Method declared public, so it can be called from anywhere with the purpose to Create Instance of Class if not created else 
     * return the created instance of class that uses this Trait.
     *
     * @return Instance
     */
    public static function getInstance() 
    {
        $class = get_called_class();
        if (!isset(self::$instance)) {
            self::$instance = new $class();
        }
        return self::$instance;
    }
}
