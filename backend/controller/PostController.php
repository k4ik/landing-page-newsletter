<?php
namespace Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PostController
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../'); 
        $dotenv->load();
    }

    public function createPost($title, $content)
    {
        if (empty($title) || empty($content)) {
            echo json_encode(["error" => "Preencha os campos"]);
            return;
        }

        $rows = $this->getEmails();
        $author = $this->getAuthor();
        $mail = new PHPMailer(true);

        foreach ($rows as $row) {
            $mail->addAddress(trim($row['email']));
        }

        try {
            $mail->isSMTP();
            $mail->Host       = getenv('SMTP_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = getenv('SMTP_USERNAME');
            $mail->Password   = getenv('SMTP_PASSWORD');
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = getenv('SMTP_PORT');

            $mail->setFrom("ajsjhsagwha@gmail.com", "Newsletter");
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "=?UTF-8?B?" . base64_encode("$title") . "?=";
            $mail->Body = "<h1>$title</h1>";
            $mail->Body .= "<pre>$content</pre>";
            $mail->Body .= "<br><br><p>Publicado por ". $author ."</p>";

            $mail->send();
            echo json_encode(["success" => "Post publicado com sucesso!"]);
        } catch (Exception $e) {
            echo json_encode(["error" => "Erro ao tentar publicar o post!"]);
        }
    }

    public function getEmails() 
    {
        $query = "SELECT email FROM newsletter";
        $emails = pg_fetch_all(pg_query($this->con, $query));
        return $emails;
    }

    public function getAuthor()
    {
        session_start();
        $author = $_SESSION["author"];
        return $author;
    }
}
