<?php 
 $current_doc_username = $_SESSION['doc'] ;
 $current_doc_res = mysqli_fetch_assoc(mysqli_query($connect , "SELECT * FROM doctor WHERE username = '{$current_doc_username}'" ));
 $current_doc_Id = $current_doc_res['Id'];

?>


<div class="flex min-h-screen">
    <aside class="lg:w-64 w-40 bg-gray-800 border-r border-gray-900 flex flex-col items-center relative top-[4rem]">
        <nav class="mt-4 w-[90%] lg:w-[80%]">
            <a href="#"
                class="block py-3 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300 rounded-lg mb-4">Dashboard</a>
                <a href="manage_appointment.php?doctor_Id=<?php echo $current_doc_Id; ?>"
                class="block py-3 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300 rounded-lg mb-4">Manage Appointment</a>
            <a id="activeSessionLink"   
                class="block py-3 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300 rounded-lg mb-4">Active
                Sessions</a>
            <?php  echo "<a href='./doctor_manage_patients.php?doctor_Id={$current_doc_Id}'
                class='block py-3 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300 rounded-lg mb-4'>View
                Reports</a>"
                ?>
            <div class="relative">
                <a href="#" id="settingsToggle"
                    class="block py-3 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300 rounded-lg mb-4">Settings</a>
                <div id="settingsMenu" class="hidden ml-4">
                    <a href="edit_doctor_info.php"
                        class="block py-2 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300 rounded-lg">Edit
                        Info</a>
                </div>
            </div>
            <a href="../logout.php"
                class="block py-3 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300 rounded-lg mb-4">Logout</a>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col relative top-[4rem]">
        <main class="flex-1 p-6 bg-gray-700 text-[#8707ff]">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Total Patients -->
                <a <?php echo "href='./doctor_manage_patients.php?doctor_Id={$current_doc_Id}'"?>>
                    <div class="bg-gray-900 p-6 rounded-lg shadow-md hover:bg-gray-800">
                        <h3 class="text-lg font-semibold text-gray-500">Total Patients</h3>
                        <?php
                        $patient_count = mysqli_query($connect, "SELECT * FROM patient WHERE checkupwith = '{$current_doc_Id}'");
                        $num_patient = mysqli_num_rows($patient_count);
                        ?>
                        
                        <p class="mt-2 text-2xl font-bold"><?php echo $num_patient; ?></p>
                    </div>
                </a>
                
            
                <!-- Appointments -->
                <a  id="appointmentLink">
                    <div class="bg-gray-900 p-6 rounded-lg shadow-md hover:bg-gray-800">
                        <h3 class="text-lg font-semibold text-gray-500">Appointments</h3>
                        <?php
                        $appointment_count = mysqli_query($connect, "SELECT * FROM appointment WHERE doctor_id = '{$current_doc_Id}'");
                        $num_appointments = mysqli_num_rows($appointment_count);
                        ?>
                        <p class="mt-2 text-2xl font-bold"><?php echo $num_appointments; ?></p>
                    </div>
                </a>

                <!-- Active Sessions -->
                <div class="bg-gray-900 p-6 rounded-lg shadow-md hover:bg-gray-800" id="activeSessionLink">
                    <h3 class="text-lg font-semibold text-gray-500">Active Sessions</h3>
                    <?php
                        $appointment_count = mysqli_query($connect, "SELECT * FROM appointment WHERE doctor_id = '{$current_doc_Id}' AND status = 1");
                        $num_appointments = mysqli_num_rows($appointment_count);
                        ?>
                    <p class="mt-2 text-2xl font-bold"><?php echo $num_appointments; ?></p>
                </div>
            </div>
                
<div class="mt-6 visible " id="appointment">
    <h3 class="text-xl font-bold mb-4">All AppointmentS</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-lg">
            <thead>
                <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Appointment ID</th>

                    <th class="py-3 px-6 text-left">Patient</th>
                    <th class="py-3 px-6 text-left">Appointment Date</th>
                    <th class="py-3 px-4 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">

                <?php 
               
          $query = "SELECT * FROM appointment WHERE doctor_id = '{$current_doc_Id}' ";
          $response = mysqli_query($connect, $query);

          if(mysqli_num_rows($response) < 1){
              echo "<tr><td colspan='3' class='text-center text-red-300 text-xl py-3'>No Patient Found!</td></tr>";
          } else {
              while($row = mysqli_fetch_array($response)) {
                $appointmentId="APT".$row['appointment_id'];
            
                  $patientId = $row['patient_id'];
                  $responsePatientName = mysqli_query($connect , "SELECT Full_Name from patient WHERE p_id = '{$patientId}'") ;
                  $row1 = mysqli_fetch_assoc($responsePatientName);
                    $patient_name = $row1["Full_Name"];
                    $appointmentDate = $row["appointment_date"];
                  $doctorId = $row['doctor_id'];
                  
                  #$name = $row['Full_Name'];
                  
                  
                  if($row['status']){
                      
                      $status = "<p class='text-red-500'>Pending</p>"; ; 
                    }
                    else{
                        $status = "<p class='text-green-500'>completed</p>"; 
                        
                    }
                    echo "   <tr class='border-b border-gray-200'>
                    <td class='py-3 px-6 text-left'>$appointmentId</td>
                    
                    <td class='py-3 px-6 text-left'>$patient_name</td>
                    <td class='py-3 px-6 text-left'>$appointmentDate</td>
                                <td class='py-3 px-4 text-center'>$status</td>
                                
                            </tr>";
                        }
                    }
                    # echo  $_SESSION["doc"] ;
                    ?>
            </tbody>
        </table>
    </div>
    
</div>
<!-- active sessions  -->





<div class="mt-6 hide" id="activeSession">
    <h3 class="text-xl font-bold mb-4 ">Active Sessions </h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-lg">
            <thead>
                <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Appointment ID</th>

                    <th class="py-3 px-6 text-left">Patient</th>
                    <th class="py-3 px-6 text-left">Appointment Date</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4 text-center">Actions</th>

                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">

                <?php 
          $query = "SELECT * FROM appointment WHERE status = 1 AND doctor_id = '{$current_doc_Id}' ";
          $response = mysqli_query($connect, $query);

          if(mysqli_num_rows($response) < 1){
              echo "<tr><td colspan='3' class='text-center text-red-300 text-xl py-3'>No patient Found!</td></tr>";
          } else {
              while($row = mysqli_fetch_array($response)) {
                $appointmentId="APT".$row['appointment_id'];
            
                  $patientId = $row['patient_id'];
                  $responsePatientName = mysqli_query($connect , "SELECT Full_Name from patient WHERE p_id = '{$patientId}'") ;
                  $row1 = mysqli_fetch_assoc($responsePatientName);
                    $patient_name = $row1["Full_Name"];
                    $appointmentDate = $row["appointment_date"];
                  $doctorId = $row['doctor_id'];
                    
                  #$name = $row['Full_Name'];
                 
                 
                  if($row['status']){
                      
                      $status = "<p class='text-red-500'>Pending</p>"; ; 
                }
                else{
                      $status = "<p class='text-green-500'>completed</p>"; 

                  }
                  echo "   <tr class='border-b border-gray-200'>
                                <td class='py-3 px-6 text-left'>$appointmentId</td>

                                <td class='py-3 px-6 text-left'>$patient_name</td>
                                <td class='py-3 px-6 text-left'>$appointmentDate</td>
                                <td class='py-3 px-6 text-center'>$status</td>
                            <td class='text-center'><a href='treatment_upload.php?patient_name={$patient_name}' class=' bg-[#20C997] hover:bg-[#008080] text-white px-4 py-1 rounded-md' onclick='return alert(\"Redirecting to report generation section :) ) ! \")'>Begin Treatment</a>
                                </td>
                                </tr>";
              }
          }
          ?>
            </tbody>
        </table>
    </div>

</div>

           
        </main>
    </div>
</div>

<script src="../../../app.js"></script>
<script>

        const appointmentLink = document.getElementById('appointmentLink');
        const activeSessionLink = document.querySelectorAll('#activeSessionLink');
        const appointmentDiv = document.getElementById('appointment');
        const activeSessionDiv = document.getElementById('activeSession');

        appointmentLink.addEventListener('click', function(event) {
            event.preventDefault();
            appointmentDiv.classList.add('visible');
            appointmentDiv.classList.remove('hide');
            activeSessionDiv.classList.add('hide');
            activeSessionDiv.classList.remove('visible');
        });

        activeSessionLink.forEach((e)=>{
            e.addEventListener('click', function(event) {
            event.preventDefault();
            activeSessionDiv.classList.add('visible');
            activeSessionDiv.classList.remove('hide');
            appointmentDiv.classList.add('hide');
            appointmentDiv.classList.remove('visible');
        });
        });




const settingsToggle = document.getElementById('settingsToggle');
const settingsMenu = document.getElementById('settingsMenu');

settingsToggle.addEventListener('click', function() {
    settingsMenu.classList.toggle('hidden');
});
</script>