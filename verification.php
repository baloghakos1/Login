<?php
require_once 'page.php';
require_once 'tools.php';
$servername = "localhost";
$username = "root";
$password = null;
$db = "user";
$mysqli = new mysqli($servername, $username, $password, $db);
Page::head();
Page::createVerification();
$ok = $_GET['token'];
$stuff = explode(";", $ok);
$email = $stuff[0];
$pw = $stuff[1];
$token = $stuff[2];
if(isset($_POST['num'])) {
    $a = Tools::tokenTimeLeft($mysqli,$email,$pw);
    if(intval($a) > 0) {
        $num = $_POST['num'];
        if(intval($num) == intval($token)) {
            //Update the database, remove token stuff, register time, is_active true,
            echo "<style>
            #zold {
                color: green;
            }
            </style>";
            echo "<p id='zold'>Successfull Registration!</p>";
        }
        else {
            echo "<style>
            #piri {
                color: red;
            }
            </style>";
            echo "<p id='zold'>Incorrect token!</p>";
        }
    }
    else {
        echo "The token time ran out.\n
        Click here to send a new e-mail: ";//: Gomb ami újra küldi az e-mailt

    }
}
Page::footer();