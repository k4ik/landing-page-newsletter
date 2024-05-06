<?php
use Respect\Validation\Validator as v;
use Firebase\JWT\JWT;

class LoginController
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function auth($email, $password)
    {
        if (empty($email) || empty($password)) {
            echo json_encode(["error" => "Preencha os campos"]);
            return;
        }

        if (!v::email()->validate($email)) {
            echo json_encode(["error" => "Email inválido!"]);
            return;
        }

        $query = "SELECT * FROM login WHERE email='$email' AND password='$password';";

        if (!pg_query($this->con, $query)) {
            echo json_encode(["error" => "Algo deu errado"]);
            return;
        } else {
            if (pg_num_rows(pg_query($this->con, $query)) == 1) {
                $row = pg_fetch_assoc(pg_query($this->con, $query));
                $id = $row["id"];
                $name = $row["name"];

                $this->token($id, $name);
            } else {
                echo json_encode(["error" => "Usuário não encontrado"]);
            }
        }
    }

    public function token($id, $name)
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["REQUEST_URI"] == "/login") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $auth = new LoginController($con);
    $auth->auth($email, $password);
}