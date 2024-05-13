<?php
require_once 'page.php';
require_once 'tools.php';
Page::head();
$servername = "localhost";
$username = "root";
$password = null;
$mysqli = new mysqli($servername, $username, $password);
$db = Tools::dbExists($mysqli, "User");
if(!$db) {
    Page::showCreateDatabaseButton();
}
else {
    Page::showLoginButton();
}
Page::footer();