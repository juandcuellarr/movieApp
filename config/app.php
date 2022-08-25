<?php

define('SCT', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http');
define('URL',  SCT . '://' . $_SERVER['SERVER_NAME'] . '/' . $_ENV['URL_PROJECT']);

// define('BOOTSTRAP', getcwd().env('PATH_BOOTSTRAP'));

define('CONTROLLERS', './app/Controllers/');

define('VIEWS', __DIR__. '/../' . $_ENV['PATH_VIEWS']);
define('JS', URL . $_ENV['PATH_JS']);

function autoVersionado($url)
{
    //$path = pathinfo($url);
    $route = URL.$_ENV['PATH_JS'] . $url;
    if (file_exists($route)) {
        $versionado = '?v=' . filemtime(utf8_decode($route));
        return $route . $versionado;
    } else {
        return $route;
    }
}
