<?php namespace Config;

    class Router {

        /**
         * Se encarga de direccionar a la pagina solicitada
         *
         * @param Request
         */
        
        public static function direccionar(Request $request) {

            /**
             *  
             */
            $controlador = 'Controller'.$request->getControlador();
            
            /**
             * 
             */
            $metodo = $request->getMetodo();
            
            /**
             * 
             */
            $parametros = $request->getParametros();

            /**
             * 
             */
            $mostrar = "Controller\\". $controlador;
            echo "el new es de: ".$mostrar;

            /**
             * 
             */
            $controlador = new $mostrar;

            /**
             * 
             */

            if(!isset($parametros)) {
                call_user_func(array($controlador, $metodo));
            } else {
                call_user_func_array(array($controlador, $metodo), $parametros);
            }
        }
    }

?>