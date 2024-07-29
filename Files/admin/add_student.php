<?php
session_start();
require('includes/connection.php');  //include connection file
require('functions.php');

//include function file
//include 'includes/connection.php';
if (isset($_SESSION['user_email'])) {

    echo " <script> window.open('index1.php?view_profile1','_self')</script>";
} elseif (!isset($_SESSION['user_email1'])) {

    echo " <script> window.open('../index.php','_self')</script>";
} else {

?>



    <!DOCTYPE html>
    <html lang="en">


    <!-- Mirrored from dashhub-tail.netlify.app/forms-basic by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 20 Jul 2024 16:16:54 GMT -->
    <!-- Added by HTTrack -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Premium Tailwind CSS Admin & Dashboard Template" />
        <meta name="author" content="Webonzer" />

        <!-- Site Tiltle -->
        <title>Add New Student</title>

        <!-- Favicon Icon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico" />

        <!-- Style Css -->
        <link rel="stylesheet" href="assets/css/style.css" />
    </head>

    <body x-data="main" class="font-inter text-base antialiased font-medium relative vertical" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.fullscreen ? 'full' : '',$store.app.mode]">
        <!-- Start Layout -->
        <div class="bg-white dark:bg-dark text-dark dark:text-white">
            <!-- Start Menu Sidebar Olverlay -->
            <div x-cloak class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-40 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>
            <!-- End Menu Sidebar Olverlay -->

            <!-- Start Main Content -->
            <div class="main-container flex mx-auto ">
                <?php include('includes/sideBar.php') ?>

                <!-- Start Content Area -->
                <div class="main-content flex-1">
                    <?php include('includes/topBar.php'); ?>

                    <!-- Start Content -->
                    <div class="h-[calc(100vh-60px)] relative overflow-y-auto overflow-x-hidden p-5 sm:p-7 space-y-5">
                        <!-- Start All Card -->
                        <div class="flex flex-col gap-5 min-h-[calc(100vh-188px)] sm:min-h-[calc(100vh-204px)]">
                            <div class="grid grid-cols-1">
                                <div>
                                    <ul class="flex flex-wrap items-center text-sm font-semibold space-x-2.5">
                                        <li class="flex items-center space-x-2.5 text-gray hover:text-dark dark:hover:text-white duration-300">
                                            <a href="javaScript:;">Student</a>
                                            <svg class="text-gray/50" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.5" d="M1.33644 0H4.19579C4.60351 0 5.11318 0.264045 5.32903 0.589888L7.83532 4.3427C8.07516 4.70787 8.05119 5.2809 7.77538 5.6236L4.66949 9.5C4.44764 9.77528 3.96795 10 3.6022 10H1.33644C0.287156 10 -0.348385 8.92135 0.203241 8.08427L1.86409 5.59551C2.08594 5.26405 2.08594 4.72472 1.86409 4.39326L0.203241 1.90449C-0.348385 1.07865 0.293152 0 1.33644 0Z" fill="currentColor" />
                                            </svg>
                                        </li>
                                        <li>Add Student</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="dark:border-gray/20 border-2 border-lightgray/10">
                                    <div class="bg-white dark:bg-dark p-5 rounded-lg">
                                        <form method="post" action="student_add.php" class="space-y-4">
                                            <input type="text" class="form-input" placeholder="Student ID" name="student_id" required="">
                                            <input type="text" class="form-input" placeholder="Student Name" name="student_name" required="">
                                            <input type="email" class="form-input" placeholder="Student Email" name="student_email" required="">

                                            <select name="student_cat1" class="form-select">
                                                <option>Select Category</option>
                                                <option value="GEN">GEN</option>
                                                <option value="OBC">OBC</option>
                                                <option value="SC/ST">SC/ST</option>
                                            </select>

                                            <select name="student_cat2" class="form-select">
                                                <option>Select Degree</option>
                                                <option value="UG">UG</option>
                                                <option value="PHD">PHD</option>
                                                <option value="M.TECH">M.TECH</option>
                                            </select>

                                            <input type="number" class="form-input" name="year" placeholder="Admission Year" required="">
                                    </div>
                                    <div class="bg-white dark:bg-dark  p-5 rounded-lg">
                                        <div class="space-y-4">
                                            <select name="student_year" class="form-select">
                                                <option>Student Year</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>

                                            <input type="number" class="form-input" min="0" max="9999999999" name="student_other_fee" placeholder="Other Fees" required="">

                                            <input type="text" class="form-input" name="student_addr" placeholder="Address" required="">

                                            <input type="number" class="form-input" placeholder="Contact Number" name="student_contect" required="">

                                            <input type="password" class="form-input" placeholder="Password" name="student_pass" required="">
                                            <input type="submit" name="insert_post" class="btn border text-primary border-transparent rounded-md transition-all duration-300 hover:text-white hover:bg-primary bg-primary/10" value="Submit">
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End All Card -->

                        <!-- Start Footer -->
                       
                        <!-- End Footer -->
                    </div>
                    <!-- End Content -->
                </div>
                <!-- End Content Area -->
            </div>
        </div>
        <!-- End Layout -->

        <!-- All javascirpt -->
        <!-- Alpine js -->
        <script src="assets/js/alpine-collaspe.min.js"></script>
        <script src="assets/js/alpine-persist.min.js"></script>
        <script src="assets/js/alpine.min.js" defer></script>

        <!-- Custom js -->
        <script src="assets/js/custom.js"></script>
    </body>


    <!-- Mirrored from dashhub-tail.netlify.app/forms-basic by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 20 Jul 2024 16:16:54 GMT -->

    </html>
<?php } ?>