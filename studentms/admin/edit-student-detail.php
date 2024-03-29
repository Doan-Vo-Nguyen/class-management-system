<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['login']==0)) {
  header('location:logout.php');
} else{
  if(isset($_POST['submit']))
  {
    $stuname=$_POST['stuname'];
    $stuemail=$_POST['stuemail'];
    $stuclass=$_POST['stuclass'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $citizend_id_card = $_POST['cid'];
    $batch=$_POST['batch'];
    $pname=$_POST['pname'];
    $pphone=$_POST['pphone'];
    $connum=$_POST['connum'];
    $address=$_POST['address'];
    $status=$_POST['status'];
    $eid=$_GET['editid'];
    $sql="UPDATE student set name=:stuname,gender=:$gender,date=:$date,address=:$address,citizen_id_card=:$cid,batch=:$batch,class=:$class,phone_number:=$pNum,email=:email,parents_name:=$parName,parents_phonenumber=:$parPhoneNum,status:=$status where ID=:eid";
    $query=$dbh->prepare($sql);
    $query->bindParam(':stuname',$stuname,PDO::PARAM_STR);
    $query->bindParam(':gender',$gender,PDO::PARAM_STR);
    $query->bindParam(':date',$dob,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':citizen_id_card',$citizend_id_card,PDO::PARAM_STR);
    $query->bindParam(':batch',$batch,PDO::PARAM_STR);
    $query->bindParam(':class',$stuclass,PDO::PARAM_STR);
    $query->bindParam(':phone_number',$connum,PDO::PARAM_STR);
    $query->bindParam(':email',$stuemail,PDO::PARAM_STR);
    $query->bindParam(':parents_name',$pname,PDO::PARAM_STR);
    $query->bindParam(':parents_phonenumber',$pphone,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->execute();
      echo '<script>alert("Student has been updated")</script>';
    }

  ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Class Management System|| Update Students</title>
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
                        <h3 class="page-title"> Update Students </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Update Students</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">

                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Update Students</h4>

                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <?php
                                        $eid=$_GET['editid'];
                                        $sql_student="SELECT * FROM student WHERE student_id=:eid";
                                        $sql_account="SELECT student_id,password FROM account WHERE student_id=:eid";
                                        $query_st = $dbh -> prepare($sql_student);
                                        $query_ac = $dbh -> prepare($sql_account);
                                        $query_st->bindParam(':eid',$eid,PDO::PARAM_STR);
                                        $query_ac->bindParam(':eid', $eid, PDO::PARAM_STR);
                                        $query_st->execute();
                                        $query_ac->execute();
                                        $results_st=$query_st->fetchAll(PDO::FETCH_OBJ);
                                        $results_ac=$query_ac->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query_st->rowCount() > 0)
                                        {
                                        foreach($results_st as $row)
                                        {               ?>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Student Name</label>
                                            <input type="text" name="stuname"
                                                value="<?php  echo htmlentities($row->name);?>" class="form-control"
                                                required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Student Email</label>
                                            <input type="text" name="stuemail"
                                                value="<?php  echo htmlentities($row->email);?>" class="form-control"
                                                required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Student Class</label>
                                            <select name="stuclass" class="form-control" required='true'>
                                                <option value="<?php  echo htmlentities($row->class);?>">
                                                    <?php echo htmlentities($row->class);?>
                                                    <?php echo htmlentities($row->batch);?>
                                                </option>
                                                <?php 
                                                $sql2 = "SELECT class,batch from student ";
                                                $query2 = $dbh -> prepare($sql2);
                                                $query2->execute();
                                                $result2=$query2->fetchAll(PDO::FETCH_OBJ);

                                                foreach($result2 as $row1)
                                                {          
                                                    ?>
                                                <option
                                                    value="
                                                    <?php echo htmlentities($row1->class);?><?php echo htmlentities($row1->batch);?>">
                                                    <?php echo htmlentities($row1->class);?>
                                                    <?php echo htmlentities($row1->batch);?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Gender</label>
                                            <select name="gender" value="" class="form-control" required='true'>
                                                <option value="<?php  echo htmlentities($row->gender);?>">
                                                    <?php  echo htmlentities($row->gender);?></option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Date of Birth</label>
                                            <input type="date" name="dob"
                                                value="<?php  echo htmlentities($row->date);?>" class="form-control"
                                                required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Citizen ID Card</label>
                                            <input type="text" name="cid"
                                                value="<?php  echo htmlentities($row->citizen_id_card);?>"
                                                class="form-control" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Contact Number</label>
                                            <input type="text" name="connum"
                                                value="<?php  echo htmlentities($row->phone_number);?>"
                                                class="form-control" required='true' maxlength="10" pattern="[0-9]+">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Address</label>
                                            <textarea name="address" class="form-control"
                                                required='true'><?php  echo htmlentities($row->address);?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Student Photo</label>
                                            <img src="images/<?php echo $row->Image;?>" width="100" height="100"
                                                value="<?php  echo $row->Image;?>"><a
                                                href="changeimage.php?editid=<?php echo $row->ID;?>"> &nbsp; Edit
                                                Image</a>
                                        </div>
                                        <h3>Parents/Guardian's details</h3>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Parent's Name</label>
                                            <input type="text" name="pname"
                                                value="<?php  echo htmlentities($row->parents_name);?>"
                                                class="form-control" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Parent's phone number</label>
                                            <input type="text" name="pphone"
                                                value="<?php  echo htmlentities($row->parents_phonenumber);?>"
                                                class="form-control" required='true'>
                                        </div>
                                        <?php }} ?>
                                        <h3>Login details</h3>
                                        <?php
                                        if($query_ac->rowCount() > 0)
                                        {
                                        foreach($results_ac as $row_ac)
                                        {               ?>
                                        <div class="form-group">
                                            <label for="exampleInputName1">User Name</label>
                                            <input type="text" name="uname"
                                                value="<?php  echo htmlentities($row_ac->student_id);?>"
                                                class="form-control" readonly='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Password</label>
                                            <input type="Password" name="password"
                                                value="<?php  echo htmlentities($row_ac->password);?>"
                                                class="form-control" readonly='true'>
                                        </div><?php $cnt=$cnt+1;}} ?>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>

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