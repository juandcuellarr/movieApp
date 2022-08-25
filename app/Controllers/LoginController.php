<?php

// namespace App\Controllers;

// error_reporting(E_ALL ^ E_NOTICE);

use Config\Controller;

class LoginController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render($this, 'login');
    }

    public function register()
    {
        $this->view->render($this, 'register');
    }

    public function store()
    {

        $validations = [];

        list("username" => $username, "phone" => $phone, "email" => $email, "password" => $password) = $_POST;

        $username = preg_replace("/\s/", "", $username);
        if (empty($username)) {
            $validations[] = 'The field username is required';
        }

        if (!preg_match("/^[a-z]+$/i", $username)) {
            $validations[] = 'The field username must only contain letters';
        }

        $email = preg_replace("/\s/", "", $email);
        if (empty($email)) {
            $validations[] = 'The field email is required.';
        }

        if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$/i", $email)) {
            $validations[] = 'The field email must be a valid email, e.g., username@example.com';
        }

        if (!preg_match("/^[+]+[0-9]{9}/", $phone)) {
            $validations[] = 'The field phone must be a format';
        }

        if (strlen($password) < 6) {
            $validations[] = 'The field password must have at least 6 characters';
        }
        if (!preg_match("/[\*\-\.]/", $password)) {
            $validations[] = 'The field password contains an illegal special character';
        }

        $users = json_decode(file_get_contents($this->user_json));
        $found = array_search($username, array_column($users, 'username'));

        if (is_int($found)) {
            $validations[] = 'The username is being used';
        }

        // var_dump($validations);

        if (empty($validations)) {

            $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $users = !empty($users) ? array_filter($users) : $users;
            if (!empty($users)) {
                array_push($users, $_POST);
            } else {
                $users[] = $_POST;
            }

            file_put_contents($this->user_json, json_encode($users));

            header('location:' . URL);
        } else {
            $errors = json_encode($validations);
            echo $errors;
            http_response_code(422);
            header('location:' . URL . "Login/register?errors=$errors");
        }

        // var_dump($insert);
    }

    public function login()
    {

        $validations = [];

        list("username" => $username, "password" => $password) = $_POST;


        $users = json_decode(file_get_contents($this->user_json));
        $found = array_search($username, array_column($users, 'username'));

        if (is_bool($found)) {
            $validations[] = 'The username is not registered';
        } else {
            if (!password_verify($password, $users[$found]->password)) {
                $validations[] = 'The password is wrong';
            }
        }

        if (empty($validations)) {
            $this->session->setSession('username', $username);
            $_SESSION['username'] = $username;
            header('location:' . URL . 'Movie/index');
        } else {
            $errors = json_encode($validations);
            echo $errors;
            http_response_code(422);
            header('location:' . URL . "?errors=$errors");
        }
    }
}
