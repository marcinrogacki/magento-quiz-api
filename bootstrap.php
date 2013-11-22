<?php
	define('SITE_PATH',realpath(dirname(__FILE__)).'/');
    set_include_path(get_include_path() . PATH_SEPARATOR . 'app');
    set_include_path(get_include_path() . PATH_SEPARATOR . 'lib');

    function app_autoloader($class)
    {
        if (class_exists($class)) {
            return;
        }

        $path = str_replace("_", "/", $class);
        $file = $path . '.php';
        $absolute = $file;
        
        foreach (explode(':', get_include_path()) as $look) {
            if (is_readable($look . '/' . $absolute)) {
                require_once $file;
            }
        }; 
    }

    spl_autoload_register('app_autoloader');
