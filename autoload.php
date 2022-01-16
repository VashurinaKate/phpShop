<?php

require_once 'config.php';
require_once 'lib/vendor/autoload.php';

spl_autoload_register('autoloadClass'); 

function autoloadClass($className) {
    $dirs = ['controllers', 'models'];
    $found = false;
    foreach ($dirs as $dir) {
        $fileName = __DIR__ . '/' . $dir . '/' . $className . '.class.php';
        
        if (is_file($fileName)) {
            require_once($fileName);
            $found = true;
        }
    }
    if (!$found) {
        throw new Exception('Загрузка не удалась ' . $className);
    }
    return true;
}
