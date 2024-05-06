<?php
    use Respect\Validation\Validator as v;
    use Firebase\JWT\JWT;

    if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["REQUEST_URI"] == "/login"){
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(empty($email) || empty($password)){
            echo json_encode(["error" => "Preencha os campos"]);
            return;
        }

        if(!v::email()->validate($email)) {
            echo json_encode(["error" => "Email inválido!"]);
            return;
        }

        $query = "SELECT * FROM login WHERE email='$email' AND password='$password';";

        if(!pg_query($con, $query)) {
            echo json_encode(["error" => "Algo deu errado"]);
            return;
        } else {
            if(pg_num_rows(pg_query($con, $query)) == 1) {
                $row = pg_fetch_assoc(pg_query($con, $query));
                $id = $row["id"];
                $name = $row["name"];

                $key = "398rf%gsy%gd";
                $payload = array(
                    "user_id" => $id,
                    "username" => $name
                );

                $token = JWT::encode($payload, $key, 'HS256');
                echo json_encode(["token" => $token]);
            } else {
                echo json_encode(["error" => "Usuário não encontrado"]);

            }
        }
    }