<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../index.php"); 
    exit();
}

include_once "../connection.php";

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php include_once "nav_loged.php"; ?>

  <div class="p-6 bg-gray-700 text-white relative top-[4rem] h-[92vh]">
    <div class="flex items-center gap-6 justify-center">

        <a href="admin_Edit_doctor.php" class="text-xl font-bold mb-6 text-center hover:text-[#8707ff] hover:underline underline-offset-4">Manage Doctors</a>
        <a href="admin_adddoc.php" class="text-xl font-bold mb-6 text-center hover:text-[#8707ff] hover:underline underline-offset-4">Add Doctors</a>
    </div>
  
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white rounded-lg shadow-lg text-gray-800">
        <thead>
          <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
          <th class="py-3 px-6 text-left">Doctor ID</th>

            <th class="py-3 px-6 text-left">Name</th>
            <th class="py-3 px-6 text-left">Username</th>
            <th class="py-3 px-6 text-left">Email</th>
            <th class="py-3 px-6 text-left">specialty</th>
            
            <th class="py-3 px-6 text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="text-gray-600 text-sm">
          
          <?php 
          $current_user = $_SESSION['admin'];
          $query = "SELECT * FROM doctor";
          $response = mysqli_query($connect, $query);
          $output = "";

          if(mysqli_num_rows($response) < 1){
              echo "<tr><td colspan='3' class='text-center text-red-300 text-xl py-3'>No Doctors Found!</td></tr>";
          } else {
              while($row = mysqli_fetch_array($response)) {
                  $id = $row['Id'];
                  $name = $row['firstname'] . $row['lastname'] ;
                  $username = $row['username'];
                  $email = $row['email'];
                  $spasticity = $row['specialty'];
                  echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>
                          <td class='py-3 px-6 text-left'>{$id}</td>

                          <td class='py-3 px-6 text-left'>{$name}</td>
                          <td class='py-3 px-6 text-left'>{$username}</td>
                          <td class='py-3 px-6 text-left'>{$email}</td>
                          <td class='py-3 px-6 text-left'>{$spasticity}</td>
                          <td class='py-3 px-6 text-center'>
                            <a href='admin_Eddit_doctors.php?id={$row['Id']}' class='bg-blue-500 hover:bg-blue-700 text-white px-4 py-1 rounded-md mr-2'>Edit</a>
                            <a href='admin_delete_doc.php?id={$row['Id']}' class='bg-red-500 hover:bg-red-700 text-white px-4 py-1 rounded-md' onclick='return confirm(\"Are you sure you want to delete this Doctor?\")'>Remove</a>
                          </td>
                        </tr>";
              }
          }
          ?>
          
        </tbody>
      </table>
    </div>
  </div>

  <script type="module" src="../../../app.js"></script>
</body>
</html>
