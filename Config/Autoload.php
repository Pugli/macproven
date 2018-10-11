<?php namespace Config;
	
    class Autoload {
        
        public static function Start() {
            spl_autoload_register(function($className)
			{
                $classPath = strtolower(str_replace("\\", "/", ROOT.$className).".php");
                
				include_once($classPath);
			});
        }
    }
?>