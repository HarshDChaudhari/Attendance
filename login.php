<?php
include 'include/dbconn.php';

function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = sanitize_input($_POST["who"]);
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);

    $sql = "SELECT * FROM $db WHERE `email` LIKE '$email'";

    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    if (isset($result)) {
        if ($result["password"] == $password) {
            $_SESSION["login"] = TRUE;
            $_SESSION["$db"] = TRUE;
            $_SESSION["email"] = $email;
            echo "<script type='text/javascript'>
                    window.location = '$db.php';
                  </script>";
        }
    } else {
        $error_message = "Invalid Username/Password!";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<!-- Mirrored from themesbrand.com/velzon/html/master/auth-signin-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Jun 2024 06:11:18 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Sign In | AAS - Advance Attendance System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

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
    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container d-flex justify-content-center">
                <div class="row">
                    <div class=" card  ">
                        <div class="p-lg-5 p-4">
                            <div>
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to Advance Attendance System.</p>
                            </div>

                            <div class="mt-4">
                                <form action="login.php" method="post">

                                    <div class="btn-group material-shadow no-border">
                                        <select name="who" id="who" class="p-1 " style="width:100px;">
                                            <option value="admin">Admin </option>
                                            <option value="teacher">Teacher</option>
                                            <option value="student">Student</option>
                                        </select>
                                    </div><!-- /btn-group -->

                                    <div class="mb-3 mt-4">
                                        <label for="username" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password" required />
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" type="button" id="password-addon">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" checked />
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Sign In
                                        </button>
                                    </div>
                                </form>
                            </div>


                            <?php
                            if (isset($error_message)) {
                                echo "<div class='alert alert-danger mt-3'>$error_message</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer galaxy-border-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">
                                &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                GEC Bhavnagar
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>
</body>

<!-- Mirrored from themesbrand.com/velzon/html/master/auth-signin-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Jun 2024 06:11:18 GMT -->

</html>