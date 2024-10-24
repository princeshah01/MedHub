

<nav
      id="navbar"
      class="text-[#8707ff] navbar fixed top-0 left-0 w-full z-10 bg-gray-800 w-[100%]"
    >
      <div
        class="container mx-auto flex justify-between items-center p-4 max-w-screen-lg px-4"
      >
        <a href="index.php" class="text-2xl font-bold">
          MedHub<span class="font-extrabold">.Com</span>
        </a>

        <button
          id="menuButton"
          class="block md:hidden text-white focus:outline-none"
        >
          <svg
            id="hamburgerIcon"
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16m-7 6h7"
            ></path>
          </svg>
          <svg
            id="crossIcon"
            class="hidden w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            ></path>
          </svg>
        </button>

        <ul class="hidden md:flex space-x-6">
          <?php
          if(isset($_SESSION['admin'])){
              $user = $_SESSION['admin'];

              echo '
              
              <li>
                <a
                  
                  class="font-bold hover:text-gray-400 hover:underline underline-offset-4 transition-all duration-500"
                  ><i class="fa-solid fa-user-tie"></i> '.$user.'</a
                >
              </li>
              <li>
                <a
                  href="../logout.php"
                  class="font-bold hover:text-gray-400 hover:underline underline-offset-4 transition-all duration-500"
                  >LogOut</a
                >
              </li>

              ';
          }
      
      
      ?>
        
        </ul>
      </div>

      <div
        id="mobileMenu"
        class="rounded-lg sidebar fixed right-0 top-10px h-fit w-1/3 bg-white text-gray-800 hidden lg:hidden flex-col items-center space-y-4 py-6"
      >
        <?php
            if(isset($_SESSION['admin'])){
                $user = $_SESSION['admin'];

                echo '
                
                <a  class="block text-lg hover:text-gray-600">'.$user.'</a>
                <a href=../logout.php" class="block text-lg hover:text-gray-600">LogOut</a>



                ';
            }
        
        
        ?>

      
      </div>
    </nav>
