<?php
session_start(); 
include_once "connection.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $query = "INSERT INTO emails (email) VALUES ('$email')";

    mysqli_query($connect, $query); 
   

    mysqli_close($connect);

    header("Location: ../../index.php");
    exit();
}
?>
