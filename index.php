<?php

require __DIR__.'/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ );
$dotenv->load();

require __DIR__.'/config/app.php';


$url = isset($_GET["url"]) ? $_GET["url"] : "Login/index";
$url = explode("/", $url);


$controller = '';
$method = '';
$params = '';

if (isset($url[0])) {
    $controller = "$url[0]Controller";
}
if (isset($url[1])) {
    if ($url[1] != ' ') {
        $method = $url[1];
    }
}

if (isset($url[2])) {
    if ($url[1] != ' ') {
        $params = $url[2];
    }
}




$controllersPath = CONTROLLERS . $controller . '.php';
// print($controllersPath);
// print($_SESSION['username']);

if (file_exists($controllersPath)) {
    require $controllersPath;

    $controller = new $controller();

    if (isset($method)) {
        if (method_exists($controller, $method)) {
            if (isset($params)) {
                $controller->{$method}($params);
            } else {
                $controller->{$method}();
            }
        } else {
            echo "Error no existe el method";
        }
    }
} else {
    echo "Error en la dirección el controlador no existe";
}
