<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    
    require '../vendor/autoload.php';
    require '../vendor/includes/conn.php';

    use Respect\Validation\Validator as v;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(empty($email) || empty($password)){
            echo "Preencha os campos!";
            return;
        }

        if(!v::email()->validate($email)) {
            echo "Email inválido!";
            return;
        }

        $query = "SELECT * FROM login WHERE email='$email' AND password='$password';";
        if(!pg_query($con, $query)) {
            echo "Algo deu errado!";
            return;
        } else {
            if(pg_num_rows(pg_query($con, $query)) == 1) {
                echo "Logado com sucesso!";
            } else {
                echo "Usuário não encontrado!";
            }
        }
    }