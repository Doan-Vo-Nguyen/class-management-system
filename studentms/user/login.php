<!DOCTYPE html>
<html lang="en">

<head>

    <title>EduTrack - Class Management System|| Student Login Page</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../user/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../user/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../user/vendors/css/vendor.bundle.base.css">
    <script src="../../node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../user/css/style.css">

</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="../user/images/logo.svg" alt="Picture"> EduTrack
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" id="login" method="post" name="login">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg"
                                        placeholder="Enter student ID" required="true" name="stuid"
                                        value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
                                </div>
                                <div class="form-group">

                                    <input type="password" class="form-control form-control-lg"
                                        placeholder="Enter your password" name="password" required="true"
                                        value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-success btn-block loginbtn" name="login"
                                        type="submit">Login</button>
                                </div>
                                <?php include('./check-login.php') ?>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" id="remember" class="form-check-input"
                                                name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked
                                                <?php } ?> /> Keep me signed in </label>
                                    </div>
                                    <a href="forgot-password.php" class="auth-link text-black">Forgot password?</a>
                                </div>
                                <div class="mb-2">
                                    <a href="../index.php" class="btn btn-block btn-facebook auth-form-btn">
                                        <i class="icon-social-home mr-2"></i>Back Home </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../user/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../user/js/off-canvas.js"></script>
    <script src="../user/js/misc.js"></script>
    <!-- endinject -->
</body>

</html>