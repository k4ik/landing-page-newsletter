<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PostController
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function createPost($title, $content)
    {
        if (empty($title) || empty($content)) {
            echo json_encode(["error" => "Preencha os campos"]);
            return;
        }

        $query = "SELECT email FROM users";
        $check_result = pg_query($this->con, $query);

        if (!$check_result) {
            echo json_encode(["error" => "Algo deu errado"]);
            return;
        } else {
            $rows = pg_fetch_all($check_result);
            $mail = new PHPMailer(true);

            foreach ($rows as $row) {
                $mail->addAddress(trim($row['email']));
            }

            try {
                $mail->isSMTP();
                $mail->Host       = SMTP_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = SMTP_USERNAME;
                $mail->Password   = SMTP_PASSWORD;
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = SMTP_PORT;

                $mail->setFrom("ajsjhsagwha@gmail.com", "Newsletter");
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = "=?UTF-8?B?" . base64_encode("$title") . "?=";
                $mail->Body = "<h1>$title</h1>";
                $mail->Body .= "<pre>$content</pre>";

                $mail->send();
                echo json_encode(["success" => "Post publicado com sucesso!"]);
            } catch (Exception $e) {
                echo json_encode(["error" => "Erro ao tentar enviar o email"]);
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["REQUEST_URI"] == "/post") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $post = new PostController($con);
    $post->createPost($title, $content);
}
