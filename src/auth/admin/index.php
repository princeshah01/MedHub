<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../index.php"); // Redirect to login page if not logged in
    exit();
}

include_once "../connection.php";



// Prevent caching to block back button after logout
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedHub - Admin | Dashboard</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
</head>
<body>
  
  
  <?php include_once "nav_loged.php"; ?>
  <?php include_once "main.php";?>
  <script type="module" src="../../../app.js"></script>
  <script>
       // Select the toggle button and the dropdown menu
       const settingsToggle = document.getElementById('settingsToggle');
    const settingsMenu = document.getElementById('settingsMenu');

    // Add a click event listener to toggle visibility of the settings menu
    settingsToggle.addEventListener('click', function() {
        settingsMenu.classList.toggle('hidden'); // Toggle the 'hidden' class
    });
  </script>
  </body>
</html>