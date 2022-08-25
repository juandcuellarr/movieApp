<?php

namespace Config;
/**
 * session
 */
class Session
{

    //iniciamos la session
    static function start()
    {
        @session_start();
    }

    //optenemos el valor de uno de los indicis de ssion
    static function getSession($name)
    {
        return $_SESSION[$name];
    }

    //Inicializamos un valor
    static function setSession($name, $data)
    {
        $_SESSION[$name] = $data;
    }


    //Destruye la sesion
    static function destroy()
    {
        @session_destroy();
        header('location:' . URL );
    }

    static function vaciar()
    {
        @session_unset();
    }
}
