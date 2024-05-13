<?php
require_once 'page.php';
Page::showBackButton();
ini_set('memory_limit','-1');
$servername = "localhost";
$username = "root";
$password = null;
$mysqli = new mysqli($servername, $username, $password);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS User";
if ($mysqli->query($sql) === TRUE) {
  echo "<p>Adatbázis sikeresen létrehozva\n</p>";
} else {
  echo "Error creating database: " . $mysqli->error;
}
$mysqli->close();
$database = "User";
$mysqli = new mysqli($servername, $username, $password, $database);
$sql = "DROP TABLE IF EXISTS Users";
$mysqli->query( $sql );
$sql = "CREATE TABLE IF NOT EXISTS Users (
    id int AUTO_INCREMENT PRIMARY KEY,
    is_active tinyint default false,
    name varchar(50) not null,
    email varchar(25) not null unique,
    password varchar(200) not null,
    token varchar(100),
    token_valid_until datetime,
    created_at datetime default now(),
    registered_at datetime,
    picture varchar(50),
    deleted_at datetime
)";
if ($mysqli->query($sql) === TRUE) {
    echo "<p>Adattábla sikeresen létrehozva\n</p>";
} else {
    echo "Error creating Table: " . $mysqli->error;
}
?>