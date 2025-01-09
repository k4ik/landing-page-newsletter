<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

use Controller\AuthController;
use Controller\PostController;
use Controller\MembersController;
use Controller\OwnersController;

require './vendor/autoload.php';
require './includes/con.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$authController = new AuthController($con);
$postController = new PostController($con);
$membersController = new MembersController($con);
$ownersController = new OwnersController($con);

switch($method) {
    case 'POST':
        if($path == '/api/signup') {
            $name = $_POST["name"];
            $email = $_POST["email"];
        
            $authController->signup($name, $email);
        }

        if($path == '/api/login') {
            $email = $_POST["email"];
            $password = $_POST["password"];
        
            $authController->login($email, $password);
        }

        if($path == '/api/post') {
            $title = $_POST["title"];
            $content = $_POST["content"];
        
            $postController->createPost($title, $content);
        }

        if($path == '/api/owner') {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $ownersController->addOwner($email, $password);
        }
        break;
    case 'GET':
        if($path == '/api/members') {
            $membersController->getNewsletterMembers();
        }

        if($path == '/api/owners') {
            $ownersController->getNewsletterOwners();
        }

        if($path == '/api/posts') {
            $postController-> getPosts();
        }
        break;
    case 'DELETE':
        if($path == '/api/owner/'.$id) {
            $ownersController->deleteOwner($id);
        }

        if($path == '/api/member/'.$id) {
            $membersController->deleteMember($id);
        }
    default:
        http_response_code(404);
        echo "404 Not Found";
}

pg_close($con);