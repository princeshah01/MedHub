<?php
session_start();
include_once "../connection.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../index.php");
    exit();
}

// Fetch doctor details based on ID
if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];
    $query = "SELECT * FROM doctor WHERE Id = $doctor_id";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $doctor = mysqli_fetch_assoc($result);
    } else {
        echo "Doctor not found!";
        exit();
    }
}

// Update doctor details
if (isset($_POST['update_doctor'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $specialty = $_POST['specialty'];

    $update_query = "UPDATE doctor 
                     SET firstname='$fname', lastname='$lname', username='$username', email='$email', specialty='$specialty' 
                     WHERE Id = $doctor_id";

    if (mysqli_query($connect, $update_query)) {
        header("Location: admin_manage.php"); 
    } else {
        echo "Failed to update doctor!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include_once "nav_loged.php"; ?>

<div class="p-6 bg-gray-700 text-white relative top-[4rem] h-content">
    <h3 class="text-2xl font-bold mb-6 text-center">Edit Doctor</h3>
    <form method="POST" class="max-w-lg mx-auto">
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="fname">First Name</label>
            <input type="text" name="fname" value="<?= $doctor['firstname'] ?>" id="fname" 
                   class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="lname">Last Name</label>
            <input type="text" name="lname" value="<?= $doctor['lastname'] ?>" id="lname" 
                   class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="username">Username</label>
            <input type="text" name="username" value="<?= $doctor['username'] ?>" id="username" 
                   class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="email">Email</label>
            <input type="email" name="email" value="<?= $doctor['email'] ?>" id="email" 
                   class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="specialty">Specialty</label>
            <input type="text" name="specialty" value="<?= $doctor['specialty'] ?>" id="specialty" 
                   class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md" required>
        </div>

        <div class="text-center">
            <button type="submit" name="update_doctor" 
                    class="w-full mt-10 px-6 py-3 border border-[#8707ff] text-white font-semibold rounded-lg shadow hover:bg-[#8707ff] transition-all">
                Update Doctor
            </button>
        </div>
    </form>
</div>

<script type="module" src="../../../app.js"></script>
</body>
</html>
