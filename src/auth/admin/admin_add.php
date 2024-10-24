<?php
session_start();
include_once "../../connection.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../../index.php");
    exit();
}

// Insert new admin
if (isset($_POST['add_admin'])) {
    $username =  $_POST['username'];
    $email = $_POST['email'];
    $password =  $_POST['password'];
    
    // Insert the admin with plain text password (not recommended for production)
    $query = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if (mysqli_query($connect, $query)) {
        header("Location: admin_manage.php"); // Redirect back to admin list after adding
    } else {
        echo "Failed to add new admin!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Admin</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<?php include_once "nav_loged.php"?>

  <div class="p-6 bg-gray-700 text-white relative top-[4rem] h-[92vh]">
    <h3 class="text-2xl font-bold mb-6 text-center">Add New Admin</h3>
    <form method="POST" class="max-w-lg mx-auto">
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Enter username..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md  focus:ring-0 focus:outline-none" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter Email..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md  focus:ring-0 focus:outline-none" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter pAssword..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md  focus:ring-0 focus:outline-none" required>
        </div>
        <div class="text-center">
            <button type="submit"  name="add_admin" class="w-full mt-10 px-6 py-3 border border-[#8707ff] text-white font-semibold rounded-lg shadow hover:bg-[#8707ff] transition-all">Add Admin</button>
        </div>
    </form>
  </div>
</body>
</html>
