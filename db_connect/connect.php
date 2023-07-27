<?php
// Going to start the session so that it can store data within the browser

session_start();

// define('SITEURL', 'http://localhost/todo/');
// Connecting to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo";
$port = 4306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn) {
    echo "Connected to the db";
} else {
    echo "Database not Connected";
}
?>