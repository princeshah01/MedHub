
<footer id="contact" class="bg-[#111827]  py-6">
    <div class="container mx-auto flex flex-col justify-between mt-8">
        <div class="flex flex-col md:flex-row md:space-x-16 m-auto ">
            <div class="mb-4 md:mb-0 lg:mr-[15rem]">
                <h4 class="font-bold text-lg">Links</h4>
                <ul class="mt-2">
                    <li><a href="#" class="text-gray-400 hover:text-white hover:underline underline-offset-4 ">Home</a>
                    </li>
                    <li><a href="#about"
                            class="text-gray-400 hover:text-white hover:underline underline-offset-4 ">About</a></li>
                    <li><a href="#features"
                            class="text-gray-400 hover:text-white hover:underline underline-offset-4 ">Features</a></li>
                    <li><a href="#contact"
                            class="text-gray-400 hover:text-white hover:underline underline-offset-4 ">Contact</a></li>
                </ul>
            </div>
            <div class="mb-4 md:mb-0">
                <h4 class="font-bold text-lg">Support</h4>
                <ul class="mt-2">
                    <li><a href="#" class="text-gray-400 hover:text-white hover:underline underline-offset-4 ">FAQ</a>
                    </li>
                    <li><a href="#" class="text-gray-400 hover:text-white hover:underline underline-offset-4 ">Help
                            Center</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white hover:underline underline-offset-4 ">Terms of
                            Service</a></li>
                </ul>
            </div>
            <div id="right_footer" class="mb-4 md:mb-0 ">
                <h4 class="font-bold text-lg">Stay Connected with Us</h4>
              
                     <form action="./src/auth/store_emails.php" method="POST" class="flex items-center space-x-2 mt-4">

                    <input type="email" name="email" placeholder="Your email address"
                        class="flex-1 p-2 border border-gray-300  text-gray-900 rounded-md focus:outline-none focus:ring-1 focus:ring-[#8707ff]" />
                    <button type="submit"
                        class="flex items-center justify-center p-2 bg-[#8707ff] text-gray-900 h-[42px] rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Subscribe">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                            aria-hidden="true" focusable="false" height="1em" width="1em"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path
                                d="M20 4H6c-1.103 0-2 .897-2 2v5h2V8l6.4 4.8a1.001 1.001 0 0 0 1.2 0L20 8v9h-8v2h8c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-7 6.75L6.666 6h12.668L13 10.75z">
                            </path>
                            <path d="M2 12h7v2H2zm2 3h6v2H4zm3 3h4v2H7z"></path>
                        </svg>
                    </button>
                </form>


                <p class="  text-white  mt-4 ">&copy 2024 MedHub. All rights reserved</p>

            </div>
        </div>
        <div class="mt-4 md:mt-0 flex items-center justify-center">
            <p class="text-center md:text-right mt-8 text-[#8707ff] font-bold ">Made with 🖤 by <a
                    href="https://prince.info.np"
                    class="hover:underline underline-offset-4 hover:font-extrabold">Prince</a> 
            </p>
        </div>
    </div>
</footer>