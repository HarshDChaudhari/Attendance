<?php
include "include/dbconn.php";
$curr = "Student";
if (!isset($_SESSION["login"]) || !$_SESSION["login"] || !isset($_SESSION["student"]) || !$_SESSION["student"]) {
    header('Location: login.php');
    exit;
}

$email = $_SESSION["email"];
$sql = "SELECT * FROM student WHERE `email` LIKE '$email'";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    $detail = array($row["name"], $row["enrollment_number"], $row["school"], $row["class"], $row["gender"], $row["email"], $row["phone_no"]);
}
?>

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/dashboard-analytics.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Jun 2024 06:10:35 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Student | AAS - Advance Attendance System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon1.png">

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
        include "navbar.php";
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
                            <a class="nav-link menu-link" href="?page=profile" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->


                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">FEATURES</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarPersonal" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPersonal">
                                <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Personal</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarPersonal">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="?page=profile" class="nav-link" role="button" aria-expanded="false"> Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarTimeTable" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTimeTable">
                                <i class="ri-layout-grid-line"></i> <span data-key="t-pages">Time Table</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarTimeTable">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link disabled" data-key=""> Time Table </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=attendance" class="nav-link" data-key=""> Attendance </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarExam" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarExam">
                                <i class="ri-pages-line"></i> <span data-key="t-pages">Exam</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarExam">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link disabled" data-key=""> Admit Card </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link disabled" data-key=""> Result </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link disabled" data-key=""> Supplementary Exam Fee </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link disabled" data-key=""> Old Exam Paper </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarFee" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarFee">
                                <i class="ri-rocket-line"></i> <span data-key="">Fee</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarFee">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link disabled" data-key=""> Pay Fees </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link disabled" data-key=""> Fee History </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link disabled" data-key="">Transport Fee</a>
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
                                        if ($page == 'activity') {
                                            echo "Activity";
                                        } elseif ($page == 'attendance') {
                                            echo "Attendance";
                                        } elseif ($page == 'aboutUs') {
                                            echo "About Us";
                                        }elseif ($page == 'contactUs') {
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
                                                    if ($page == 'activity') {
                                                        echo "Personal";
                                                    } elseif ($page == 'attendance') {
                                                        echo "TimeTable";
                                                    } elseif ($page == 'aboutUs') {
                                                        echo "About Us";
                                                    }elseif ($page == 'contactUs') {
                                                        echo "Contact Us";
                                                    } else {
                                                        echo "Dashboard";
                                                    }
                                                } else {
                                                    $page = '';
                                                    echo "Dashboard";
                                                }
                                                ?>
                                            </a></li>
                                        <li class="breadcrumb-item active">
                                            <?php
                                            if (isset($_GET['page'])) {
                                                $page = $_GET['page'];
                                                if ($page == 'activity') {
                                                    echo "Activity";
                                                } elseif ($page == 'attendance') {
                                                    echo "Attendance";
                                                }elseif ($page == 'aboutUs') {
                                                    echo "Abou Us";
                                                }elseif ($page == 'contactUs') {
                                                    echo "Contact Us";
                                                }else {
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



                </div>

                <?php
                if (isset($_GET['page'])) {

                    $page = $_GET['page'];
                    if ($page == 'activity') {
                        include './student/activity.php';
                    } elseif ($page == 'attendance') {
                        include './student/attendance.php';
                    }elseif ($page == 'aboutUs') {
                        include './include/aboutUs.php';
                    }elseif ($page == 'contactUs') {
                        include './include/contactUs.php';
                    } else {
                        include './student/profile.php';
                    }
                } else {
                    include './student/profile.php';
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

    <!-- <script src="assets/libs/chart.js/chart.umd.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- chartjs init -->
    <!-- <script src="assets/js/pages/chartjs.init.js"></script> -->

    <!-- App js -->

    <script>
        var ctx = document.getElementById('pieChart').getContext('2d');

        // Define the data for the pie chart
        var data = {
            labels: ['Present', 'Absent'],
            datasets: [{
                data: [<?php echo $present ?>, <?php echo ($total - $present) ?>],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Define the options for the pie chart
        var options = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var data = tooltipItem.dataset.data;
                            var total = data.reduce(function(accumulator, currentValue) {
                                return accumulator + currentValue;
                            }, 0);
                            var currentValue = data[tooltipItem.dataIndex];
                            var percentage = ((currentValue / total) * 100).toFixed(2);
                            return tooltipItem.label + ': ' + percentage + '%';
                        }
                    }
                }
            }
        };

        // Create the pie chart
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    </script>
    <script src="assets/js/app.js"></script>


</body>


<!-- Mirrored from themesbrand.com/velzon/html/master/dashboard-analytics.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Jun 2024 06:10:36 GMT -->

</html>