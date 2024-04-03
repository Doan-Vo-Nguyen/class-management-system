<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['login']==0)) {
  header('location:logout.php');
  } else{
   if(isset($_POST['submit']))
  {
 $cname=$_POST['cname'];
 $section=$_POST['section'];
 $eid=$_GET['editid'];

$sql="UPDATE class SET class_name=:cname,Section=:section WHERE ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':cname',$cname,PDO::PARAM_STR);
$query->bindParam(':section',$section,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("Class has been updated")</script>';
}

  ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Class Management System|| Manage Class</title>
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
                        <h3 class="page-title"> Manage Class </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Manage Class</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Manage Class</h4>
                                    <form class="forms-sample" method="post">
                                        <?php
                                        $eid=$_GET['editid'];
                                        $sql="SELECT * FROM class where class_id=$eid";
                                        $query = $dbh -> prepare($sql);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                        foreach($results as $row)
                                        {               ?>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Class Name</label>
                                            <input type="text" name="cname"
                                                value="<?php  echo htmlentities($row->class_name);?>"
                                                class="form-control" required='true'>
                                        </div>
                                        <!-- <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button> -->
                                        <div class="form-group" id="table-class">
                                            <table class="table table-bordered table-hover data-tables">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Student Name</th>
                                                        <th>Gender</th>
                                                        <th>Date of Birth</th>
                                                        <th>Address</th>
                                                        <th>District</th>
                                                        <th>Province</th>
                                                        <th>Phone Number</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql2 = "SELECT * FROM student WHERE class_id=:eid ORDER BY name ASC";
                                                    $query2 = $dbh -> prepare($sql2);
                                                    $query2->bindParam(':eid',$eid,PDO::PARAM_STR);
                                                    $query2->execute();
                                                    $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query2->rowCount() > 0)
                                                    {
                                                        foreach($results2 as $row1)
                                                    {               ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt);?></td>
                                                        <td><?php  echo htmlentities($row1->name);?></td>
                                                        <td><?php  echo htmlentities($row1->gender);?></td>
                                                        <td><?php  echo htmlentities($row1->date);?></td>
                                                        <td><?php  echo htmlentities($row1->address);?></td>
                                                        <td><?php  echo htmlentities($row1->district);?></td>
                                                        <td><?php  echo htmlentities($row1->province);?></td>
                                                        <td><?php  echo htmlentities($row1->phone_number);?></td>
                                                        <td><a
                                                                href="edit-student.php?subid=<?php echo htmlentities ($row1->id);?>">Edit</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <?php $cnt=$cnt+1;}}}} ?>
                                            </table>
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
    <!-- End custom js for this page -->
</body>

</html><?php }  ?>