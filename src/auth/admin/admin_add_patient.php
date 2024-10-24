<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../index.php"); 
    exit();
}

include_once "../connection.php";



if (isset($_POST['add_patient'])) {
    $name =  $_POST['name'];
    $username =  $_POST['username'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact =  $_POST['contact'];
    $address =  $_POST['address'];
    if($_POST['status']=="active"){
        $status = 1;

    }
    else{
        $status = 0 ;
    }
    $doctor = $_POST['doctor']; 

    
    $query = "INSERT INTO patient (Full_Name, Username, email, dob,checkupwith, gender, contactInfo, address, status ) 
              VALUES ('$name', '$username', '$email', '$dob','$doctor','$gender', '$contact', '$address','$status')";

    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Patient added successfully!'); window.location.href = 'admin_manage_patient.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include_once "nav_loged.php"; ?>

<div class="p-6 bg-gray-700 text-white relative top-[4rem] h-content">
    <h3 class="text-2xl font-bold mb-6 text-center">Add New Patient</h3>
    <form method="POST" class="max-w-lg mx-auto">
    
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter full name..." 
                class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Enter username..." 
                class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter email..." 
                class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" 
                class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="gender">Gender</label>
            <select name="gender" id="gender" 
                class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
                <option class="text-black" value="male">Male</option>
                <option class="text-black" value="female">Female</option>
                <option class="text-black" value="other">Other</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="contact">Contact Number</label>
            <input type="tel" name="contact" id="contact" placeholder="Enter contact number..." 
                class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="address">Address</label>
            <textarea name="address" id="address" rows="3" placeholder="Enter address..." 
                class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required></textarea>
        </div>

    
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="status">Status</label>
            <select name="status" id="status" 
                class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
                <option class="text-black" value="active">Active</option>
                <option class="text-black" value="inactive">Inactive</option>
            </select>
        </div>

    



        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="doctor">Doctors</label>
            <select name="doctor" id="doctor" 
                class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
                "<option class='text-black' value="not-selected">Select Doctor</option>
                <?php 
          $current_user = $_SESSION['admin'];
          $query = "SELECT * FROM doctor";
          $response = mysqli_query($connect, $query);

          if(TRUE)
               {
              while($row = mysqli_fetch_array($response)) {
                  $name = $row['firstname'] ." ". $row['lastname'] ;
                  $specialty = $row['specialty'];
                  $doc_id = $row['Id'];
                  echo "<option class='text-black' value='$doc_id'>$doc_id | $name | $specialty</option>";
              }
          }
          ?>
            </select>
        </div>


        <div class="text-center">
            <button type="submit" name="add_patient" 
                class="w-full mt-10 px-6 py-3 border border-[#8707ff] text-white font-semibold rounded-lg shadow hover:bg-[#8707ff] transition-all">
                Add Patient
            </button>
        </div>
    </form>
</div>

</body>
</html>
