<?php
session_start();


if (!isset($_SESSION['patient'])) {
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
    <title>Patient | Dashboard</title>
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
  
  <section id="admin_dashboard" class="h-screen bg-cover bg-center w-full z-10 bg-gray-800 w-[100%]">
  <div
    class="container mx-auto h-full flex flex-col justify-center items-center text-center max-w-screen-lg px-4"
  >
    <h1 class="text-3xl md:text-6xl font-bold">
      
      <span
        class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 bg-clip-text text-transparent"
        >patient pannel</span
      >
      
    </h1>
    
  </div>
</section>


  <script type="module" src="../../../app.js"></script>
</body>
</html>
