<?php
namespace Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailerController
{
    public function __construct()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->load();
    }

    public function confirmSignup($email, $name)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = getenv('SMTP_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = getenv('SMTP_USERNAME');
            $mail->Password   = getenv('SMTP_PASSWORD');
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = getenv('SMTP_PORT');

            $mail->setFrom("ajsjhsagwha@gmail.com", "Newsletter");
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "=?UTF-8?B?" . base64_encode("Thank you for subscribing to our newsletter!") . "?=";
            $mail->Body    = "<p>Dear $name,</p>";
            $mail->Body .= "<p>On behalf of the entire team, we would like to thank you for subscribing to our newsletter. It's great to have you on board, and we hope you enjoy the content and updates we will share.</p>";
            $mail->Body .= "<p>Our newsletter is a way to keep in touch and share relevant information about technology, as well as exclusive promotions and updates about our products/services.</p>";
            $mail->Body .= "<p>Feel free to send us suggestions, questions, or feedback at any time. We're here to help and improve your experience with us.</p>";
            $mail->Body .= "<p>Thank you once again for joining us. We hope our newsletter will be useful and interesting for you.</p><br>";
            $mail->Body .= "<p>Best regards,<br>Newsletter.</p>";

            $mail->send();
            echo json_encode(["success" => "Check your email inbox!"]);
        } catch (Exception $e) {
            echo json_encode(["error" => "Error when trying to send the email!"]);
        }
    }
}
