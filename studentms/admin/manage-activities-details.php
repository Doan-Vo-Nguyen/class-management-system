<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['login']==0)) {
    header('location:logout.php');
} else{
   // Code for deletion
    if(isset($_GET['delid']))
    {
        $rid=intval($_GET['delid']);
        $sql="DELETE FROM class where class_id=:rid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->execute();
        echo "<script>swal('Data deleted');</script>";
        echo "<script>window.location.href = 'manage-class.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Class Management System|||Manage Activities</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- End layout styles -->

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
                        <h3 class="page-title"> Manage Activities </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Manage Activities</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-items-center mb-4">
                                        <h4 class="card-title mb-sm-0">Manage Activities</h4>
                                        <a href="#" class="text-dark ml-auto mb-3 mb-sm-0"> View all Activities</a>
                                    </div>
                                    <div class="table-responsive border rounded p-1">
                                        <table class="table" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <th class="font-weight-bold border-right">S.No</th>
                                                    <th class="font-weight-bold border-right">Student ID</th>
                                                    <th class="font-weight-bold border-right">Student Name</th>
                                                    <th class="font-weight-bold border-right">Class Name</th>
                                                    <th class="font-weight-bold border-right">Activities Name</th>
                                                    <th class="font-weight-bold border-right">Semester</th>
                                                    <th class="font-weight-bold border-right">Date</th>
                                                    <th class="font-weight-bold border-right">Location</th>
                                                    <th class="font-weight-bold border-right">Proof</th>
                                                    <th class="font-weight-bold border-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['pageno'])) {
                                                    $pageno = $_GET['pageno'];
                                                } else {
                                                    $pageno = 1;
                                                }
                                            // Formula for pagination
                                                $eidcl= $_GET['editid'];
                                                $no_of_records_per_page =15;
                                                $offset = ($pageno-1) * $no_of_records_per_page;
                                                $ret = "SELECT * FROM training_score_activities";
                                                $query1 = $dbh -> prepare($ret);
                                                $query1->execute();
                                                $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                                                $total_rows=$query1->rowCount();
                                                $total_pages = ceil($total_rows / $no_of_records_per_page);
                                                $sql = "SELECT * FROM training_score_activities as tsa
                                                JOIN activities as act ON tsa.activity_id = act.activity_id
                                                JOIN class as cl ON tsa.class_id = cl.class_id
                                                JOIN student as st ON tsa.student_id = st.student_id
                                                JOIN admin AS adm ON adm.manage_class = cl.class_id
                                                WHERE tsa.class_id = :eidcl AND adm.manage_class = :ad_id LIMIT $offset, $no_of_records_per_page";
                                                $query = $dbh -> prepare($sql);
                                                $query->bindParam(':eidcl', $eidcl, PDO::PARAM_STR);
                                                $query->bindParam(':ad_id', $_SESSION['ad_id'], PDO::PARAM_STR);
                                                $query->execute();
                                                $results=$query->fetchAll(PDO::FETCH_OBJ);

                                                $cnt=1;
                                                if($query->rowCount() > 0)
                                                {
                                                foreach($results as $row)
                                                {               ?>
                                                <tr>
                                                    <td class="border-right"><?php echo htmlentities($cnt);?></td>
                                                    <td class="border-right">
                                                        <?php  echo htmlentities($row->student_id);?></td>
                                                    <td class="border-right"><?php  echo htmlentities($row->name);?>
                                                    </td>
                                                    <td class="border-right">
                                                        <?php  echo htmlentities($row->class_name);?></td>
                                                    <td class="border-right">
                                                        <?php  echo htmlentities($row->activity_name);?></td>
                                                    <td class="border-right"><?php  echo htmlentities($row->semester);?>
                                                    </td>
                                                    <td class="border-right">
                                                        <?php  echo htmlentities($row->activity_date);?>
                                                    </td>
                                                    <td class="border-right"><?php  echo htmlentities($row->location);?>
                                                    </td>
                                                    <td class="border-right">
                                                        <?php  echo $row->proof;
                                                        // Directory where the images are stored
                                                        $imageDirectory = 'D:/QNU/44B/Hoạt động/SetAvatar_TLKhoaCNTT/';

                                                        // Fetch the filename of the image from the object
                                                        $imageFilename = $row->proof;

                                                        // Construct the full path to the image file
                                                        $imagePath = $imageDirectory . $imageFilename;

                                                        // Read the image file
                                                        $imageData = file_get_contents($imagePath);

                                                        if ($imageData !== false) {
                                                            // Generate the base64 encoded image data
                                                            $imageBase64 = base64_encode($imageData);
                                                        
                                                            // Determine the image MIME type (JPEG)
                                                            $imageMimeType = 'image/jpeg';
                                                        
                                                            // Construct the data URI for the image
                                                            $dataURI = 'data:' . $imageMimeType . ';base64,' . $imageBase64;
                                                            ?>
                                                        <!-- Display the image using an img tag -->
                                                        <img src="<?php echo $dataURI; ?>" alt="Proof Image" />
                                                        <?php
                                                        } else {
                                                            echo "No images have been uploaded yet";
                                                        }
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <form method="post">
                                                            <div>
                                                                <?php
                                                                if(empty($row->proof)) {
                                                                    ?>
                                                                <button class="btn btn-primary mr-2" type="submit"
                                                                    name="submit" disabled>Confirm</button>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <button class="btn btn-primary mr-2" type="submit"
                                                                    name="submit">Confirm</button>
                                                                <?php
                                                                }?>

                                                            </div>
                                                        </form>
                                                        <?php 
                                                            if(isset($_POST['submit']))
                                                            {
                                                                $sql="UPDATE training_score_activities SET status = 'Confirm' WHERE student_id='$row->student_id' and activity_id='$row->activity_id'";
                                                                $query = $dbh->prepare($sql);
                                                                $query->execute();
                                                                echo "<script>swal('Student has been confirmed');</script>";
                                                                echo "<script>window.location.href = 'manage-activities.php'</script>";
                                                            }
                                                        ?>
                                                    </td>
                                                </tr><?php $cnt=$cnt+1;}} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div align="left">
                                        <ul class="pagination">
                                            <li><a href="?pageno=1"><strong>First></strong></a></li>
                                            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                                <a
                                                    href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong
                                                        style="padding-left: 10px">Prev></strong></a>
                                            </li>
                                            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                                <a
                                                    href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong
                                                        style="padding-left: 10px">Next></strong></a>
                                            </li>
                                            <li><a href="?pageno=<?php echo $total_pages; ?>"><strong
                                                        style="padding-left: 10px">Last</strong></a></li>
                                        </ul>
                                    </div>
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
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <script src="../../node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- End custom js for this page -->
</body>

</html><?php }  ?>