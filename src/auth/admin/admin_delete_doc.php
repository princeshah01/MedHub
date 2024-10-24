<?php
session_start();
include_once "../connection.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];

   

    $query = "DELETE FROM doctor WHERE id = '$doctor_id'";
    if (mysqli_query($connect, $query)) {
        header("Location: admin_Manage_doctor.php"); 
    } else {
        echo "Failed to delete the admin!";
    }
} else {
    header("Location: admin_Manage_doctor.php"); 
}
?>
