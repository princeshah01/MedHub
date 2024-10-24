<?php
session_start();

if (!isset($_SESSION['doc'])) {
    header("Location: ../../../index.php");
    exit();
}

include_once "../connection.php";

// Retrieve patient details
if (isset($_GET['patient_name'])) {
    $patient_name = $_GET['patient_name'];
    $query_patient = "SELECT * FROM patient WHERE Full_Name = '{$patient_name}'";
    $res_patient = mysqli_fetch_assoc(mysqli_query($connect, $query_patient));
    $patient_gender = $res_patient['gender'];
    $patient_id = $res_patient['p_Id'];
    $patient_dob = $res_patient['dob'];
}

$doctor_username = $_SESSION["doc"];
$query = "SELECT * FROM doctor WHERE username = '$doctor_username'";
$response = mysqli_query($connect, $query);

if ($response && mysqli_num_rows($response) > 0) {
    $doctor = mysqli_fetch_assoc($response);
    $doctor_name = $doctor['firstname'] . " " . $doctor['lastname'];
    $doctor_spe = $doctor['specialty'];
    $doctor_number = $doctor['phonenumber'];
}

$query_appointment = "SELECT * FROM appointment WHERE patient_id = '{$res_patient['p_Id']}'";
$res_appoint = mysqli_fetch_assoc(mysqli_query($connect, $query_appointment));

$issuedate = $res_appoint['create_at'];
$appointment_id = $res_appoint['appointment_id'];

$output = "";

// Handle file upload
if (isset($_POST['submit'])) {
    $targetDir = '../uploads/';
    $targetFile = $targetDir . basename($_FILES['pdffile']['name']);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if ($fileType != "pdf" || $_FILES['pdffile']['size'] > 10485760) {
        $output = "<p class='text-center text-red-500 text-sm'>Error: Only PDF files less than 10MB are allowed.</p>";
    } else {
        if (move_uploaded_file($_FILES['pdffile']['tmp_name'], $targetFile)) {
            $filename = $_FILES["pdffile"]["name"];
            $folder_path = $targetDir;
            $sendToSql = "INSERT INTO file_uplaod (p_id, filename, folder_path) VALUES ('$patient_id', '$filename', '$folder_path')";

            if ($connect->query($sendToSql) === TRUE) {
                $output = "<p class='text-center text-green-500 text-sm'>File uploaded successfully.</p>";
            } else {
                $output = "<p class='text-center text-red-500 text-sm'>Failed to upload file.</p>";
            }
        }
    }
}

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor | Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="../../../style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <?php include_once "nav_loged.php"; ?>

    <section class="bg-[#1a202c] mt-[10rem]">

        <div class="max-w-3xl mx-auto my-10 bg-white shadow-md rounded-lg p-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center border-b pb-4">
                <div>
                    <h1 class="text-2xl font-bold text-blue-600">Prescription Report</h1>
                    <p class="text-sm text-gray-500">Issued on: <span id="date"><?php echo $issuedate?></span></p>
                </div>
                <div class="text-right">

                    <?php echo "<h2 class='text-lg font-semibold'>Dr. $doctor_name</h2>";
?>
                    <p class="text-sm">MBBS, MD - <?php echo"$doctor_spe"?> </p>
                    <p class="text-sm">Contact: <?php  echo $doctor_number?></p>
                </div>
            </div>

            <!-- Patient Details -->
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-gray-700">Patient Details</h3>
                <div class="grid grid-cols-2 gap-4 mt-2">
                    <div>
                        <p class="text-sm"><strong>Name:</strong> <?php echo $patient_name?></p>
                        <p class="text-sm"><strong>Date of Birth:</strong><?php echo $patient_dob?> </p>
                    </div>
                    <div>
                        <p class="text-sm"><strong>Gender:</strong> <?php echo $patient_gender?></p>
                        <p class="text-sm"><strong>Patient ID:</strong> <?php echo "P".$patient_id?></p>
                    </div>
                </div>
            </div>

            <!-- Prescribed Medicines Section -->
            <div class="mt-6 flex justify-center items-center flex-col">
                <h3 class="text-xl font-semibold text-gray-700 text-center">View Reports And Update Status</h3>
                <!-- here upload reports form -->
                
                
                
                <div class="w-full max-w-md p-8 bg-white shadow-md rounded-lg my-8">
                    <form  method="post" enctype="multipart/form-data" class="space-y-6">
                        <h2 class="text-2xl font-bold text-gray-700 text-center">Upload File</h2>
                        
                        <div>
                            <label for="fileUpload" class="block text-sm font-medium text-gray-600 mb-2">
                                Choose a file:
                            </label>
                            <input 
                            type="file" 
          id="fileUpload" 
          name="pdffile" 
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none" 
          required>
        </div>
        <?php echo "$output" ?>
        <div class="flex justify-center space-x-4">
        <button 
          type="submit" 
          name="submit"
          class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
          Submit
        </button>
        
        <button 
        type="reset" 
          class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-300">
          Reset
        </button>
    </div>
</form>
</div>

<?php echo "<a href='mark_appointment.php?appointmemt_id={$appointment_id}' class='text-center w-[63%] bg-[#20C997] hover:bg-[#008080] text-white px-4 py-1 rounded-md'>Done</a>"?>

            </div>



            <!-- Footer Section -->
            <div class="mt-10 border-t pt-4 text-center text-sm text-gray-500">
                <p>Address: Rajbiraj-4, saptari, Nepal </p>
                <p>Email: Prince.rjb839@gmail.com | Website: www.medhub.com </p>
            </div>
        </div>
    </section>




    <script type="module" src="../../../app.js"></script>
</body>

</html>