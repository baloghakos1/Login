<?php
require_once 'page.php';
require_once 'tools.php';
$servername = "localhost";
$username = "root";
$password = null;
$db = "user";
$mysqli = new mysqli($servername, $username, $password, $db);
Page::head();
Page::createRegistration();
if(isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $pw2 = $_POST['pw2'];
    if($pw == $pw2) {
        if(Tools::pwIsGood($pw)) {
            $token = Tools::createToken();
            $a = "";
            $a .= $email;
            $a .= ";";
            $a .= $pw;
            $a .= ";";
            $a .= $token;
            Tools::registration($mysqli, $name, $email, $pw, $token);
            Tools::sendEmail($email,Page::emailBody($token));
            header("Location: verification.php?token=$a");
            echo "<style>
            #zold {
                color: green;
            }
            </style>";
            echo "<p id='zold'>Verification e-mail sent!<p>";
        }
        else {
            echo "<style>
            #piri {
                color: red;
            }
            </style>";
            echo "<p id='piri'>The password has to be at least 8 character long!<p>";
        }
    }
    else {
        echo "<style>
        #piri {
            color: red;
        }
        </style>";
        echo "<p id='piri'>The 2 passwords have to match!<p>";
    }
}
Page::footer();