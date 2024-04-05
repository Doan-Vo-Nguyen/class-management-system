<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['login']==0)) {
    header('location:logout.php');
} else{
    if(isset($_POST['submit']))
    {
        $acname=$_POST['acname'];
        $description=$_POST['desciption'];
        $date=$_POST['date'];
        $location=$_POST['location'];
        $sql="INSERT INTO activities(activity_name, description, activity_date, location, notes)values(:acname,:des, :acdate, :location, :notes)";
        $query=$dbh->prepare($sql);
        $query->bindParam(':ac',$acname,PDO::PARAM_STR);
        $query->bindParam(':des', $description, PDO::PARAM_STR);
        $query->bindParam(':acdate', $date, PDO::PARAM_STR);
        $query->bindParam(':location', $location, PDO::PARAM_STR);
        $query->bindParam(':notes', $notes, PDO::PARAM_STR);
        $query->execute();
        $LastInsertId=$dbh->lastInsertId();
        if ($LastInsertId>0) {
            echo '<script>swal("Success!", "ACtivity has been added.", "success")</script>';
            echo "<script>window.location.href ='add-class.php'</script>";
        }
        else
        {
         echo '<script>swal("Error!", "Something Went Wrong. Please try again", "error")</script>';
        }
    }
  ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Student Management System|| Add Activity</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include_once('includes/header.php');?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include_once('includes/sidebar.php');?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Add Activity </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Add Activity</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">

                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Add Activity</h4>

                                    <form class="forms-sample" method="post">

                                        <div class="form-group">
                                            <label for="exampleInputName1">ACtivity Name</label>
                                            <input type="text" name="acname" value="" class="form-control"
                                                required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Description</label>
                                            <textarea name="description" value="" class="form-control"
                                                required='true'></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword4">Date</label>
                                            <input type="date" class="form-control" name="date" value=""
                                                required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword4">Location</label>
                                            <input type="text" class="form-control" name="location" value=""
                                                required='true'>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include_once('includes/footer.php');?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <script src="../../node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- End custom js for this page -->
</body>

</html><?php }  ?>