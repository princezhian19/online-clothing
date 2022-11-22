<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
class signup extends connection
{
    protected function checkUser($username)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE username = ?;');
        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        $result = "";
        if ($stmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    protected function checkEmail($email)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = ?;');
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        $result = "";
        if ($stmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    protected function signUp($username, $email, $password,$firstname,$lastname)
    {

        $mail = new PHPMailer(true);
        try {
            //Enable verbose debug output
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;

            //Send using SMTP
            $mail->isSMTP();

            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';

            //Enable SMTP authentication
            $mail->SMTPAuth = true;

            //SMTP username
            $mail->Username = 'nathanielrabacals@gmail.com';

            //SMTP password
            $mail->Password = 'mtzdlywbzelspbwr';

            //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('nathanielrabacals@gmail.com', 'GraphiteeShirt');

            //Add a recipient
            $mail->addAddress($email, $username);

            //Set email format to HTML
            $mail->isHTML(true);

            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';


            // echo 'Message has been sent';

            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

            // insert in users table
            $stmt = $this->connect()->prepare('INSERT INTO users (username,email,password,verification_code,verified_at,firstname,lastname) VALUES (?,?,?,' . $verification_code . ', NULL,?,?);');
            if (!$stmt->execute(array($username, $email, $password,$firstname,$lastname))) {
                $stmt = null;
                header("Location: index.php?error=stmtfailed");
                exit();
            }
            $mail->send();
            header("Location: ../index.php?email=" . $email);
            exit();

            




        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
