<?php

include_once "../connection.php";

// Check if appointment_id is set in the URL
if (isset($_GET['appointmemt_id'])) {
    $appointment_id = $_GET['appointmemt_id'];
    # echo $appointment_id ;
    // Update the appointment status to 'completed'
    $query = "UPDATE appointment SET status='0' WHERE appointment_id=$appointment_id";
    mysqli_query($connect, $query);

    // Redirect to the same page
    header("Location: ./index.php");
    exit();
}
else{
    echo "<h4 style='text-align: center; color: red; font-size: 20px;'>can't fetch appointment id to update status";
}
?>
