<?php
session_start();
include_once "../connection.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../../../index.php");
    exit();
}

$current_user = $_SESSION['admin'];
$query = "SELECT * FROM admin WHERE username = '$current_user'";
$response = mysqli_query($connect, $query);
$admin_data = mysqli_fetch_assoc($response);

if (!$admin_data) {
    echo "Admin not found!";
    exit();
}

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email =$_POST['email'];
    $password = $_POST['password'];
    
    $query = "UPDATE admin SET username = '$username', email = '$email' WHERE username = '$current_user'";

    if (!empty($password)) {
        $query = "UPDATE admin SET username = '$username', email = '$email', password = '$password' WHERE username = '$current_user'";
    }

    if (mysqli_query($connect, $query)) {
       
        $_SESSION['admin'] = $username;
        header("Location: index.php"); 
    } else {
        echo "Failed to update admin details!";
    }
}
?>

    <?php include_once "nav_loged.php"; ?>
    <div class="p-6 bg-gray-700 text-white relative top-[4rem] h-screen">
        <h3 class="text-2xl font-bold mb-6 text-center">Edit your Information</h3>
        <form method="POST" class="max-w-lg mx-auto">
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $admin_data['username']; ?>" class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $admin_data['Email']; ?>" class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none" required>
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="password">New Password (Leave blank if not changing)</label>
                <input type="password" name="password" id="password" class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent w-full border-[#8707ff] mb-4 rounded-md focus:ring-0 focus:outline-none">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" name="update" class="w-full mt-10 px-6 py-3 border border-[#8707ff] text-white font-semibold rounded-lg shadow hover:bg-[#8707ff] transition-all">Update Admin</button>
            </div>
        </form>
    </div>
