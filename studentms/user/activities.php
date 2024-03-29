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

    <title>EduTrack - Class Management System|| Activities</title>
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
                        <h3 class="page-title"> Activities </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> View Activities</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST">
                                        <table border="1px" class="table table-bodered mg-b-0"
                                            style="border-collapse: collapse;">
                                            <tr align="center" class="table-warning">
                                                <th>HKI</th>
                                            </tr>
                                            <tr class="table-info">
                                                <th>Student ID</th>
                                                <th>Activity name</th>
                                                <th>Semester</th>
                                                <th>Proof</th>
                                                <th>Status</th>
                                            </tr>
                                            <?php
                                        $sql="SELECT tsa.activity_id,tsa.student_id,ac.activity_name,tsa.semester,tsa.proof,tsa.status FROM training_score_activities as tsa JOIN student as st ON tsa.student_id=st.student_id JOIN activities as ac ON tsa.activity_id = ac.activity_id
                                        WHERE tsa.student_id=:stuid";
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
                                                <td align="center"><?php  echo $row->student_id;?></td>
                                                <td align="center"><?php  echo $row->activity_name;?></td>
                                                <td align="center"><?php  echo $row->semester;?></td>
                                                <td align="center">
                                                    <input type="file" name="filename">
                                                    <input type="submit" name="submit_upload" value="Upload">
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
                                                    } else {
                                                        echo "Error: Unable to read image file.";
                                                    }
                                                    ?>
                                                    <!-- Display the image using an img tag -->
                                                    <img src="<?php echo $dataURI; ?>" alt="Proof Image" />
                                                </td>
                                                <td align="center"><?php  echo $row->status;?></td>
                                                <!-- <td align="center">
                                                <img src="<?php  echo $row->result;?>" title="You have passed">
                                            </td> -->
                                            </tr>
                                            <?php $cnt=$cnt+1;}} else { ?>
                                            <tr>
                                                <th colspan="2" style="color:red;">No Activity Found</th>
                                            </tr>
                                            <?php 
                                        } 
                                        if(isset($_POST['submit_upload'])) {
                                            $filename = $_POST['filename'];
                                            $activity_id = $row->activity_id; // Assuming $row->activity_id contains the activity ID you want to associate with the proof.
                                            $student_id = $row->student_id; // Assuming $row->student_id contains the student ID.
                                            $semester = $row->semester; // Assuming $row->semester contains the semester.
                                        
                                            $sql = "UPDATE training_score_activities SET proof = :proof WHERE activity_id = :activity_id AND student_id = :student_id AND semester = :semester";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':proof', $filename, PDO::PARAM_STR);
                                            $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);
                                            $query->bindParam(':student_id', $student_id, PDO::PARAM_STR);
                                            $query->bindParam(':semester', $semester, PDO::PARAM_STR);
                                                                                
                                            if ($query->execute()) {
                                                echo "<script>alert('Activity proof uploaded successfully.');</script>";
                                                echo '<script>history.back()</script>';
                                            } else {
                                                echo "<script>alert('Something went wrong.');</script>";
                                                echo '<script>void(0)</script>';
                                            }                                            
                                        }
                                        ?>
                                        </table>
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
    <!-- End custom js for this page -->
</body>

</html><?php }  ?>