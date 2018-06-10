<?php
class Startup
{
    public static function _init(bool $isController = false)
    {
        self::_configurePaths($isController);
        spl_autoload_register(function($className)
        {
            $path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . CONFIG['app']['home'] . DIRECTORY_SEPARATOR . $className . '.php';
            
            require_once $path;
        });
    }
    
    public static function _configurePaths(bool $isController)
    {
        $basePath = $isController ? '../' : '';
        $config   = parse_ini_file("${basePath}config/config.ini", true);
        define('CONFIG', $config);
    }
} 
