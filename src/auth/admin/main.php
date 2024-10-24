
<div class="flex min-h-screen">
  <aside
    class="lg:w-64 w-40 bg-gray-800 border-r border-gray-900  flex flex-col items-center relative top-[4rem]"
  >
    <nav class="mt-4 w-[90%] lg:w-[80%] ">
      <a
        href="#"
        class="block py-3 px-4  text-gray-500  hover:bg-gray-900 hover:text-gray-300 rounded-lg mb-4"
      >
        Dashboard
      </a>
      <a
        href="./admin_Manage_doctor.php"
        class="block py-3 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300  rounded-lg mb-4"
      >
        Doctors
      </a>
      <a
        href="./admin_add_patient.php"
        class="block py-3 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300  rounded-lg mb-4"
      >
        Patients
      </a>
      <div class="relative">
            <a href="#" id="settingsToggle" class="block py-3 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300 rounded-lg mb-4">
                Settings
            </a>
            <div id="settingsMenu" class="hidden ml-4">
                <a href="edit_current.php" class="block py-2 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300 rounded-lg">Edit info</a>
            </div>
        </div>
      <a
        href="logout_admin.php"
        class="block py-3 px-4 text-gray-500 hover:bg-gray-900 hover:text-gray-300 rounded-lg mb-4"
      >
        Logout
      </a>
    </nav>
  </aside>

  <div class="flex-1 flex flex-col  relative top-[4rem] ">
    <main class="flex-1 p-6 bg-gray-700 text-[#8707ff]" >
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
      <a href="admin_manage.php">

          <div class="bg-gray-900 p-6 rounded-lg shadow-md  hover:bg-gray-800 ">
              <h3 class="text-lg font-semibold text-gray-500 ">Total Admins</h3>
              <?php
          $admin_count = mysqli_query($connect , " SELECT * FROM admin");
          $num = mysqli_num_rows($admin_count);
          ?>
          <p class="mt-2 text-2xl font-bold"><?php echo $num ?></p>
        </div>
    </a>  

    <a href="./admin_Manage_doctor.php">

        <div class="bg-gray-900 p-6 rounded-lg shadow-md hover:bg-gray-800 ">
            <h3 class="text-lg font-semibold text-gray-500" >Total Doctors</h3>
            <?php
          $doctor_count = mysqli_query($connect , "SELECT * FROM doctor");
          $num_doctors = mysqli_num_rows($doctor_count);
          ?>
          <p class="mt-2 text-2xl font-bold"><?php echo $num_doctors?></p>
        </div>
    </a>   
  <a href="./admin_manage_patient.php">

    <div class="bg-gray-900 p-6 rounded-lg shadow-md hover:bg-gray-800 ">
      <h3 class="text-lg font-semibold text-gray-500" >Total Patients</h3>
      <?php
          $patient_count = mysqli_query($connect , "SELECT * FROM patient");
          $num_patient = mysqli_num_rows($patient_count);
         ?>
          <p class="mt-2 text-2xl font-bold"><?php echo $num_patient?></p>
        </div>
      </a>
        
        <div class="bg-gray-900 p-6 rounded-lg shadow-md hover:bg-gray-800 ">
          <h3 class="text-lg font-semibold text-gray-500" >Appointments</h3>
          <?php
          $apt_count = mysqli_query($connect , "SELECT * FROM appointment");
          $num_apt = mysqli_num_rows($apt_count);
         ?>
          <p class="mt-2 text-2xl font-bold"><?php echo $num_apt?></p>
          
        </div>

        <div class="bg-gray-900 p-6 rounded-lg shadow-md hover:bg-gray-800 ">
          <h3 class="text-lg font-semibold text-gray-500" >Active Sessions</h3>
          <?php
          $apt_count_active = mysqli_query($connect , "SELECT * FROM appointment WHERE status = 1");
          $num_apt_active = mysqli_num_rows($apt_count_active);
         ?>
          <p class="mt-2 text-2xl font-bold"><?php echo $num_apt_active?></p>
          
        </div>
      </div>

      <div class="mt-6">
        <h3 class="text-xl font-bold mb-4">Pending Appointment</h3>
        <div class="overflow-x-auto">
          <table class="min-w-full bg-white rounded-lg shadow-lg">
            <thead>
              <tr
                class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal"
              >
                <th class="py-3 px-6 text-left">Doctor</th>
                <th class="py-3 px-6 text-left">Patient</th>
                <th class="py-3 px-6 text-left">Appointment Date</th>
                <th class="py-3 px-6 text-center">Status</th>
              </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
             
            <?php

          $apt_active = mysqli_query($connect , "SELECT * FROM appointment WHERE status = 1");
          if(mysqli_num_rows($apt_active) < 1){
            echo "<tr><td colspan='3' class='text-center text-red-300 text-xl py-3'>No patient Found! </td></tr>";
        } else {
            while($row = mysqli_fetch_array($apt_active)) {
                $patient_id = $row['patient_id'];
                $doctor_id = $row['doctor_id'];
                $patient_info = mysqli_fetch_assoc(mysqli_query($connect , "SELECT * FROM patient WHERE p_Id = '$patient_id'"));
                $doctor_info = mysqli_fetch_assoc(mysqli_query($connect , "SELECT * FROM doctor WHERE Id = '$doctor_id'"));
                $doctorName = $doctor_info['firstname']." ".$doctor_info['lastname'] ;
                $patientName = $patient_info['Full_Name'];
                $aptDate = $row['appointment_date'];
            }
          }


            echo "<tr class='border-b border-gray-200'>
                <td class='py-3 px-6 text-left capitalize'>Dr.$doctorName</td>
                <td class='py-3 px-6 text-left capitalize'>$patientName</td>
                <td class='py-3 px-6 text-left'>$aptDate</td>
                <td class='py-3 px-6 text-center'>
                <span
                class='bg-green-200 text-green-700 px-3 py-1 rounded-full'
                >Pending</span
                >
                </td>
                </tr>"
            ?>
                

            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>