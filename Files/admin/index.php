<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dashhub-tail.netlify.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 20 Jul 2024 16:15:11 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Premium Tailwind CSS Admin & Dashboard Template" />
    <meta name="author" content="Webonzer" />

    <!-- Site Tiltle -->
    <title>Admin Profile</title>

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
            <!-- Start Sidebar -->
            <?php include('includes/sideBar.php') ?>
            <!-- End sidebar -->

            <!-- Start Content Area -->
            <!-- <div class="h-[calc(100vh-60px)] relative overflow-y-auto overflow-x-hidden p-5 sm:p-7 space-y-5">

        
            </div> -->


            <div class="main-content flex-1">
                <?php require_once('includes/topBar.php'); ?>


                <div class="h-[calc(100vh-60px)] relative overflow-y-auto overflow-x-hidden p-5 sm:p-7 space-y-5">

                    <!-- Start All Card -->
                    <div class="flex flex-col gap-5 min-h-[calc(100vh-188px)] sm:min-h-[calc(100vh-204px)]">
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 p-5 rounded-lg space-y-6">
                                    <div class="flex items-center gap-2.5">
                                        <span>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.6679 7C15.6679 6.58579 16.0037 6.25 16.4179 6.25H22C22.4142 6.25 22.75 6.58579 22.75 7V12.5458C22.75 12.96 22.4142 13.2958 22 13.2958C21.5858 13.2958 21.25 12.96 21.25 12.5458V7.75H16.4179C16.0037 7.75 15.6679 7.41421 15.6679 7Z" fill="#267DFF" />
                                                <path opacity="0.3" d="M20.1873 7.75L14.0916 13.8027C13.5778 14.3134 13.2447 14.6423 12.9673 14.8527C12.7073 15.0499 12.5857 15.072 12.5052 15.072C12.4247 15.072 12.3031 15.0499 12.0431 14.8526C11.7658 14.6421 11.4327 14.3132 10.919 13.8024L10.6448 13.5296C10.1755 13.063 9.77105 12.6607 9.40375 12.382C9.01003 12.0832 8.57254 11.8572 8.03395 11.8574C7.49535 11.8576 7.05802 12.0839 6.66452 12.383C6.29742 12.662 5.89326 13.0645 5.42433 13.5315L1.47078 17.4686C1.17728 17.7608 1.17628 18.2357 1.46856 18.5292C1.76084 18.8227 2.23571 18.8237 2.52922 18.5314L6.44789 14.6292C6.96167 14.1175 7.29478 13.7881 7.57219 13.5772C7.83228 13.3795 7.95393 13.3574 8.03449 13.3574C8.11506 13.3573 8.23672 13.3794 8.49695 13.5769C8.77452 13.7875 9.10787 14.1167 9.62203 14.628L9.89627 14.9007C10.3651 15.367 10.7692 15.7688 11.1362 16.0474C11.5297 16.346 11.9668 16.5719 12.505 16.572C13.0432 16.572 13.4804 16.3462 13.8739 16.0477C14.241 15.7692 14.6452 15.3674 15.1142 14.9013L21.2501 8.80858V7.75H20.1873Z" fill="#267DFF" />
                                            </svg>
                                        </span>
                                        <p class="font-semibold">Total Students</p>
                                    </div>
                                    <div class="flex items-center gap-2.5 xl:gap-[30px] flex-wrap">
                                        <span class="text-lg font-bold">
                                            <?= $studentsTotal ?>
                                        </span>
                                        <p class="flex items-center gap-2.5 text-gray flex-wrap">Students
                                            <span class="bg-success/10 text-success flex items-center gap-1 rounded-full py-1 px-2.5 text-xs">
                                                <span class="">
                                                    <svg width="10" height="10" class="inline-block" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.73684 9.21053C5.73684 9.64654 5.38338 10 4.94737 10C4.51135 10 4.15789 9.64654 4.15789 9.21053L4.15789 2.69543L2.34772 4.50561C2.03941 4.81392 1.53954 4.81392 1.23123 4.50561C0.922923 4.1973 0.922923 3.69743 1.23123 3.38913L4.38913 0.231232C4.53718 0.0831764 4.73799 -1.83028e-08 4.94737 0C5.15675 1.83066e-08 5.35756 0.0831765 5.50561 0.231232L8.66351 3.38913C8.97181 3.69743 8.97181 4.1973 8.66351 4.50561C8.3552 4.81392 7.85533 4.81392 7.54702 4.50561L5.73684 2.69543V9.21053Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 p-5 rounded-lg space-y-6">
                                    <div class="flex items-center gap-2.5">
                                        <span>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.6679 7C15.6679 6.58579 16.0037 6.25 16.4179 6.25H22C22.4142 6.25 22.75 6.58579 22.75 7V12.5458C22.75 12.96 22.4142 13.2958 22 13.2958C21.5858 13.2958 21.25 12.96 21.25 12.5458V7.75H16.4179C16.0037 7.75 15.6679 7.41421 15.6679 7Z" fill="#267DFF" />
                                                <path opacity="0.3" d="M20.1873 7.75L14.0916 13.8027C13.5778 14.3134 13.2447 14.6423 12.9673 14.8527C12.7073 15.0499 12.5857 15.072 12.5052 15.072C12.4247 15.072 12.3031 15.0499 12.0431 14.8526C11.7658 14.6421 11.4327 14.3132 10.919 13.8024L10.6448 13.5296C10.1755 13.063 9.77105 12.6607 9.40375 12.382C9.01003 12.0832 8.57254 11.8572 8.03395 11.8574C7.49535 11.8576 7.05802 12.0839 6.66452 12.383C6.29742 12.662 5.89326 13.0645 5.42433 13.5315L1.47078 17.4686C1.17728 17.7608 1.17628 18.2357 1.46856 18.5292C1.76084 18.8227 2.23571 18.8237 2.52922 18.5314L6.44789 14.6292C6.96167 14.1175 7.29478 13.7881 7.57219 13.5772C7.83228 13.3795 7.95393 13.3574 8.03449 13.3574C8.11506 13.3573 8.23672 13.3794 8.49695 13.5769C8.77452 13.7875 9.10787 14.1167 9.62203 14.628L9.89627 14.9007C10.3651 15.367 10.7692 15.7688 11.1362 16.0474C11.5297 16.346 11.9668 16.5719 12.505 16.572C13.0432 16.572 13.4804 16.3462 13.8739 16.0477C14.241 15.7692 14.6452 15.3674 15.1142 14.9013L21.2501 8.80858V7.75H20.1873Z" fill="#267DFF" />
                                            </svg>
                                        </span>
                                        <p class="font-semibold">Complaints</p>
                                    </div>
                                    <div class="flex items-center gap-2.5 xl:gap-[30px] flex-wrap">
                                        <span class="text-lg font-bold">
                                            <?= $totalComplaints ?>
                                        </span>
                                        <p class="flex items-center gap-2.5 text-gray flex-wrap">Complaints Today
                                            <span class="bg-success/10 text-success flex items-center gap-1 rounded-full py-1 px-2.5 text-xs">
                                                <span class="">
                                                    <svg width="10" height="10" class="inline-block" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.73684 9.21053C5.73684 9.64654 5.38338 10 4.94737 10C4.51135 10 4.15789 9.64654 4.15789 9.21053L4.15789 2.69543L2.34772 4.50561C2.03941 4.81392 1.53954 4.81392 1.23123 4.50561C0.922923 4.1973 0.922923 3.69743 1.23123 3.38913L4.38913 0.231232C4.53718 0.0831764 4.73799 -1.83028e-08 4.94737 0C5.15675 1.83066e-08 5.35756 0.0831765 5.50561 0.231232L8.66351 3.38913C8.97181 3.69743 8.97181 4.1973 8.66351 4.50561C8.3552 4.81392 7.85533 4.81392 7.54702 4.50561L5.73684 2.69543V9.21053Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <!-- End Content Area -->
        </div>

        <!-- <footer class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 p-5 rounded-lg flex flex-wrap justify-center gap-3 sm:justify-between items-center">
            <p class="font-semibold">
                &copy;
                <script>
                    var year = new Date();
                    document.write(year.getFullYear());
                </script>
                Fee-Management
            </p>
           
        </footer> -->
    </div>
    <!-- End Layout -->

    <!-- All javascirpt -->
    <!-- Alpine js -->
    <script src="assets/js/alpine-collaspe.min.js"></script>
    <script src="assets/js/alpine-persist.min.js"></script>
    <script src="assets/js/alpine.min.js" defer></script>

    <!-- ApexCharts js -->
    <script src="assets/js/apexcharts.js"></script>
    <script src="assets/js/apex-analytics.js"></script>

    <!-- Custom js -->
    <script src="assets/js/custom.js"></script>
</body>


<!-- Mirrored from dashhub-tail.netlify.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 20 Jul 2024 16:16:16 GMT -->

</html>