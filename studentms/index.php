<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!doctype html>
<html>

<head>
    <title>EduTrack - Class Management System || Home Page</title>
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
    <!-- /js -->
    <!--fonts-->
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <!--/fonts-->
    <!--hover-girds-->
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <script src="js/modernizr.custom.js"></script>
    <!--/hover-grids-->
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
    <?php include_once('includes/header.php');?>
    <div class="banner">
        <div class="container">
            <script src="js/responsiveslides.min.js"></script>
            <script>
            $(function() {
                $("#slider").responsiveSlides({
                    auto: true,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    pager: true,
                });
            });
            </script>
            <div class="slider">
                <div class="callbacks_container">
                    <ul class="rslides" id="slider">
                        <li>
                            <h3>Class Management System</h3>
                            <p>Registered Students can Login Here</p>
                            <div class="readmore">
                                <a href="user/login.php">Student Login<i class="glyphicon glyphicon-menu-right">
                                    </i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="welcome">
        <div class="container">
            <?php
            $sql="SELECT * FROM page WHERE page_type='aboutus'";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
                    
            $cnt=1;
            if($query->rowCount() > 0)
            {
            foreach($results as $row)
            {               ?>
            <h2><?php  echo htmlentities($row->page_title);?></h2>
            <p>
            <div>
                <font color="#7b8898" face="Mercury SSm A, Mercury SSm B, Georgia, Times, Times New Roman, Microsoft
                    YaHei New, Microsoft Yahei, ????, ??, SimSun, STXihei, ????, serif"><span style="font-size:
                        26px;">
                        <?php  echo ($row->page_description);?></span>
                </font><br>
            </div>

            </p><?php $cnt=$cnt+1;}} ?>
        </div>
    </div>
    <!--/welcome-->


    <!--testmonials-->
    <div class="testimonials">
        <div class="container">
            <div class="testimonial-nfo">
                <h3>Public Notices</h3>
                <marquee style="height:350px;" direction="up" onmouseover="this.stop();" onmouseout="this.start();">
                    <?php
                    $sql="SELECT * FROM notice";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $row)
                    {               ?>

                    <a href="view-public-notice.php?viewid=<?php echo htmlentities ($row->notice_id);?>" target="_blank"
                        style="color:#fff;">
                        <?php  echo htmlentities($row->notice_title);?>(<?php  echo htmlentities($row->creation_date);?>)</a>
                    <hr /><br />

                    <?php $cnt=$cnt+1;}} ?>
                </marquee>
            </div>
        </div>
    </div>
    <!--\testmonials-->
    <!--specfication-->

    <!--/specfication-->
    <?php include_once('./includes/footer.php');?>
    <!--/copy-rights-->
</body>

</html>