<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
{
    $stuid = $_POST['stuid'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM account JOIN student ON account.student_id = student.student_id WHERE account.student_id=:stuid AND account.password=:password";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':stuid', $stuid, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        foreach ($results as $result) {
            $_SESSION['stuid'] = $result->student_id;
        }

    if(!empty($_POST["remember"])) {
        //COOKIES for username
        setcookie ("user_login",$_POST["stuid"],time()+ (10 * 365 * 24 * 60 * 60));
        //COOKIES for password
        setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
    } else {
        if(isset($_COOKIE["user_login"])) {
            setcookie ("user_login","");
        if(isset($_COOKIE["userpassword"])) {
            setcookie ("userpassword","");
    }
  }
}
  $_SESSION['login'] = $_POST['stuid'];
    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
    echo "<script>swal('Error!', 'Invalid', 'error');</script>";
}
}