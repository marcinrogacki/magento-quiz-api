<?php
	define('SITE_PATH',realpath(dirname(__FILE__)).'/');
    set_include_path(get_include_path() . PATH_SEPARATOR . 'app');
    set_include_path(get_include_path() . PATH_SEPARATOR . 'lib');

	/*Require necessary files.*/
	require_once(SITE_PATH.'application/baseController.php');
	require_once(SITE_PATH.'application/baseModel.php');
	require_once(SITE_PATH.'application/load.php');
	require_once(SITE_PATH.'application/registry.php');
	require_once(SITE_PATH.'controllers/errorController.php');
	require_once(SITE_PATH.'lib/Zend/Loader/Autoloader.php');
	require_once(SITE_PATH.'lib/Zend/Loader.php');

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
