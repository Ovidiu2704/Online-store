<?php

$server_name= "localhost";
$user = "root";
$pass = "";
$db_name = "magazinonline";

$conn = new mysqli($server_name, $user, $pass, $db_name);

if ($conn->connect_errno) {
    die($conn->connect_error);
}

// echo "<pre>";
// var_dump($conn);
