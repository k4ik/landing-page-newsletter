<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

use Controller\AuthController;
use Controller\PostController;

require './vendor/autoload.php';
require './includes/con.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$auth = new AuthController($con);
$post = new PostController($con);

if ($method == 'POST' && $path == '/signup') {
    $name = $_POST["name"];
    $email = $_POST["email"];

    $auth->signup($name, $email);
} elseif ($method == 'POST' && $path == '/login') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $auth->login($email, $password);
} elseif ($method == 'POST' && $path == '/post') {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $post->createPost($title, $content);
} else {
    http_response_code(404);
    echo "404 Not Found";
}

pg_close($con);