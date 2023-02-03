<?php 

use core\request;
use core\dispatcher;
use Exception;

define('ROOTDIR', dirname(__DIR__));
require_once ROOTDIR.'/core/autoload.php';
require_once ROOTDIR.'/app/config.php';

try {
    $requestobj = request::getInstance();
    $dispatcher = new dispatcher();
    
    echo $dispatcher->dispatchRequest();
  
} catch (Exception $e) {
    echo 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
}
