<?php

class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = [];
        $url = $this->parseURL();

        if ($url != null) {

            if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }

        if (!isset($_SESSION['login'])) {
            $this->controller = 'login';
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        if (!empty($url)) {
            $this->params = array_values($url);
        }

        //jalankan controller dan method, kirimkan paramas jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); //menghilngkan simbol "/" di akhir url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}