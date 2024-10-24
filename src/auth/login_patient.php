<?php

session_start();
include_once "connection.php";

$login_error = "";
$login_done = "";


if (isset($_POST['login'])){
    $username = $_POST['uname'];
    $password = $_POST['pass'];

    $err = array();

    if(empty($username)){
        $err['patient']="Enter Username";
    }elseif(empty($password)){
        $err['patient']="Enter Password";
    }

    if(count($err)==0){
        $query = "SELECT * FROM patient WHERE username ='$username' AND password = '$password' ";

        $result = mysqli_query($connect,$query);

        if(mysqli_num_rows($result) == 1){
           $login_done = 'Login successful! Redirecting to doctor Panel.. :) ';

            $_SESSION['patient'] = $username ;

            header("Location: patient/index.php");
            exit();

        }else{
            $login_error = "Invalid Username and Password";
        }
    }

}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  </head>
  <body>
    <div class="flex justify-center items-center h-[100vh] w-[100vw] bg-[#1A202C]">
      <div class="bg-[#171a21] rounded-[10px] w-[19rem] h-[30rem] flex justify-center items-center flex-col">
        <h2 class="text-[#F5F5F5] my-9 font-extrabold text-2xl">Log In</h2>
        <?php if (!empty($login_error)) : ?>
          <p class="text-red-200 text-sm font-thin my-2"><?= $login_error; ?></p>
        <?php endif; ?>
        <?php if (!empty($login_done)) : ?>
          <p class="text-green-200 text-sm font-thin my-2"><?= $login_done; ?></p>
        <?php endif; ?>
        <a href="login_admin.php" class="text-[#8707ff] text-[16px] mb-4 text-right">Are you a <span class="font-extrabold hover:underline underline-offset-2">Patient</span> !</a>

        <form method="post" class="flex flex-col">





          <input
            type="text"
            name="uname"
            placeholder="username.."
            class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent max-w-[190px] border-[#8707ff] mb-4 rounded-md" required
          />
          <input
            type="password"
            name="pass"
            id="password" 
            placeholder="password.."
            class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent max-w-[190px] border-[#8707ff] mb-4 rounded-md"
            required />
          <div class="text-[#F5F5F5] flex items-center mb-3 ">
            <label for="togglePassword" class="ml-1 text-[10px] ">Show</label>
            <input type="checkbox" id="togglePassword" class="ml-1" />
          </div>
        

          <button
            type="submit"
            name="login"
            value="login"
            class="font-extralight text-sm text-[#F5F5F5] border px-6 py-2 bg-[#8707ff] max-w-[190px] border-[#8707ff] mb-4 rounded-md"
          >
            Login
          </button>
          <a href="" class="text-[#8707ff] text-[12px] mb-2 text-center">Forgot
            <span class="font-extrabold hover:underline underline-offset-2">Username / Password</span>?</a>
          <a href="./signup.php" class="text-[#8707ff] text-[12px] mb-8 text-center">Don't have account ?
            <span class="font-extrabold hover:underline underline-offset-2 ">Sign up</span></a>
        </form>
      </div>
    </div>
    <script>
      document.getElementById("togglePassword").addEventListener("change", function () {
        const passwordInput = document.getElementById("password");
        if (this.checked) {
          // Change input type to text to show the password
          passwordInput.type = "text";
        } else {
          // Change input type back to password to hide it
          passwordInput.type = "password";
        }
      });

    </script>
  </body>
</html>
