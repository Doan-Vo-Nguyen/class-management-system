<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!doctype html>
<html>

<head>
    <title>Class Management System || Contact Us Page</title>
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!--bootstrap-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!--coustom css-->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!--script-->
    <script src="js/jquery-1.11.0.min.js"></script>
    <!-- js -->
    <script src="js/bootstrap.js"></script>
    <!-- /js sweetalert -->
    <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <!-- /js -->
    <!--fonts-->
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <!--/fonts-->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <!--script-->
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event) {
            event.preventDefault();
            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 900);
        });
    });
    </script>
    <!--/script-->
</head>

<body>
    <!--header-->
    <?php include_once('includes/header.php');?>
    <!-- Top Navigation -->
    <div class="banner banner5">
        <div class="container">
            <h2>Contact</h2>
        </div>
    </div>
    <!--header-->
    <!-- contact -->
    <div class="contact">
        <!-- container -->
        <div class="container">
            <div class="contact-info">
                <h3 class="c-text">Feel Free to contact with us!!!</h3>
            </div>

            <div class="contact-grids">
                <?php
					$sql="SELECT * FROM page WHERE page_type='contactus'";
					$query = $dbh -> prepare($sql);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);
							
					$cnt=1;
					if($query->rowCount() > 0)
					{
					foreach($results as $row)
					{               ?>
                <div class="col-md-4 contact-grid-left">
                    <h3>Address</h3>
                    <p><?php  echo htmlentities($row->page_description);?>
                    </p>
                </div>
                <div class="col-md-4 contact-grid-middle">
                    <h3>Phone</h3>
                    <p><?php  echo htmlentities($row->page_phone);?>
                    </p>
                </div>
                <div class="col-md-4 contact-grid-right">
                    <h3>E-mail</h3>
                    <p><?php  echo htmlentities($row->page_email);?>
                    </p>
                </div>
                <div class="clearfix"> </div>
                <?php $cnt=$cnt+1;}} ?>
            </div>
            <!-- Create a line with OR text -->
            <div class="line-container">
                <div class="line"></div>
                <div class="or-text">OR</div>
                <div class="line"></div>
            </div>
            <div class="contact-form">
                <h3 class="c-text">Send us a Message</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                            required="true">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject"
                            required="true">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="3" placeholder="Message"
                            required="true"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                    <?php include_once('./send-mail.php');?>
            </div>
            <!-- //container -->
        </div>
        <!-- //contact -->
        <?php include_once('includes/footer.php');?>
        <!--/copy-rights-->
</body>

</html>