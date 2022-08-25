<?php

namespace Config;

class Views
{

    function __construct()
    {
    }

    //metodo que ejecutara las vistas
    function render($controller, $view)
    {
        //get_class devuelve el nombre de la clase del objeto
        $controllers = str_replace("controller", "", strtolower(get_class($controller)));
        require VIEWS . 'header.php';
        
        require VIEWS . $controllers . '/' . $view . '.php';
        require VIEWS . 'footer.php';
    }

    //metodo que ejecutara las vistas
    function renderProtected($controller, $view)
    {
        if (!empty($controller->session->getSession('username'))) {
            $this->render($controller, $view);
        } else {
            header('location:' . URL );
        }
    }
}
