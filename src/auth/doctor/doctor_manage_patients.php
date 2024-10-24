<?php
session_start();

if (!isset($_SESSION['doc'])) {
    header("Location: ../../../index.php"); 
    exit();
}

include_once "../connection.php";

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

$doctor_id = $_GET['doctor_Id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedHub - Doctor | Dashboard</title>
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

        <a href="#" class="text-xl font-bold mb-6 text-center hover:text-[#8707ff] hover:underline underline-offset-4">Manage patient</a>
    </div>
  
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white rounded-lg shadow-lg text-gray-800">
        <thead>
          <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
          <th class='py-3 px-6 text-left'>Patient ID</th>
            <th class="py-3 px-6 text-left">Name</th>
            <th class="py-3 px-6 text-left">Email</th>
            <th class="py-3 px-6 text-left">Phone no.</th>
            <th class="py-3 px-6 text-left">Gender</th>
            <th class="py-3 px-6 text-left">Date of Reg</th>
            <th class="py-3 px-6 text-left">Status</th>
            
            <th class="py-3 px-6 text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="text-gray-600 text-sm">
          
          <?php 
          $query = "SELECT * FROM patient WHERE checkupwith = '{$doctor_id}'";
          $response = mysqli_query($connect, $query);

          if(mysqli_num_rows($response) < 1){
              echo "<tr><td colspan='3' class='text-center text-red-300 text-xl py-3'>No patient Found! on $doctor_id </td></tr>";
          } else {
              while($row = mysqli_fetch_array($response)) {
                  $id = $row['p_Id'];
                  $name = $row['Full_Name'];
                  $phonenum = $row['contactInfo'];
                  $email = $row['email'];
                  $gender = $row['gender'];
                  $regdate = $row['registered_date'];
                  if($row['status']){
                      $status = "<p class='text-green-500'>active</p>"; 

                  }
                  else{
                    $status = "<p class='text-red-500'>inactive</p>"; ; 

                  }
                  echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>
                          <td class='py-3 px-6 text-left'>{$id}</td>
                          <td class='py-3 px-6 text-left'>{$name}</td>
                          <td class='py-3 px-6 text-left'>{$email}</td>
                          <td class='py-3 px-6 text-left'>{$phonenum}</td>
                          <td class='py-3 px-6 text-left'>{$gender}</td>
                          <td class='py-3 px-6 text-left'>{$regdate}</td>

                          <td class='py-3 px-6 text-left'>{$status}</td>

                          <td class='py-3 px-6 text-center'>
                            <a href='admin_Eddit_doctors.php?id={$id}' class='bg-blue-500 hover:bg-blue-700 text-white px-4 py-1 rounded-md mr-2'>Edit</a>
                            <a href='viewreports.php?id={$id}' class='bg-[#20C997] hover:bg-[#008080] text-white px-4 py-1 rounded-md' onclick='return alert(\"Redirecting to reports hub :) ! \")'>View Reports</a>
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
