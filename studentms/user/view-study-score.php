<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['stuid']==0)) {
  header('location:logout.php');
  } else{
   
  ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>EduTrack - Class Management System|| View Notice</title>
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
                        <h3 class="page-title"> View Study Score </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> View Study Score</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <table border="1px" class="table table-bodered mg-b-0"
                                        style="border-collapse: collapse;">
                                        <tr align="center" class="table-warning">
                                            <td colspan="4" style="font-size:20px;color:blue">
                                                Semester
                                            </td>
                                            <td colspan="4" style="font-size:20px;color:blue">
                                                HKI
                                            </td>
                                        </tr>
                                        <tr class=" table-info" style="text-align: center;">
                                            <th>STT</th>
                                            <th>Subject Name</th>
                                            <th>Process Score</th>
                                            <th>Final Score</th>
                                            <th>Ten Scale Score</th>
                                            <th>Four Scale Score</th>
                                            <th>Letter Score</th>
                                            <th>Result</th>

                                        </tr>
                                        <?php
                                        $sql="SELECT * FROM study_score as sc JOIN student as st ON sc.student_id=st.student_id JOIN subject as sb ON sc.subject_id = sb.subject_id
                                        WHERE sc.student_id=:stuid";
                                        $query = $dbh -> prepare($sql);
                                        $query->bindParam(':stuid',$_SESSION['stuid'],PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                        foreach($results as $row)
                                        {               ?>

                                        <tr class="table-info">
                                            <td align="center"><?php  echo $row->score_id;?></td>
                                            <td align="center"><?php  echo $row->subject_name;?></td>
                                            <td align="center"><?php  echo $row->process_score;?></td>
                                            <td align="center"><?php  echo $row->final_score;?></td>
                                            <td align="center"><?php  echo $row->tenscale_score;?></td>
                                            <td align="center"><?php  echo $row->fourscale_score;?></td>
                                            <td align="center"><?php  echo $row->letter_score;?></td>
                                            <td align="center">
                                                <img src="<?php  echo $row->result;?>" title="You have passed">
                                            </td>
                                        </tr>
                                        <?php $cnt=$cnt+1;}} else { ?>
                                        <tr>
                                            <th colspan="2" style="color:red;">No Student Found</th>
                                        </tr>
                                        <?php } ?>
                                    </table>
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
    <!-- End custom js for this page -->
</body>

</html><?php }  ?>