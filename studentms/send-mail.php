<?php
session_start();
include('includes/dbconnection.php');
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $date = date("Y-m-d");
    $sql = "INSERT INTO feedback(user,user_email,subject,message,date) VALUES(:user,:email,:subject,:message,:date)";
    $query=$dbh->prepare($sql);
    $query->bindParam(':user',$name,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':subject',$subject,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->bindParam(':date',$date,PDO::PARAM_STR);
    $result = $query->execute();
    if(!$result) {
        echo "Error: " . $sql . "<br>" . $dbh->errorInfo();
    }
    $to = "$email";
    $subject = "Feedback";
    $message = "Thanks for your feedback, $name. We will contact you soon.";
    $from = "wwwdoanvonguyen@gmail.com";
    $header = "From:" . $from;
    mail($to, $subject, $message, $header);
    // scrip show alert and redirect to the last page
    echo "<script>swal('Thanks for your feedback!', 'We will contact you soon.')</script>";
    // clear all fields
    $name = "";
    $email = "";
    $subject = "";
    $message = "";
    $dbh = null;
}