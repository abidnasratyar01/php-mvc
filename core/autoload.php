<?php 

/**
 * Autoload allows you to load class files recursively in defined directories for class, trait and interface definitions 
 * when they are needed, so you wouldnt have to explicitly loading them.
 */
use Exception;

/**
 * Method to auto require Files so you wouldnt have to explicitly loading them.
 * 
 * @param string $className
 */
spl_autoload_register( function ($className)
{
    try {
        $className = str_replace('\\', '/', $className);       
        $filePath = ROOTDIR . "/$className.php";

        if (file_exists($filePath))
            require_once $filePath;
        else
            throw new Exception('classLoader could not find '.$className.'.php .', 404);
            
    } catch (Exception $e) {
        echo 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
    }
});
