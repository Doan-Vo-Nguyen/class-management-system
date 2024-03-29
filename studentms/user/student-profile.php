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

    <title>EduTrack - Class Management System|| View Students Profile</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="notification.css">
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
                        <h3 class="page-title"> View Students Profile </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> View Students Profile</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">

                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post">
                                        <table border="1" class="table table-bordered mg-b-0">
                                            <?php
                                        $sid=$_SESSION['stuid'];
                                        $sql="SELECT * FROM student as st JOIN class as cl ON st.class_id = cl.class_id WHERE student_id=:sid";
                                        $query = $dbh -> prepare($sql);
                                        $query->bindParam(':sid',$sid,PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                        foreach($results as $row)
                                        {               ?>
                                            <tr align="center" class="table-warning">
                                                <td colspan="4" style="font-size:20px;color:blue">
                                                    Students Details</td>
                                            </tr>

                                            <tr class="table-info">
                                                <th>Student ID</th>
                                                <td><?php  echo $row->student_id;?></td>
                                                <th>Student Name</th>
                                                <td><?php  echo $row->name;?></td>
                                            </tr>
                                            <tr class="table-warning">
                                                <th>Student Class</th>
                                                <td><?php  echo $row->class_name;?> / <?php  echo $row->class_batch;?>
                                                </td>
                                                <th>Citizen ID Card</th>
                                                <td><?php  echo $row->citizen_id_card;?></td>
                                            </tr>
                                            <tr class="table-danger">
                                                <th>Date of Birth</th>
                                                <td><?php  echo $row->date;?></td>
                                                <th>Gender</th>
                                                <td><?php  echo $row->gender;?></td>
                                            </tr>

                                            <tr class="table-success">
                                                <th>Parents Name</th>
                                                <td>
                                                    <input type="text" value="<?php  echo $row->parents_name;?>"
                                                        name="pName">

                                                </td>
                                                <th>Parents Phone Number</th>
                                                <td>
                                                    <input type="text" value="<?php  echo $row->parents_phonenumber;?>"
                                                        name="pPhone">
                                                </td>
                                            </tr>
                                            <tr class=" table-primary">
                                                <th>Contact Number</th>
                                                <td>
                                                    <input type="text" value="<?php  echo $row->phone_number;?>"
                                                        name="contactNum">
                                                </td>
                                                <th>Contact Email</th>
                                                <td>
                                                    <input type="text" value="<?php  echo $row->email;?>"
                                                        name="contactEmail">
                                                </td>
                                            </tr>
                                            <tr class="table-info">
                                                <th>Address</th>
                                                <td><?php  echo $row->address;?></td>
                                                <th>Status</th>
                                                <td><?php  echo $row->status;?></td>
                                            </tr>
                                            <?php $cnt=$cnt+1;}} ?>
                                        </table>
                                        <div class="card-body d-lg-flex align-items-center">
                                            <button class="btn btn-warning" name="save_info" type="submit">Save</button>
                                            <?php
                                            try {
                                              if (isset($_POST['save_info'])) {
                                                $sid = $_SESSION['stuid'];
                                                $pname = filter_input(INPUT_POST, 'pName', FILTER_SANITIZE_STRING); // Sanitize name
                                                $pphone = filter_input(INPUT_POST, 'pPhone', FILTER_SANITIZE_STRING); // Sanitize phone
                                                $contactNum = filter_input(INPUT_POST, 'contactNum', FILTER_SANITIZE_STRING); // Sanitize contact number
                                                $contactEmail = filter_input(INPUT_POST, 'contactEmail', FILTER_VALIDATE_EMAIL); // Validate email
                                            
                                                if ($contactEmail === false) {
                                                  throw new Exception('Invalid email address provided.'); // Handle invalid email
                                                }
                                            
                                                $sql = "UPDATE student SET parents_name=:pname,parents_phonenumber=:pphone,phone_number=:contactNum,email=:contactEmail WHERE student_id=:sid";
                                                $query = $dbh->prepare($sql);
                                            
                                                $query->bindParam(':pname', $pname, PDO::PARAM_STR);
                                                $query->bindParam(':pphone', $pphone, PDO::PARAM_STR);
                                                $query->bindParam(':contactNum', $contactNum, PDO::PARAM_STR);
                                                $query->bindParam(':contactEmail', $contactEmail, PDO::PARAM_STR);
                                                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                            
                                                $query->execute();
                                                if($query == True) {
                                                    echo '<script>alert("Student information updated successfully!");</script>'; // Example alert
                                                    echo '<script>history.back()</script>';
                                                    // echo '<script>window.location.href = "student-profile.php"</script>';
                                                }else{
                                                    echo '<script>void(0)</script>';
                                                }                                                
                                              }
                                            } catch (PDOException $e) {
                                              // Error notification using chosen method (replace with your preferred notification logic)
                                              echo '<script>alert("Error updating student information: ' . $e->getMessage() . '");</script>'; // Example alert with error message
                                            }
                                        }
                                        ?>
                                        </div>
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
    <!-- End custom js for this page 
    -->
</body>

</html>