<?php
session_start();
if (strlen($_SESSION['stuid'] == 0)) {
    header('location:logout.php');
} else{
    if(isset($_POST['submit']))
    {
        $sid=$_SESSION['stuid'];
        $curpassword=($_POST['currentpassword']);
        $newpassword=($_POST['newpassword']);
        $sql ="SELECT * FROM account WHERE student_id=:sid and password=:curpassword";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':sid', $sid, PDO::PARAM_STR);
        $query-> bindParam(':curpassword', $curpassword, PDO::PARAM_STR);
        $query-> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);

        if($query -> rowCount() > 0)
        {
            $con="UPDATE account SET password=:newpassword WHERE student_id=:sid";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1-> bindParam(':sid', $sid, PDO::PARAM_STR);
            $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            echo "<script>swal('Good job', 'Your password changed successfully.', 'success');</script>";
        } else {
            echo "<script>swal('Error!', 'Current password is wrong.', 'error');</script>";
    }
}
}
?>