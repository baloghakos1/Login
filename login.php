<?php
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
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['pw'];
    if(Tools::userExist($mysqli,$email,$password)) {
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