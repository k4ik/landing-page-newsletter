<?php
namespace Controller;

use Respect\Validation\Validator as v;
use Controller\TokenController;
use Controller\MailerController;

require __DIR__ . '/../includes/con.php';

class AuthController
{
    private $dbconn;

    public function __construct($dbconn)
    {
        $this->con = $dbconn;
    }

    public function login($name = null, $email = null, $password)
    {
        if (empty($password)) {
            http_response_code(400);
            echo json_encode(["error" => "Fill in all fields!"]);
            return;
        }

        if ($email) {
            if (!v::email()->validate($email)) {
                http_response_code(400);
                echo json_encode(["error" => "Invalid E-mail!"]);
                return;
            }

            $query  = "SELECT * FROM newsletter_owners WHERE email = $1 AND password = $2;";
            $params =  [$email, $password];
        } elseif ($name) {
            $query  = "SELECT * FROM newsletter_owners WHERE name = $1 AND password = $2;";
            $params = [$name, $password];
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Name or email is required!"]);
            return;
        }

        $result = pg_query_params($this->con, $query, $params);

        if ($result && pg_num_rows($result) == 1) {
            $row   = pg_fetch_assoc($result);
            $token = new TokenController();
            $token->generateToken($row["id"], $row["name"], $row["email"]);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "User not found. Try again!"]);
        }
    }

    public function signup($name, $email)
    {
        if (empty($name) || empty($email)) {
            http_response_code(400);
            echo json_encode(["error" => "Fill in all fields!"]);
            return;
        }
    
        if (!v::email()->validate($email)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid E-mail!"]);
            return;
        }

        $query  = "SELECT * FROM newsletter_members WHERE email = $1;";
        $result = pg_query_params($this->con, $query, [$email]);

        if ($result && pg_num_rows($result) == 1) {
            http_response_code(409);
            echo json_encode(["error" => "This email has already been registered!"]);
            return;
        }

        $query2 = "INSERT INTO newsletter_members (name, email) VALUES ($1, $2);";
        $insert = pg_query_params($this->con, $query2, [$name, $email]);

        if (!$insert) {
            http_response_code(500);
            echo json_encode(["error" => "Something went wrong!"]);
        } else {
            $mailer = new MailerController();
            $mailer->confirmSignup($email, $name);
        }
    }
}
