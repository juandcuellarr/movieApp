<?php

// namespace App\Controllers;

// error_reporting(E_ALL ^ E_NOTICE);

use Config\Controller;

class MovieController extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->verifyAccess();
    }

    public function index()
    {
        $this->renderView();
    }

    public function baseList()
    {
        if ($this->verifyAccessHttp()) {
            $api_movies = json_decode(file_get_contents("$this->api_movie&s=avengers"))->Search;

            file_put_contents($this->movies_json, json_encode($api_movies));

            echo $this->createHtmlResponse($api_movies);
        }
    }

    public function search()
    {
        if ($this->verifyAccessHttp()) {
            list("title" => $title, "start_date" => $start_date, "end_date" => $end_date, "order" => $order, "orderby" => $orderby) = $_POST;

            $title = preg_replace("/\s/", "", $title);
            if (empty($title)) {
                echo "The field title is required.";
                http_response_code(422);
                return false;
            }

            $url = "$this->api_movie&s=$title";

            $api_movies = [];

            if (!empty($start_date) && !empty($end_date)) {
                for ($i = $start_date; $i <= $end_date; $i++) {
                    $url_range = "$url&y=$i";
                    $api_movies_range = json_decode(file_get_contents($url_range))->Search;
                    $api_movies = array_merge($api_movies, $api_movies_range);
                }
            } elseif (!empty($start_date)) {
                $url .= "&y=$start_date";
                $api_movies = json_decode(file_get_contents($url))->Search;
            } else {
                $api_movies = json_decode(file_get_contents($url))->Search;
            }


            file_put_contents($this->movies_json, json_encode($api_movies));

            usort($api_movies, function ($a, $b) use ($orderby) {
                return $a->$orderby <=> $b->$orderby;
            });

            if ($order == 'Desc') {
                $api_movies = array_reverse($api_movies, true);
            }

            echo $this->createHtmlResponse($api_movies);
        }
    }

    public function createHtmlResponse($movies)
    {
        $response = '';

        foreach ($movies as $movie) {
            $response .= "<tr>
                <td>$movie->Title</td>
                <td>$movie->Year</td>
                <td>$movie->Type</td>
                <td><img src='$movie->Poster' ></td>
            </tr>";
        }
        return $response;
    }
}
