<?php
// Start the session and include the connection file
session_start();
include_once "../connection.php";

// Check if a patient ID is passed via GET
if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    // Query to get all files related to the patient
    $query = "SELECT * FROM file_uplaod WHERE p_id = '$patient_id'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error_message = "No files found for this patient.";
    }
} else {
    header("Location: dashboard.php"); // Redirect if ID is not provided
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="../../../style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-700">
    <?php include_once "nav_loged.php"?>
    <br>
    <br><br><br>
    <div class="max-w-4xl mx-auto my-12 p-8 bg-white shadow-md rounded-lg mt-[5rem]">
        <h1 class="text-2xl font-bold text-center mb-8">Patient Reports</h1>

        <?php if (isset($error_message)): ?>
            <p class="text-center text-red-500"><?php echo $error_message; ?></p>
        <?php else: ?>
            <table class="min-w-full bg-white border border-gray-300 rounded-md">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">File Name</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($files as $file): ?>
                        <tr>
                            <td class="py-2 px-4 border-b text-center"><?php echo $file['filename']; ?></td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="download.php?file=<?php echo urlencode($file['filename']); ?>"
                                   class="bg-green-600 hover:bg-blue-700 text-white px-4 py-1 rounded-md text-center">
                                    Download
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>
