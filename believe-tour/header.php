<?php
require "admin/conn.php";
error_reporting(0);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Believe Tours & Travels</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" href="assets/images/favicon.png" type="image/gif" sizes="20x20"> -->

    <link rel="stylesheet" href="assets/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='assets/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

    <!-- <link rel="stylesheet" href="assets/css/bootstrap-icons.css"> -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>

    <header>
        <?php
        $sql = "SELECT * FROM `header`";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $pageName = json_decode($row['pageName']);
            $pageLink = json_decode($row['pageLink']);
            ?>

            <div class="header-area header-style-three w-100">
                <div class="container-fluid">
                    <div class="row">
                        <div
                            class="col-xxl-2 col-xl-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 align-items-center d-xl-flex d-lg-block">
                            <div class="nav-logo d-flex justify-content-between align-items-center">
                                <a href="index.php"><img src="admin/<?php echo $row['logo']; ?>" alt="logo"></a>
                                <div class="mobile-menu d-flex ">
                                    <div class="d-flex align-items-center">
                                        <div class="nav-right-icons d-xl-none d-flex align-items-center ">
                                            <div class="user-dropdown">
                                                <i class='bx bx-user-circle'></i>
                                                <ul class="user-drop-list">
                                                    <li><a href="#">My Account</a></li>
                                                    <li><a href="#">Login</a></li>
                                                    <li><a href="#">Registration</a></li>
                                                    <li><a href="#">Setting</a></li>
                                                </ul>
                                            </div>

                                        </div>
                                        <a href="javascript:void(0)" class="hamburger d-block d-xl-none">
                                            <span class="h-top"></span>
                                            <span class="h-middle"></span>
                                            <span class="h-bottom"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xxl-7 col-xl-8 col-lg-9 col-md-8 col-sm-6 col-xs-6 main-nav-width">
                            <nav class="main-nav">
                                <div class="inner-logo d-xl-none text-center">
                                    <a href="#"><img src="admin/<?php echo $row['logo']; ?>" alt=""></a>
                                </div>
                                <ul>
                                    <?php foreach($pageName as $key=>$value) {?>
                                    <li><a href="<?php echo $pageLink[$key]; ?>"><?php echo $pageName[$key]; ?></a></li>
                                    
                                    <?php }?>
                                </ul>

                            </nav>
                        </div>
                        <div class="col-xxl-3 col-xl-2 col-lg-1 inquiry-section">
                            <div class="nav-right d-xl-flex d-none">
                                <div class="nav-right-hotline d-xxl-flex">
                                    <div class="hotline-icon">
                                        <img src="admin/<?php echo $row['inquiryImage'];?>" class="color_black" alt="">
                                    </div>
                                    <div class="hotline-info">
                                        <span><?php echo $row['inquiryText']; ?></span>
                                        <h6><a href="tel:079-4600344"><?php echo $row['inquiryNumber']; ?></a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php } ?>
    </header>