<?php

/* 
L'autoloader permet de charger automatiquement une classe lorsqu'elle est utilisée.
*/

class Autoloader {
    public static function register() {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($className) {
        $file = __DIR__ .'/controllers'. '/' . str_replace('\\', '/', $className) . '.php';
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        return false;
    }
}

?>
