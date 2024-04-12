<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require '../vendor/autoload.php';
require '../vendor/includes/conn.php';
require '../vendor/includes/mailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    if (empty($title) || empty($content)) {
        echo "Preencha os campos";
        return;
    }

    $query = "SELECT email FROM users";
    $check_result = pg_query($con, $query);
    if (!$check_result) {
        echo "Algo deu errado";
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
            echo "Post publicado com sucesso!";
        } catch (Exception $e) {
            echo "Erro ao tentar enviar o email: {$mail->ErrorInfo}";
        }
    }
}
