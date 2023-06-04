<?php 
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "believe";
 
 $con = mysqli_connect($servername,$username,$password,$database);
 
 if(!$con){
   echo "Connection Failed";
 }
 
   ?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from themepixels.me/demo/bracketplus1.4/app/template/ by HTTrack Website Copier/3.x [XR&CO'2010], Sat, 12 Sep 2020 04:33:26 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket Plus">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="../../../../bracketplus/img/bracketplus-social.html">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracketplus">
    <meta property="og:title" content="Bracket Plus">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="../../../../bracketplus/img/bracketplus-social.html">
    <meta property="og:image:secure_url" content="../../../../bracketplus/img/bracketplus-social.html">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>AdminPanel</title>

    <!-- vendor css -->
    <link href="lib/_fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">


    <!-- Bracket CSS -->
    <link rel="stylesheet" href="css/bracket.css">
    <style type="text/css">
        .error {
    color: red;
}
    </style>
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href="index.php"><span></span>Admin <i>panel</i><span></span></a></div>
    <div class="br-sideleft sideleft-scrollbar">
      <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
      <ul class="br-sideleft-menu">
        <li class="br-menu-item">
          <a href="" class="br-menu-link active">
            <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
            <span class="menu-item-label">Dashboard</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <!-- <li class="br-menu-item">
          <a href="mailbox.html" class="br-menu-link">
            <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
            <span class="menu-item-label">Mailbox</span>
          </a>
        </li> -->
        <!-- br-menu-item -->
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Pages</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="home.php" class="sub-link">Home</a></li>
            <li class="sub-item"><a href="viewpackage.php" class="sub-link">Package</a></li>
            <li class="sub-item"><a href="site-header.php" class="sub-link">Header</a></li>
            <li class="sub-item"><a href="site-footer.php" class="sub-link">Footer</a></li>
            <li class="sub-item"><a href="faq.php" class="sub-link">FAQ</a></li>
            
          </ul>
        </li>      
      </ul><!-- br-sideleft-menu -->
      <br>
    </div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
      <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div>
        <!-- <div class="input-group hidden-xs-down wd-170 transition">
          <input id="searchbox" type="text" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
          </span>
        </div>input-group -->
      </div><!-- br-header-left -->
      <div class="br-header-right">
        <nav class="nav">
          
          <div class="dropdown">
            <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name hidden-md-down"><?php echo $_SESSION['username']; ?></span>
              <img src="img/img1.jpg" class="wd-32 rounded-circle" alt="">
              <span class="square-10 bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-250">
              <div class="tx-center">
                <a href="#"><img src="img/img1.jpg" class="wd-80 rounded-circle" alt=""></a>
                <h6 class="logged-fullname"><?php echo $_SESSION['username']; ?></h6>
               <!--  <p>youremail@domain.com</p> -->
              </div>
            
              <hr>
              <ul class="list-unstyled user-profile-nav">
                <li><a href="changepassword.php"><i class="icon ion-ios-person"></i> Change Password</a></li>
                <!-- <li><a href="#"><i class="icon ion-ios-gear"></i> Settings</a></li>
                <li><a href="#"><i class="icon ion-ios-download"></i> Downloads</a></li>
                <li><a href="#"><i class="icon ion-ios-star"></i> Favorites</a></li>
                <li><a href="#"><i class="icon ion-ios-folder"></i> Collections</a></li> -->
                <li><a href="signout.php"><i class="icon ion-power"></i> Sign Out</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
        <!-- navicon-right -->
      </div><!-- br-header-right -->
    </div>