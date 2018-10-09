<?php namespace Config;

    class Request {

        private $controlador;
        private $metodo;
        private $parametros;
        private static $instance = null;
        
        public function __construct()
        {

            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

            $urlToArray = explode("/", $url);
         
            $ArregloUrl = array_filter($urlToArray);

            if(empty($ArregloUrl))
            {
                $this->controlador = 'Home';
            } 
            else 
            {
                $this->controlador = ucwords(array_shift($ArregloUrl));
            }

            if(empty($ArregloUrl))
            {
                $this->metodo = 'index';
            } 
            else 
            {
                $this->metodo = array_shift($ArregloUrl);
            }

            $metodoRequest = $this->getMetodoRequest();

            if($metodoRequest == 'GET') #Metodo para recuperar los valores que viajan por GET
            {
                $cant = count($_GET);
                $tags = array_keys($_GET);// obtiene los nombres de las varibles
                $valores = array_values($_GET);// obtiene los valores de las varibles

                // crea las variables y les asigna el valor
                for($i = 1; $i < $cant; $i++)
                {
                    if(strcmp($tags[$i], 'url') != 0){
                        array_push($ArregloUrl, $valores[$i]);
                    }
                }

                if(!empty($ArregloUrl))
                {
                    $this->parametros = $ArregloUrl;
                }
            }
            else
            {
                $this->parametros = $_POST;
            }
        }

        public static function getInstance()
        {            
            if (!isset(self::$instance))
            {
                self::$instance = new Request();
            }
            
            return self::$instance;
        }

        public static function getMetodoRequest()
        {
            return $_SERVER['REQUEST_METHOD'];
        }

        public function getControlador() {
            return $this->controlador;
        }

        public function getMetodo() {
            return $this->metodo;
        }

        public function getParametros() {
            return $this->parametros;
        }
    }