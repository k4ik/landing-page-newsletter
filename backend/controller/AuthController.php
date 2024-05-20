<?php 
namespace Controller;

use Respect\Validation\Validator as v;
use Controller\TokenController;
use Controller\MailerController;

class AuthController
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function login($email, $password)
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

                $token = new TokenController();
                $token->generateToken($id, $name);
            } else {
                echo json_encode(["error" => "Usuário não encontrado"]);
            }
        }
    }

    public function signup($name, $email)
    {
        if (empty($name) || empty($email)) {
            echo json_encode(["error" => "Preencha os campos"]);
            return;
        }
    
        if (!v::email()->validate($email)) {
            echo json_encode(["error" => "Email inválido"]);
            return;
        }
    
        $query = "SELECT * FROM users WHERE email='$email';";
        $check_result = pg_query($this->con, $query);
    
        if (pg_num_rows($check_result) == 1) {
            echo json_encode(["error" => "Esse email já foi cadastrado"]);
            return;
        }
    
        $query2 = "INSERT INTO users(name, email) VALUES('$name','$email');";
        $check_result2 = pg_query($this->con, $query2);
    
        if (!$check_result2) {
            echo json_encode(["error" => "Algo deu errado"]);
        } else {
            $mailer = new MailerController();
            $mailer->confirmSignup($email, $name);
        }
    }
}