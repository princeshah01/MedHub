<?php
session_start();
include_once "../connection.php";

if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    // Query to get all appointments related to the patient
    $query = "SELECT * FROM appointment WHERE patient_id = '$patient_id'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $appointment = mysqli_fetch_assoc($result);
        $appId = $appointment['appointment_id'] ;
    } else {
        $error_message = "No appointments found for this patient.";
    }

    // Handle reschedule request
    if (isset($_POST['reschedule'])) {
        $new_date = $_POST['appointment_date'];

        // Update the appointment with the new date and status set to 1
        $update_query = "UPDATE appointment SET appointment_date = '$new_date', status = 1 WHERE appointment_id = '$appId'";
        if (mysqli_query($connect, $update_query)) {
            $success_message = "Apppointment rescheduled successfully.";
            // Refresh appointments after update
            // exit();
        } else {
            $error_message = "Failed to resschedule the appointment.";
        }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body class="bg-gray-700">
    <?php include_once "nav_loged.php"; ?>
    <br><br><br><br>
    <div class="max-w-4xl mx-auto my-12 p-8 bg-white shadow-md rounded-lg mt-[5rem]">
        <h1 class="text-2xl font-bold text-center mb-8">Patient Appointments</h1>

        <?php if (isset($success_message)): ?>
            <p class="text-center text-green-500"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="text-center text-red-500"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <table class="min-w-full bg-white border border-gray-300 rounded-md">
    <thead class="bg-gray-100">
        <tr>
            <th class="py-2 px-4 border-b text-center">Appointment ID</th>
            <th class="py-2 px-4 border-b text-center">Current Status</th>
            <th class="py-2 px-4 border-b text-center">New Date</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="py-2 px-4 border-b text-center">APT <?php echo  $appId ; ?></td>
            <td class="py-2 px-4 border-b text-center">
                <?php echo ($appointment['status'] == 1) ? '<p class="text-red-500">Pending</p>' : '<p class="text-green-500">Completed</p>'; ?>
            </td>
            <td class="py-2 px-4 border-b text-center">
                <form method="POST" class="flex items-center justify-center space-x-4">
                    <input type="date" name="appointment_date" required
                           class="border rounded-md px-4 py-2">
                    <button type="submit" name="reschedule"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        Reschedule
                    </button>
                </form>
            </td>
        </tr>
    </tbody>
</table>


    </div>
</body>

</html>