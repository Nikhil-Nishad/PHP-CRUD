<?php
//  File to Connect to MYSQL Database  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$servername = "localhost";
$username = "root";
$password = "";
$db = "phpPractice";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
