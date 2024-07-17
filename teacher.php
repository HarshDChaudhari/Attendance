<?php
include "include/dbconn.php";
$curr = "Teacher";
if (!isset($_SESSION["login"]) || !$_SESSION["login"] || !isset($_SESSION["teacher"]) || !$_SESSION["teacher"]) {
    header('Location: login.php');
    exit;
}

$email = $_SESSION["email"];
$sql = "SELECT * FROM `teacher` WHERE `email` LIKE '$email'";

$result = mysqli_query($conn, $sql);
$detail = array();
if ($row = mysqli_fetch_assoc($result)) {
    $detail = array($row["name"], $row["email"], $row["school"], $row["class"], $row["phone_no"]);
}

function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/dashboard-analytics.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Jun 2024 06:10:35 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Teacher | AAS - Advance Attendance System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- plugin css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php
        include "navBar.php";
        ?>

        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                                It!</button>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="?page=profile" class="logo logo-dark">
                    <span class="logo-sm ">
                        <img src="assets/images/logo-sm.png" alt="" height="22px">
                    </span>
                    <span class="logo-lg ">
                        <img src="assets/logos/AAA-White23.png" alt="" height="150px">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="?page=profile" class="logo logo-light">
                    <span class="logo-sm ">
                        <img src="assets/images/logo-sm.png" alt="" height="22px">
                    </span>
                    <span class="logo-lg ">
                        <img src="assets/logos/AAA-White23.png" alt="" height="150px">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>


            <div id="scrollbar">
                <div class="container-fluid">


                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="?page=profile" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->


                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">FEATURES</span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Personal</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarAuth">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="?page=profile" class="nav-link" role="button" aria-expanded="false"> Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarTimeTable" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTimeTable">
                                <i class="ri-layout-grid-line"></i> <span data-key="t-pages">Attendance</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarTimeTable">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="?page=takeAttendance" class="nav-link" data-key=""> Take Attendance </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=viewAttendance" class="nav-link" data-key=""> View Attendance </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarExam" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarExam">
                                <i class="ri-pages-line"></i> <span data-key="t-pages">Student</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarExam">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="?page=addStudent" class="nav-link" data-key=""> Register New Student </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=viewStudent" class="nav-link" data-key=""> View Student </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="">Contact Us</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="?page=contactUs" role="button" aria-expanded="false" aria-controls="sidebarContactUs">
                                <i class="ri-pencil-ruler-2-line"></i> <span data-key="t-base-ui">Contact Us</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="?page=aboutUs" role="button" aria-expanded="false" aria-controls="sidebarAboutUs">
                                <i class="ri-stack-line"></i> <span data-key="t-advance-ui">About Us</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">
                                    <?php
                                    if (isset($_GET['page'])) {


                                        $page = $_GET['page'];

                                        if ($page == 'takeAttendance') {
                                            echo "Attendance";
                                        } elseif ($page == 'viewAttendance') {
                                            echo "Attendance";
                                        } elseif ($page == 'addStudent') {
                                            echo "Student";
                                        } elseif ($page == 'viewStudent') {
                                            echo "Student";
                                        } elseif ($page == 'aboutUs') {
                                            echo "Abou Us";
                                        } elseif ($page == 'contactUs') {
                                            echo "Contact Us";
                                        } else {
                                            echo "Dashboard";
                                        }
                                    } else {
                                        $page = '';
                                        echo "Dashboard";
                                    }

                                    ?>
                                </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">
                                                <?php
                                                if (isset($_GET['page'])) {
                                                    $page = $_GET['page'];
                                                    if ($page == 'takeAttendance') {
                                                        echo "Attendance";
                                                    } elseif ($page == 'viewAttendance') {
                                                        echo "Attendance";
                                                    } elseif ($page == 'addStudent') {
                                                        echo "Student";
                                                    } elseif ($page == 'viewStudent') {
                                                        echo "Student";
                                                    } elseif ($page == 'aboutUs') {
                                                        echo "Abou Us";
                                                    } elseif ($page == 'contactUs') {
                                                        echo "Contact Us";
                                                    } else {
                                                        echo "Dashboard";
                                                    }
                                                } else {
                                                    $page = '';
                                                    echo "Dashboard";
                                                }

                                                ?></a></li>
                                        <li class="breadcrumb-item active">
                                            <?php
                                            if (isset($_GET['page'])) {
                                                $page = $_GET['page'];
                                                if ($page == 'takeAttendance') {
                                                    echo "Take Attendance";
                                                } elseif ($page == 'viewAttendance') {
                                                    echo "View Attendance";
                                                } elseif ($page == 'addStudent') {
                                                    echo "Register Student";
                                                } elseif ($page == 'viewStudent') {
                                                    echo "View Student";
                                                } elseif ($page == 'aboutUs') {
                                                    echo "Abou Us";
                                                } elseif ($page == 'contactUs') {
                                                    echo "Contact Us";
                                                } else {
                                                    echo "Profile";
                                                }
                                            } else {
                                                $page = '';
                                                echo "Profile";
                                            }

                                            ?></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <?php
                    if (isset($_GET['page'])) {

                        $page = $_GET['page'];
                        if ($page == 'takeAttendance') {
                            include './teacher/takeAttendance.php';
                        } elseif ($page == 'viewAttendance') {
                            include './teacher/viewAttendance.php';
                        } elseif ($page == 'addStudent') {
                            include './teacher/addStudent.php';
                        } elseif ($page == 'viewStudent') {
                            include './teacher/viewStudent.php';
                        } elseif ($page == 'aboutUs') {
                            include './include/aboutUs.php';
                        } elseif ($page == 'contactUs') {
                            include './include/contactUs.php';
                        } else {
                            include './teacher/profile.php';
                        }
                    } else {
                        include './teacher/profile.php';
                    }

                    ?>

                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © GEC Bhavnagar.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Devloped by Team-1 & Team-2
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->



        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

        <!--preloader-->
        <div id="preloader">
            <div id="status">
                <div class="spinner-border text-primary avatar-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>


        <!-- JAVASCRIPT -->
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
        <script src="assets/js/plugins.js"></script>

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Vector map-->
        <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
        <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

        <!-- Dashboard init -->
        <script src="assets/js/pages/dashboard-analytics.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/master/dashboard-analytics.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Jun 2024 06:10:36 GMT -->

</html>