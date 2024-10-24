<?php
session_start();
include_once "../connection.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

   

    // Delete the admin
    $query = "DELETE FROM admin WHERE id = '$admin_id'";
    if (mysqli_query($connect, $query)) {
        header("Location: admin_manage.php"); // Redirect back to the admin list after deletion
    } else {
        echo "Failed to delete the admin!";
    }
} else {
    header("Location: admin_manage.php"); // Redirect back if no id is provided
}
?>
