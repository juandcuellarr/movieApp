<?php

namespace Config;

use Config\Views;
use Config\Session;

class Controller
{
    protected $user_json;
    protected $movies_json;
    protected $api_movie;

    function __construct()
    {
        // Session::start();
        $this->view = new Views();
        $this->session = new Session();
        $this->session->start();
        $this->loadModels();
        $this->staticValue();
        date_default_timezone_set("America/Bogota");
    }

    function loadModels()
    {
        $model = get_class($this);
        $path = 'aap/Models/' . $model . '.php';

        if (file_exists($path)) {
            require $path;
            $this->model = new $model();
        }
    }

    public function staticValue()
    {
        $this->user_json = getcwd() . '/database/users.json';
        $this->movies_json = getcwd() . '/database/movies.json';
        $this->api_movie = 'https://www.omdbapi.com/?apiKey=fc59da33';
    }

    /*Función que valida la peticion http y el logeo*/
    function verifyAccess()
    {
        if (isset($_SESSION['username'])) {
            return json_encode(array('response' => true, 'message' => "Acceso verificado"));
        } else {
            header('location:' . URL);
            http_response_code(403);
            return false;
        }
    }

    function verifyAccessHttp()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (isset($_SESSION['username'])) {
                return true;
            } else {
                header('location:' . URL);
                http_response_code(403);
                return false;
            }
        } else {
            header('location:' . URL . 'Movie/index');
        }
    }

    /*Función para renderizar vistas*/
    function renderView($view = false)
    {
        $controller_class = str_replace("controller", "", strtolower(get_class($this)));
        if (!$view) {
            $view = strtolower($controller_class);
        }

        if (!empty($this->session->getSession('username'))) {
            $this->view->render($this, $view);
        } else {
            header('location:' . URL);
        }
    }
}
