<?php 
require "admin/conn.php";

$sql = "SELECT * FROM `footer`";
$result = mysqli_query($con,$sql);
?>
        <div class="footer-area">
            <?php 
                while($row=mysqli_fetch_assoc($result)){        
                    $int_tours = json_decode($row['int_tours']);
                    $domestic_tours = json_decode($row['domestic_tours']);
            ?>
            <div class="footer-main-wrapper">
                <div class="footer-vactor">
                    <img src="assets/images/banner/footer-bg.png" alt="">
                </div>
                <div class="container">
                    <div class="row justify-content-center g-4">
                        <div class="col-lg-4">
                            <div class="footer-widget">    
                                <div class="footer-about text-lg-start text-center">
                                    <h4 class="footer-widget-title">Office Address</h4>
                                    <p><?php echo $row['officeAddress'];?></p>

                                    <div class="footer-social-wrap">
                                        <h5>Follow Us On:</h5>
                                        <ul class="footer-social-links justify-content-lg-start justify-content-center">
                                            <li><a href="<?php  echo $row['instagramLink']; ?>"><i class="bx bxl-instagram"></i></a></li>
                                            <li><a href="<?php echo $row['facebookLink'];?>"><i class="bx bxl-facebook"></i></a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">Quick Links</h4>
                                <ul class="footer-links">
                                    <?php
                                        $pageSql = "SELECT * FROM `header`";
                                        $pageResult = mysqli_query($con,$pageSql);
                                        while ($rows = mysqli_fetch_assoc($pageResult)) {
                                            $pageName = json_decode($rows['pageName']);
                                            $pageLink = json_decode($rows['pageLink']);
                                            foreach($pageName as $key=>$value) {
                                    ?>
                                    <li><a href="<?php echo $pageLink[$key]; ?>"><?php echo $pageName[$key];?></a></li>
                                    <?php } 
                                }?>
                                </ul> 
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">International Tours</h4>
                                <?php foreach($int_tours as $key=>$value) {?>
                                <ul class="footer-links">
                                    <li><a href="#"><?php echo $int_tours[$key]; ?></a></li>
                                </ul>
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-8">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">Domestic Tours</h4>
                                <?php foreach($domestic_tours as $key=>$value) {?>
                                <ul class="footer-links">
                                    <li><a href="#"><?php echo $domestic_tours[$key]; ?></a></li>
                                
                                </ul>
                                <?php }?>
                            </div>
                        </div>
                    
                    </div>
                    <div class="footer-contact-wrapper">
                        <h5>Contact Us:</h5>
                        <ul class="footer-contact-list">
                            <li><i class="bi bi-telephone-x"></i> <a href="tel:079-4600344"><?php echo $row['contactNumber'];?></a></li>
                        
                            <li><i class="bi bi-geo-alt"></i> <a href="mailto:<?php echo $row['email'];?>"><?php echo $row['email'];?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-6 col-md-6 order-lg-1 order-3 ">
                            <div class="copyright-link text-lg-start text-center">
                                <p>Copyright © 2022 Believe Tours & Travels. All Rights Reserved.</p>
                            </div>
                        </div>
                    
                        <div class="col-lg-6 col-md-6 order-lg-3 order-2">
                            <div class="policy-links">
                                <ul class="policy-list justify-content-lg-end justify-content-center">
                                    <li><a href="#">Terms & Condition</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>


        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/chain_fade.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/swiper-bundle.min.js"></script>
        <script src="assets/js/jquery.fancybox.min.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/jquery-ui.js"></script>

        <script src="assets/js/main.js"></script>
    </body>

</html>