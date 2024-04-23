<?php
    use Respect\Validation\Validator as v;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["REQUEST_URI"] == "/signup") {
        $name = $_POST["name"];
        $email = $_POST["email"];

        if(empty($name) || empty($email)) {
            echo "Preencha os campos!";
            return;
        }

        if(!v::email()->validate($email)) {
            echo "Email inválido!";
            return;
        }

        $query = "SELECT * FROM users WHERE email='$email';";
        $check_result = pg_query($con, $query);

        if(pg_num_rows($check_result) == 1) {
            echo "Esse email já foi cadastrado";
            return;
        }

        $query2 = "INSERT INTO users(name, email) VALUES('$name','$email');";
        $check_result2 = pg_query($con, $query2);

        if(!$check_result2) {
            echo "Algo deu errado! Tente novamente";
        } else {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = SMTP_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = SMTP_USERNAME;
                $mail->Password   = SMTP_PASSWORD;
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = SMTP_PORT;
    
                $mail->setFrom("ajsjhsagwha@gmail.com", "Support Team");
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = "=?UTF-8?B?" . base64_encode("Obrigado por se inscrever na nossa newsletter!") . "?=";
                $mail->Body = "<p>Prezado(a) $name,</p>";
                $mail->Body .= "<p>Em nome de toda a equipe, gostaríamos de agradecer por se inscrever na nossa newsletter. É ótimo ter você a bordo e esperamos que aproveite os conteúdos e novidades que iremos compartilhar.</p>";
                $mail->Body .= "<p>Nossa newsletter é uma forma de mantermos contato e compartilharmos informações relevantes sobre tecnologia, além de promoções exclusivas e atualizações sobre nossos produtos/serviços.</p>";
                $mail->Body .= "<p>Fique à vontade para nos enviar sugestões, dúvidas ou feedback a qualquer momento. Estamos aqui para ajudar e melhorar a sua experiência conosco.</p>";
                $mail->Body .= "<p>Obrigado(a) mais uma vez por se juntar a nós. Esperamos que nossa newsletter seja útil e interessante para você.</p><br>";
                $mail->Body .= "<p>Atenciosamente,<br>Newsletter.</p>";
    
                $mail->send();
                echo "Olhe sua caixa de email!";
            } catch (Exception $e) {
                echo "Erro ao tentar enviar o email: {$mail->ErrorInfo}";
            }
        }
        pg_close($con);
    }
