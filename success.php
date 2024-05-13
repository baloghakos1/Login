<?php
$servername = "localhost";
$username = "root";
$password = null;
$db = "user";
$mysqli = new mysqli($servername, $username, $password, $db);
require_once 'tools.php';
require_once 'page.php';
session_start();
Page::head();
echo '<h1>Succesfull login</h1>';
echo '<h3>Welcome ' . Tools::getNameByEmail($mysqli ,$_SESSION['email'])[0][0] .'<h3>';
Page::logoutButton();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['email'] = null;
    header("Location: login.php");
}
Page::footer();