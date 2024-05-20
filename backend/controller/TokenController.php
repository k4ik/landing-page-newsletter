<?php
namespace Controller;

use Firebase\JWT\JWT;

class TokenController
{
    public function generateToken($id, $name)
    {
        $key = "398rf%gsy%gd";
        $payload = array(
            "user_id" => $id,
            "username" => $name
        );

        $token = JWT::encode($payload, $key, 'HS256');
        echo json_encode(["token" => $token]);
    }
}