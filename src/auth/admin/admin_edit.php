<?php
session_start();
include_once "../connection.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../index.php");
    exit();
}

// Fetch admin details to edit
if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];
    $query = "SELECT * FROM admin WHERE id = '$admin_id'";
    $response = mysqli_query($connect, $query);
    $admin_data = mysqli_fetch_assoc($response);
    
    if (!$admin_data) {
        echo "Admin not found!";
        exit();
    }
}

// Update admin details
if (isset($_POST['update'])) {
    $username =  $_POST['username'];
    $email = $_POST['email'];
    
    $query = "UPDATE admin SET username = '$username', email = '$email' WHERE id = '$admin_id'";
    if (mysqli_query($connect, $query)) {
        header("Location: admin_manage.php"); // Redirect back to admin list after update
    } else {
        echo "Failed to update admin details!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
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
  <div class="p-6 bg-gray-700 text-white relative top-[4rem] h-screen">
    <h3 class="text-2xl font-bold mb-6 text-center">Edit Admin</h3>
    <form method="POST" class="max-w-lg mx-auto">
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo $admin_data['username']; ?>" class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md  focus:ring-0 focus:outline-none" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $admin_data['Email']; ?>" class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md  focus:ring-0 focus:outline-none" required>
        </div>
        <div class="text-center">
            <button type="submit"  name="update" class="w-full mt-10 px-6 py-3 border border-[#8707ff] text-white font-semibold rounded-lg shadow hover:bg-[#8707ff] transition-all">Update Admin</button>
        </div>
    </form>
  </div>
</body>
</html>
