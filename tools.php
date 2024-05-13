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

    static function userExist($mysqli, $email, $pw, $hash) {
        $sql = "SELECT * FROM users 
                WHERE email = '$email' AND ". password_verify($pw, $hash). "";
        $asd = $mysqli->query($sql)->fetch_all();
        if($asd == null) {
            return false;
        } else {
            return true;
        }
    }

    static function isActive($mysqli, $a) {
        $sql = "SELECT is_active From users WHERE email = '$a'";
        $asd = $mysqli->query($sql)->fetch_all();
        if($asd[0][0] == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    static function registration($mysqli, $name, $email, $pw, $token) {
        $currentDate = new DateTime('now');
        $time = ($currentDate->format('Y-m-d H:i:s'));
        $tokenTime = $currentDate->modify('+10 minutes');
        $tokenTime = $tokenTime->format('Y-m-d H:i:s');
        $sql = "INSERT INTO users (is_active, name, email, password, token, token_valid_until, created_at, registered_at, picture, deleted_at)
        VALUES ('".false."', '$name', '$email', '". password_hash($pw, PASSWORD_DEFAULT) . "', '$token','$tokenTime','$time','','','')
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

    static function updateVerif($mysqli, $vmi) {
        $currentDate = new DateTime('now');
        $time = ($currentDate->format('Y-m-d H:i:s'));
        $sql = "UPDATE users set token=0, token_valid_until=0, is_active=1, registered_at='$time' WHERE name ='$vmi'";
        $mysqli->query($sql);
    }

    static function getNameByEmail($mysqli, $email) {
        $sql = "SELECT name FROM users WHERE email='$email'";
        return $mysqli->query($sql)->fetch_all();
    }

    static function getByToken($mysqli, $token) {
        $sql = "SELECT * FROM users WHERE token='$token'";
        return $mysqli->query($sql)->fetch_all();
    }

    static function getPwByEmail($mysqli, $email) {
        $sql = "SELECT password FROM users WHERE email='$email'";
        return $mysqli->query($sql)->fetch_all();
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