<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Jakarta');

$servername = "sql300.infinityfree.com";
$username = "if0_40861238";
$password = "uyz0VfqTbCwpl5";
$db = "if0_40861238_flowerdreams";

// create connection
$conn = new mysqli($servername, $username, $password, $db);

// check connection
if($conn->connect_error){
    die("connection failed :" . $conn->connect_error);
}
?>