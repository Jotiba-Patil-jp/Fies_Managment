<?php
session_start();
if (isset($_SESSION['user_email'])) {

    echo " <script> window.open('index1.php?view_profile1','_self')</script>";
} elseif (!isset($_SESSION['user_email1'])) {

    echo " <script> window.open('../index.php','_self')</script>";
} else {
?>

    <!DOCTYPE html>
    <html lang="en">


    <!-- Mirrored from dashhub-tail.netlify.app/table-basic by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 20 Jul 2024 16:16:53 GMT -->
    <!-- Added by HTTrack -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Premium Tailwind CSS Admin & Dashboard Template" />
        <meta name="author" content="Webonzer" />

        <!-- Site Tiltle -->
        <title>Student List</title>

        <!-- Favicon Icon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Style Css -->
        <link rel="stylesheet" href="assets/css/style.css">

    </head>

    <body x-data="main" class="font-inter text-base antialiased font-medium relative vertical" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.fullscreen ? 'full' : '',$store.app.mode]">

        <!-- Start Layout -->
        <div class="bg-white dark:bg-dark text-dark dark:text-white">

            <!-- Start Menu Sidebar Olverlay -->
            <div x-cloak class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-40 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>
            <!-- End Menu Sidebar Olverlay -->

            <!-- Start Main Content -->
            <div class="main-container flex mx-auto">

                <?php include('includes/sideBar.php') ?>

                <!-- Start Content Area -->
                <div class="main-content flex-1">
                    <?php include('includes/topBar.php'); ?>

                    <!-- Start Content -->
                    <div class="h-[calc(100vh-60px)] relative overflow-y-auto overflow-x-hidden p-5 sm:p-7 space-y-5">
                        <div class="grid grid-cols-1">
                            <div>
                                <ul class="flex flex-wrap items-center text-sm font-semibold space-x-2.5">
                                    <li class="flex items-center space-x-2.5 text-gray hover:text-dark dark:hover:text-white duration-300">
                                        <a href="javaScript:;">Complaints</a>
                                        <svg class="text-gray/50" width="8" height="10" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.5" d="M1.33644 0H4.19579C4.60351 0 5.11318 0.264045 5.32903 0.589888L7.83532 4.3427C8.07516 4.70787 8.05119 5.2809 7.77538 5.6236L4.66949 9.5C4.44764 9.77528 3.96795 10 3.6022 10H1.33644C0.287156 10 -0.348385 8.92135 0.203241 8.08427L1.86409 5.59551C2.08594 5.26405 2.08594 4.72472 1.86409 4.39326L0.203241 1.90449C-0.348385 1.07865 0.293152 0 1.33644 0Z" fill="currentColor" />
                                        </svg>
                                    </li>
                                    <li>Complaint List</li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex flex-col gap-5 min-h-[calc(100vh-188px)] sm:min-h-[calc(100vh-204px)]">

                            <div class="grid grid-cols-1 gap-5">
                                <div class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 p-5 rounded-lg">
                                    <h2 class="text-base font-semibold mb-4">Student List</h2>
                                    <div class="overflow-auto">
                                        <table class="min-w-[640px] w-full product-table">
                                            <thead>
                                                <tr class="text-left">
                                                    <th>S.N </th>
                                                    <th>Student ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th> UG/PG </th>
                                                    <th>Year</th>
                                                    <th>Complain Subject</th>
                                                    <th>Complaint Status</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include('includes/connection.php');

                                                $get_pro = "SELECT*FROM complain 
            ORDER BY (CASE comp_status
            WHEN 'PENDING'   THEN 2
            ELSE 1 END) ASC , comp_time ASC ;";
                                                $run_pro = mysqli_query($con, $get_pro);
                                                $i = 0;
                                                while ($row_pro = mysqli_fetch_array($run_pro)) {

                                                    $stu_id = $row_pro['student_id'];
                                                    $stu_name = $row_pro['student_name'];
                                                    $stu_email = $row_pro['student_email'];
                                                    $stu_cat2 = $row_pro['student_cat2'];
                                                    $stu_year = $row_pro['student_year'];
                                                    $comp_sub = $row_pro['complain_sub'];
                                                    $comp_status = $row_pro['comp_status'];
                                                    $i++;
                                                ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td><?= $stu_id ?></td>
                                                        <td>
                                                            <div class="flex items-center gap-2.5">
                                                                <div class="flex-1 max-w-[200px] truncate">
                                                                    <p class="line-clamp-1 truncate"><?= $stu_name ?></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?= $stu_email ?></td>
                                                        <td><?= $stu_cat2 ?></td>
                                                        <td><?= $stu_year ?></td>
                                                        <td><?= $comp_sub ?></td>

                                                        <td><?= $comp_status ?></td>
                                                        <td><a href="view_comp.php?view_comp=<?php echo $stu_id; ?> & view_sub=<?php echo $comp_sub; ?>" class=" bg-success text-white font-bold text-xs py-2 px-3 rounded-full" style="cursor: pointer">View</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- End All Card -->

                        <!-- Start Footer -->
                        <footer class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 p-5 rounded-lg flex flex-wrap justify-center gap-3 sm:justify-between items-center">
                            <p class="font-semibold">
                                &copy;
                                <script>
                                    var year = new Date();
                                    document.write(year.getFullYear());
                                </script>
                                Fee-Management
                            </p>
                            <ul class="sm:flex items-center text-dark dark:text-white gap-4 sm:gap-[30px] font-semibold hidden">
                                <li><a href="javascirpt:;" class="hover:text-primary transition-all duration-300 cursor-pointer">About</a></li>
                                <li><a href="javascirpt:;" class="hover:text-primary transition-all duration-300 cursor-pointer">Support</a></li>
                                <li><a href="javascirpt:;" class="hover:text-primary transition-all duration-300 cursor-pointer">Contact Us</a></li>
                            </ul>
                        </footer>
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


    </html>

<?php } ?>