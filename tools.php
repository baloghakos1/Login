<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
class Tools {
    static function dbExists($mysqli, $a) {
        $sql = "SELECT SCHEMA_NAME
        FROM INFORMATION_SCHEMA.SCHEMATA
       WHERE SCHEMA_NAME = '$a'";
       $asd = $mysqli->query($sql)->fetch_all();
       if($asd == null) {
        return false;
       } else {
        return true;
       }
    }

    static function userExist($mysqli, $email, $pw) {
        $sql = "SELECT * FROM users 
                WHERE email = '$email' AND password = '$pw'";
        $asd = $mysqli->query($sql)->fetch_all();
        if($asd == null) {
            return false;
        } else {
            return true;
        }
    }

    static function registration($mysqli, $name, $email, $pw, $token) {
        $currentDate = new DateTime('now');
        $time = ($currentDate->format('Y-m-d H:i:s'));
        $tokenTime = $currentDate->modify('+10 minutes');
        $tokenTime = $tokenTime->format('Y-m-d H:i:s');
        $sql = "INSERT INTO users (is_active, name, email, password, token, token_valid_until, created_at, registered_at, picture, deleted_at)
        VALUES ('".false."', '$name', '$email', '$pw', '$token','$tokenTime','$time','','','')
        ";
        $mysqli->query($sql);
    }

    static function tokenTimeLeft($mysqli, $email, $pw) {
        $sql = "SELECT * FROM users 
            WHERE email = '$email' AND password = '$pw'";
        $asd = $mysqli->query($sql)->fetch_all();
        $currentDate = new DateTime('now');
        $tokenTime = new DateTime($asd[0][6]);
        $diff = $tokenTime->diff($currentDate);
        $diff = $diff->format('%s');
        return $diff;
    }

    static function pwIsGood($pw) {
        $a = strlen($pw);
        if($a < 8) {
            return false;
        }
        else {
            return true;
        }
    }

    static function createToken() {
        $token = "";
        for($i = 0; $i < 6; $i++) {
            $token .= rand(0,9);
        }
        return $token;
    }

    static function sendEmail($email, $body) {
        $mail = new PHPMailer();

        try {
            $mail->isSMTP();                                           
            $mail->Host       = 'localhost';                     
            $mail->SMTPAuth   = false;                                   
            $mail->Port       = 1025;                                    


            $mail->setFrom('webpage@gmail.com'); 
            $mail->addAddress($email);

            $mail->isHTML(true);               
            $mail->Subject = 'Verification';
            $mail->Body    = $body;

            $mail->send();
        }   
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}