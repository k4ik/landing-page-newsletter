<?php
namespace Controller;

use Firebase\JWT\JWT;

class TokenController
{
    public function generateToken($id, $name, $email)
    {
        $key = "398rf%gsy%hghwhw7772282zzy7z78zczzgzzczychz7cz7czczbcuzncuizhcuyizncyu8c89duay8faoagd";
        $payload = [
            "user_id"  => $id,
            "username" => $name,
            "email"    => $email
        ];

        $token = JWT::encode($payload, $key, 'HS256');
        echo json_encode(["token" => $token]);
    }
}
