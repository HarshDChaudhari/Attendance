<?php
    include "include/dbconn.php";
    $curr = "Admin";
    if (!isset($_SESSION["login"]) || !$_SESSION["login"] || !isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
        header('Location: login.php');
        exit;
    }

    $email = $_SESSION["email"];
    $sql = "SELECT * FROM `admin` WHERE `email` LIKE '$email'";

    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)){
        $detail = array($row["name"], $row["email"], $row["school"]);
        // $school = $details[2];
    }

    function sanitize_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/dashboard-analytics.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Jun 2024 06:10:35 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Admin | AAS - Advance Attendance System</title>
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

        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm ">
                    <img src="assets/images/logo-sm.png" alt="" height="22px">

                    </span>
                    <span class="logo-lg ">
                        <img src="assets/logos/AAA-White23.png" alt="" height="150px">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm ">
                    <img src="assets/images/logo-sm.png" alt="" height="22px">

                    </span>
                    <span class="logo-lg ">
                        <img src="assets/logos/AAA-White23.png" alt="" height="150px">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
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
                            <a class="nav-link menu-link" href="?page=profile" role="button" aria-expanded="false"
                                aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->


                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">FEATURES</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Personal</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarAuth">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="?page=profile"class="nav-link" role="button" aria-expanded="false"> Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarTeacher" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarTeacher">
                                <i class="ri-layout-grid-line"></i> <span data-key="t-pages">Teacher</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarTeacher">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="?page=addTeacher" class="nav-link" data-key=""> Add New Teacher </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=viewTeacher" class="nav-link" data-key=""> View Teachers </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarClass" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarClass">
                                <i class="ri-pages-line"></i> <span data-key="t-pages">Class</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarClass">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="?page=classAllocation" class="nav-link" data-key=""> Class Allocation </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=classDetails" class="nav-link" data-key=""> Class Details </a>
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
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">
                                <?php
            if(isset($_GET['page'])){
            $page = $_GET['page'];
            if ($page == 'addTeacher') {
                echo "Teacher";
            }
            elseif($page == 'viewTeacher'){
                echo "Teacher";
            }
            elseif($page == 'classAllocation'){
                echo "Class";
            }
         
            elseif($page == 'classDetails'){
                echo "Class";
            }elseif ($page == 'aboutUs') {
                echo "Abou Us";
            }elseif ($page == 'contactUs') {
                echo "Contact Us";
            }
            else {
                 echo "Dashboard";
            }
        }else{
            $page = '';
            echo "Dashboard";
        }
        ?>
                                </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">
                                        <?php
            if(isset($_GET['page'])){
                                      
            $page = $_GET['page'];
            if ($page == 'addTeacher') {
                echo "Teacher";
            }
            elseif($page == 'viewTeacher'){
                echo "Teacher";
            }
            elseif($page == 'classAllocation'){
                echo "Class";
            }
            elseif($page == 'classDetails'){
                echo "Class";
            }elseif ($page == 'aboutUs') {
                echo "Abou Us";
            }elseif ($page == 'contactUs') {
                echo "Contact Us";
            }
            else {
                 echo "Dashboard";
            }
        }else{
            $page = '';
            echo "Dashboard";
        }
        ?>
                                        </a></li>
                                        <li class="breadcrumb-item active">
                                        <?php
             if(isset($_GET['page'])){                            
            $page = $_GET['page'];
            if ($page == 'addTeacher') {
                echo "Add Teacher";
            }
            elseif($page == 'viewTeacher'){
                echo "View Teacher";
            }
            elseif($page == 'classAllocation'){
                echo "Class Allocation";
            }
            elseif($page == 'classDetails'){
                echo "Class Details";
            }elseif ($page == 'aboutUs') {
                echo "Abou Us";
            }elseif ($page == 'contactUs') {
                echo "Contact Us";
            }
            else {
                 echo "Profile";
            }
        }else{
            $page = '';
            echo "Profile";
        }

        ?> 
       </li>
        </ol>
        </div>
    </div>
    </div>
</div>
                    <!-- end page title -->



                             
            <?php
         if(isset($_GET['page'])){

            $page = $_GET['page'];
            if ($page == 'addTeacher') {
                include './admin/addTeacher.php';
            }
            elseif($page == 'viewTeacher'){
                include './admin/viewTeacher.php';
            }
            elseif($page == 'classAllocation'){
                include './admin/classAllocation.php';
            }
            elseif($page == 'classDetails'){
                include './admin/classDetails.php';
            }elseif ($page == 'aboutUs') {
                include './include/aboutUs.php';
            }elseif ($page == 'contactUs') {
                include './include/contactUs.php';
            }
             else {
                include './admin/profile.php';
            }
        }      
        else {
        include './admin/profile.php';
    }
        ?>


            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © GEC Bhavnagar.
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

<?php
    if($_SESSION["login"] and isset($_POST["teacher_add"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone_no = $_POST["phone_no"];
        $password = $_POST["password"];

        $sql = "INSERT INTO teacher (name, email, school, phone_no, password) VALUES ('$name', '$email', '$detail[2]', '$phone_no', '$password')";

        if(mysqli_query($conn, $sql)){
            echo "<h3>  Image uploaded successfully!</h3>";
                echo "<script type = \"text/javascript\">
                    window.location = (\"admin.php\")
                    </script>";
        } else {
                echo "<h3>  Failed to upload image!</h3>";
        }
    }
?>