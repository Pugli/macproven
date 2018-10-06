<?php

    namespace Config;

    class Autoload{

        public function start()
        {
            define("ROOT", dirname(__DIR__));
        
            spl_autoload_register(function ($className)
            {
               require_once(ROOT."/".$className.".php");
            });            
        }
    }
        
?>