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
    <div class="bg-[#171a21] rounded-[10px] w-[20rem] h-[30rem] flex justify-center items-center flex-col">
      <h2 class="text-[#F5F5F5] my-9 font-extrabold text-2xl">Registration</h2>
      <form id="submission" action="" class="flex flex-col">
        <input type="text" placeholder="Username"
          class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent max-w-[210px] border-[#8707ff] mb-4 rounded-md" required/>
        <form action="" class="flex flex-col">
          <input type="email" placeholder="Email.."
            class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent max-w-[210px] border-[#8707ff] mb-4 rounded-md" required/>
          <input type="password" id="password2" placeholder="Password.."
            class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent max-w-[210px] border-[#8707ff] mb-4 rounded-md" required/>
          <input type="Password" id="password1" placeholder="Confirm Password.."
            class="text-[#F5F5F5] border border-2 px-6 py-2 bg-transparent max-w-[210px] border-[#8707ff] mb-4 rounded-md" required/>
          <p id="warning" class="text-[10px] my-2 text-center hidden"></p>
          <div class="text-[#F5F5F5] flex items-center mb-3 ">
            <label for="togglePassword" class="ml-1 text-[10px] ">Show</label>
            <input type="checkbox" id="togglePassword" class="ml-1" />
          </div>


          <button type="submit" id="signup"
            class="font-extralight text-sm text-[#F5F5F5] border px-6 py-2 bg-[#8707ff] max-w-[210px] border-[#8707ff] mb-4 rounded-md">
            Sign Up
          </button>

          <a href="login_patient.php" class="text-[#8707ff] text-[12px] mb-8 text-center">Already have account ?
            <span class="font-extrabold hover:underline underline-offset-2">Sign In</span></a>
        </form>
    </div>
  </div>
  <script>
    const passwordInput = document.getElementById("password1");
    const passwordReInput = document.getElementById("password2");
    const warn = document.getElementById("warning");
    const signupForm = document.getElementById("submission");

    passwordInput.addEventListener('input', checkPasswordMatch);
    passwordReInput.addEventListener('input', checkPasswordMatch);

    function checkPasswordMatch() {
      if (passwordInput.value !== passwordReInput.value) {
        warn.classList.remove("text-green-500","hidden");
        
        warn.classList.add("text-red-500");

        warn.innerText = "Passwords didn't match. Check it and try again.";
      } else {
        warn.classList.remove("text-red-500");

        warn.classList.add("text-green-500");
        warn.innerText = "password matched !";
      }
    
    }
    signupForm.addEventListener("submit", function (e) {
            if (passwordInput.value !== passwordReInput.value) {
                e.preventDefault(); 
            }
        });



    document.getElementById("togglePassword").addEventListener("change", function () {
            const type = this.checked ? "text" : "password";
            passwordInput.type = type;
            passwordReInput.type = type;
        });


  </script>
</body>

</html>