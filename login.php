<?php
session_start();
require_once 'page.php';
require_once 'tools.php';
$servername = "localhost";
$username = "root";
$password = null;
$db = "user";
$mysqli = new mysqli($servername, $username, $password, $db);
Page::head();
Page::createLogin();
Page::footer();
if($_SESSION['email'] != null) {
    header("Location: success.php");
}
else {
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $password = $_POST['pw'];
        $hash = tools::getPwByEmail($mysqli, $email)[0][0];
        if(Tools::userExist($mysqli,$email,$password, $hash)) {
            if(Tools::isActive($mysqli,$email)) {
                $_SESSION['email'] = $email;
                header("Location: success.php");
            }
            else {
                echo "<style>
                #piri {
                    color: red;
                }
                </style>";
                echo "<p id='piri'>Unsuccessful login!<p>";
            }
        }
        else {
            echo "<style>
            #piri {
                color: red;
            }
            </style>";
            echo "<p id='piri'>Unsuccessful login!<p>";
        }
    }  
}