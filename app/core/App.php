<?php

/**
 * @Author: yosrio
 * @Date:   2022-10-08 12:36:48
 * @Last Modified by:   yosri
 * @Last Modified time: 2022-10-08 12:38:14
 */

class App {
    
    protected $controller;
    protected $method ='index';
    protected $params = [];
    public function __construct()
    {
        // controller
        require_once 'app/config/routes.php';
        $this->controller = $route['default_controller'];
        $url = $this->parseURL();

        if(is_null($url)){
           $url[0] = 'public';
        }

        if(file_exists('app/controller/'.$url[0].'.php')){
            $this->controller = $url[0];
            unset($url[0]);
            
        }
        // var_dump($url);
        

        require_once 'app/controller/'.$this->controller.'.php';
        $this->controller = new $this->controller;

        // method
        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
            
        }

        if(!empty($url)){
            $this->params = array_values($url);
        }

       

        // var_dump($url);
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
    
}