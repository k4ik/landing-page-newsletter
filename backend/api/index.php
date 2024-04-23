<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");

    require './vendor/autoload.php';
    require './vendor/includes/conn.php';
    require './vendor/includes/mailer.php';

    $method = $_SERVER['REQUEST_METHOD'];
    $path = $_SERVER['REQUEST_URI'];

    if ($method == 'POST' && $path == '/signup') {
        include './controllers/SignUpController.php';
    } elseif ($method == 'POST' && $path == '/login') {
        include './controllers/LoginController.php';
    } elseif($method == 'POST' && $path == '/post'){
        include './controllers/PostController.php';
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }
