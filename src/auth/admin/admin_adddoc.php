<?php
session_start();
include_once "../connection.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../index.php");
    exit();
}

if (isset($_POST['add_admin'])) {
    $Firstname = $_POST['fname'];
    $Lastname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $country = $_POST['con'];
    $Phoneno = $_POST['mobile'];
    $Specialty = $_POST['sep'];

    $query = "INSERT INTO doctor (firstname, lastname, username, email, password, gender, country, phonenumber, specialty) 
              VALUES ('$Firstname', '$Lastname', '$username', '$email', '$password', '$gender', '$country', '$Phoneno', '$Specialty')";

    if (mysqli_query($connect, $query)) {
        header("Location: admin_Manage_doctor.php"); 
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include_once "nav_loged.php" ?>

<div class="p-6 bg-gray-700 text-white relative top-[4rem] h-content">
    <h3 class="text-2xl font-bold mb-6 text-center">Add New Doctor</h3>
    <form method="POST" class="max-w-lg mx-auto">
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="fname">First Name</label>
            <input type="text" name="fname" id="fname" placeholder="Enter first name..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" placeholder="Enter last name..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Enter username..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter Email..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="gender">Gender</label>
            <select name="gender" id="gender" class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
                <option class="text-black" value="male">maard</option>
                <option class="text-black" value="female">mahila</option>
                <option class="text-black" value="other">Hizra</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="con">Country</label>
            <input type="text" name="con" id="con" placeholder="Enter country..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="mobile">Phone Number</label>
            <input type="text" name="mobile" id="mobile" placeholder="Enter phone number..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="sep">Specialty</label>
            <input type="text" name="sep" id="sep" placeholder="Enter specialty..." class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none">
        </div>

        <div class="text-center">
            <button type="submit" name="add_admin" class="w-full mt-10 px-6 py-3 border border-[#8707ff] text-white font-semibold rounded-lg shadow hover:bg-[#8707ff] transition-all">Add Doctor</button>
        </div>
    </form>
</div>
</body>
</html>
