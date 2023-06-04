<?php require_once "header.php" ?>

<div class="hero-area hero-style-three">
    <img src="assets/images/banner/banner-plane.svg" class="img-fluid banner-plane">
    <div class="hero-main-wrapper position-relative">
        <div class="swiper hero-slider-three ">
            <div class="swiper-wrapper">

                <?php
                $sql = "SELECT * from `slider`";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="swiper-slide">
                            <div class="slider-bg-3">
                                <div class="container">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-lg-9">
                                            <div class="hero3-content">
                                                <span class="title-top"><?php echo $row['title']; ?></span>
                                                <h1><?php echo $row['heading']; ?></h1>
                                                <p><?php echo $row['description']; ?></p>
                                                <a href="<?php echo $row['link']; ?>" class="button-fill-primary banner3-btn">
                                                    <?php echo $row['btn_txt']; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="slider-arrows text-center d-lg-flex flex-column d-none gap-5">
            <div class="hero-prev3" tabindex="0" role="button" aria-label="Previous slide">
                <i class="bx bxs-left-arrow-alt"></i>
            </div>
            <div class="hero-next3" tabindex="0" role="button" aria-label="Next slide">
                <i class="bx bxs-right-arrow-alt"></i>
            </div>
        </div>
    </div>
</div>
<?php
$packageTypes = "SELECT * FROM `package_type`";

?>
<div class="package-area offer-package-style-one pt-110 pb-110">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center fetured-tour-sec">
            <div class="col-lg-6 col-sm-10">
                <div class="section-head-alpha">
                    <h2>Featured Tour Projects</h2>
                    <p>Duis rutrum nisl urna maecenas vel libero faucibus nisi vene natis hendrerit aid lectus
                        suspendissendt.</p>
                </div>
            </div>
            <div class="col-lg-6 col-sm-10">
                <div class="package-btn text-lg-end">
                    <a href="destination.php" class="button-fill-primary all-package-btn">View All Tour</a>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="offer-switch-button2">
                <ul class="nav nav-pills mb-3 justify-content-center gap-sm-4 gap-3" id="pills-tab" role="tablist">
                    <?php $i = 0;
                        $resultPackageTypes = mysqli_query($con, $packageTypes);
                        while($packageRow = mysqli_fetch_assoc($resultPackageTypes)){ 
                        $active = ($i == 0)? 'active': ''; $i++; ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $active; ?>" id="<?php echo strtolower(str_replace(' ','-',$packageRow['name'])); ?>-offer1" data-bs-toggle="pill" data-bs-target="#<?php echo strtolower(str_replace(' ','-',$packageRow['name'])); ?>-offer-tab1" type="button" role="tab" aria-controls="<?php echo strtolower(str_replace(' ','-',$packageRow['name'])); ?>-offer-tab1" aria-selected="true"><?php echo $packageRow['name']; ?></button>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="offer-single-tabs">
                <div class="tab-content" id="pills-tabContent">
                    <?php $j = 0;
                        $resultPackageTypes1 = mysqli_query($con, $packageTypes);
                        while($packageRow = mysqli_fetch_assoc($resultPackageTypes1)){
                        $active = ($j == 0)? 'active': ''; $j++; 
                    ?>
                    
                    <div class="tab-pane fade show <?php echo $active; ?>" id="<?php echo strtolower(str_replace(' ','-',$packageRow['name'])); ?>-offer-tab1" role="tabpanel" aria-labelledby="<?php echo strtolower(str_replace(' ','-',$packageRow['name'])); ?>-offer1">
                        <div class="row d-flex justify-content-center g-4">
                        <?php $i = 0;
                            $packageSql = "SELECT * FROM package WHERE package_id = '".$packageRow['id']."'";
                            $packageResult = mysqli_query($con, $packageSql);
                            while($rowPkg = mysqli_fetch_assoc($packageResult)){ 
                        ?>
                            <div class="col-lg-4 col-md-6 fadeffect">
                                <div class="package-card-beta">
                                    <div class="package-thumb">
                                        <a href="#"><img src="admin/uploads/<?php echo $rowPkg['file']; ?>" alt=""></a>
                                        <p class="card-lavel">
                                            <i class="bi bi-clock"></i> <span><?php echo $rowPkg['days']; ?></span>
                                        </p>
                                    </div>
                                    <div class="package-card-body">
                                        <h3 class="p-card-title"><a href="#"><?php echo $rowPkg['title']; ?></a></h3>
                                        <div class="p-card-bottom">
                                            <div class="book-btn">
                                                <a href="#">Book Now <i class='bx bxs-right-arrow-alt'></i></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="destination-area destination-style-two pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head-gamma">
                    <h2>Top Destination</h2>
                </div>
            </div>
        </div>

        <div class="swiper destination-slider-two">
            <div class="swiper-wrapper">
                <?php
                $sql = "SELECT * FROM `package`";
                $result = mysqli_query($con, $sql);
                $i = 1;
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) { ?>

                        <?php if ($i % 2 == 1) { ?>

                            <div class="swiper-slide">
                                <div class="destination-card-style-two">
                                    <div class="d-card-thumb">
                                        <img src="admin/uploads/<?php echo $row['file'] ?>" alt="">
                                    </div>
                                    <div class="d-card-content">
                                        <h4 class="destination-title"><a href="tour-details.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h4>
                                        <div class="place-count">
                                            <?php echo $row['days']; ?>
                                            <div class="book-now_btn">
                                                <a href="tour-details.php?id=<?php echo $row['id']; ?>">Book Now <i class="bx bxs-right-arrow-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>

                                <div class="destination-card-style-two">
                                    <div class="d-card-thumb">
                                        <img src="admin/uploads/<?php echo $row['file']; ?>" alt="">
                                    </div>
                                    <div class="d-card-content">
                                        <h4 class="destination-title"><a href="tour-details.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h4>
                                        <div class="place-count">
                                            <?php echo $row['days']; ?>
                                            <div class="book-now_btn">
                                                <a href="tour-details.php?id=<?php echo $row['id']; ?>">Book Now <i class="bx bxs-right-arrow-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php }
                        $i++; ?>
                <?php   }
                }
                ?>

            </div>
            <div class="testi-pagination text-center"></div>
        </div>
    </div>
</div>

<!-- <div class="newslatter-wrapper">
        <div class="container">
            <div class="row align-items-center a_about_info">
                <div class="col-lg-6">
                    <div class="newslatter-side text-center text-lg-start mx-auto mx-lg-0">
                        <h2>About Our <span>Journey</span></h2>
                        <p>Welcome to Believe Tours And Travels. Where we're in the business of making your travel dreams come true.</p>
                        <p>Since Our inception, we have earned three very important distinctions:</p>
                        <ul class="about_journey list-unstyled">
                        	<li>A reputation for excellence in customer service and reliability.</li>
                        	<li>Dedication and loyalty to our valued clients. We're here to answer questions and provide helpful information throughout the trips. There's service even after the sale.</li>
                        	<li>A responsible tourism tour operator</li>
                        </ul>
                        <div class="package-btn">
	                        <a href="#" class="button-fill-primary all-package-btn">Read More</a>
	                    </div>
                       
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="achievement-counter-side">
                        <div class="row g-4">
                            <div class="col-lg-6  col-md-6">
                                <div class="achievement-box-style-one">
                                    <div class="achievement-icon">
                                        <img src="assets/images/icons/counter-icon2.svg" alt="">
                                    </div>
                                    <div class="achievement-box-content">
                                        <h2>500+</h2>
                                        <h4>Awesome Tour</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6  col-md-6">
                                <div class="achievement-box-style-one">
                                    <div class="achievement-icon">
                                        <img src="assets/images/icons/counter-icon3.svg" alt="">
                                    </div>
                                    <div class="achievement-box-content">
                                        <h2>300+</h2>
                                        <h4>New Destinations</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6  col-md-6">
                                <div class="achievement-box-style-one">
                                    <div class="achievement-icon">
                                        <img src="assets/images/icons/counter-icon1.svg" alt="">
                                    </div>
                                    <div class="achievement-box-content">
                                        <h2>05+</h2>
                                        <h4>Years Experience</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6  col-md-6">
                                <div class="achievement-box-style-one">
                                    <div class="achievement-icon">
                                        <img src="assets/images/icons/counter-icon4.svg" alt="">
                                    </div>
                                    <div class="achievement-box-content">
                                        <h2>150+</h2>
                                        <h4>Best Mountains</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

<!-- <div class="about-main-wrappper pt-110">
        <div class="container">
            <div class="row align-items-center belive-tour">
                <div class="col-lg-6">
                    <div class="achievement-counter-wrap">
                        <h2 class="about-wrap-title">
                            Why package book with
                            <span>Believe Tours</span>
                        </h2>
                        <div class="achievement-counter-cards">
                            <div class="achievement-counter-card flex-sm-row flex-column text-sm-start text-center ">
                                <div class="counter-box mb-sm-0 mb-3">
                                    <h2>500+</h2>
                                    <h6>awesome tour</h6>
                                </div>
                                <p>duis rutrum nisl urna. maecenas vel libero faucibus nisi venenatis hendrerit a id
                                    lectus. suspendissendt enlane
                                    molestie turpis nec lacinia vehicula.</p>
                            </div>
                            <div class="achievement-counter-card flex-sm-row flex-column text-sm-start text-center">
                                <div class="counter-box mb-3">
                                    <h2>300+</h2>
                                    <h6>destinations</h6>
                                </div>
                                <p>duis rutrum nisl urna. maecenas vel libero faucibus nisi venenatis hendrerit a id
                                    lectus. suspendissendt enlane
                                    molestie turpis nec lacinia vehicula.</p>
                            </div>
                            <div class="achievement-counter-card flex-sm-row flex-column text-sm-start text-center">
                                <div class="counter-box mb-3">
                                    <h2>150+</h2>
                                    <h6> mountains</h6>
                                </div>
                                <p>duis rutrum nisl urna. maecenas vel libero faucibus nisi venenatis hendrerit a id
                                    lectus. suspendissendt enlane
                                    molestie turpis nec lacinia vehicula.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image-group d-flex justify-content-end mt-5 mt-lg-0">
                        <img src="assets/images/banner/hero2-image-group.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>   -->

<!-- <div class="testimonial-area testimonial-style-one mt-120">
        <div class="testimonial-shape-group"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-head-alpha">
                        <h2>What our client say About us</h2>
                        <p>duis rutrum nisl urna. maecenas vel libero faucibus nisi venenatis hendrerit a id lectus.
                            suspendissendt
                            blandit interdum. sed pellentesque at nunc eget consectetur.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="slider-arrows text-center d-lg-flex d-none justify-content-end mb-3">
                        <div class="testi-prev custom-swiper-prev" tabindex="0" role="button"
                            aria-label="previous slide"> <i class="bx bxs-left-arrow-alt"></i> </div>
                        <div class="testi-next custom-swiper-next" tabindex="0" role="button" aria-label="next slide"><i class="bx bxs-right-arrow-alt"></i></div>
                    </div>
                </div>
            </div>
            <div class="swiper testimonial-slider-one position-relative">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-card testimonial-card-alpha">
                            <div class="testimonial-card-top">
                                <div class="qoute-icon"><i class='bx bxs-quote-left'></i></div>
                                <div class="testimonial-thumb"><img src="assets/images/reviewer/r-sm1.png" alt=""></div>
                                <h3 class="testimonial-count">01</h3>
                            </div>
                            <div class="testimonial-body">
                                <p>Travelling with Flamingo for the second time. As always up to the mark. Thank you for all your organization of the tour, we had a fantastic time in Dubai. Everything was arranged professionally and worked out well for us.</p>
                                <div class="testimonial-bottom">
                                    <div class="reviewer-info">
                                        <h4 class="reviewer-name">Mr. Abhi Patel</h4>
                                        <h6>traveller</h6>
                                    </div>
                                    <ul class="testimonial-rating">
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card testimonial-card-alpha">
                            <div class="testimonial-card-top">
                                <div class="qoute-icon"><i class='bx bxs-quote-left'></i></div>
                                <div class="testimonial-thumb"><img src="assets/images/reviewer/r-sm2.png" alt=""></div>
                                <h3 class="testimonial-count">02</h3>
                            </div>
                            <div class="testimonial-body">
                                <p>Amazing experience at kevadiya with stay in eco camp resort as full of greenery. And thanks to flamingo we could planned it properly. Weather was wonderful in July so cherry on cake. Many things to look out for at unity city.</p>
                                <div class="testimonial-bottom">
                                    <div class="reviewer-info">
                                        <h4 class="reviewer-name">Mr. Darshil Shah</h4>
                                        <h6>traveller</h6>
                                    </div>
                                    <ul class="testimonial-rating">
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card testimonial-card-alpha">
                            <div class="testimonial-card-top">
                                <div class="qoute-icon"><i class='bx bxs-quote-left'></i></div>
                                <div class="testimonial-thumb"><img src="assets/images/reviewer/r-sm3.png" alt=""></div>
                                <h3 class="testimonial-count">03</h3>
                            </div>
                            <div class="testimonial-body">
                                <p>Travelling to Turkey was fun especially in this pandemic situation. Hotel & travel arrangements were very good. The Indian restaurants where our meals were arranged in Istanbul & Cappadocia had delicious food.</p>
                                <div class="testimonial-bottom">
                                    <div class="reviewer-info">
                                        <h4 class="reviewer-name">Mr. Akar Patel</h4>
                                        <h6>traveller</h6>
                                    </div>
                                    <ul class="testimonial-rating">
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

<!-- <div class="contenr_section pt-110 pb-110 chain">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-8 col-sm-10 mx-auto">
                    <div class="contenr_part">
                        <h2>Believe: Holiday Tour Packages Tailored to Your Needs</h2>
                        <p>Believe Travels trusts in "You Travel We Care". We guarantee to serve the best occasion bundles and satisfy your travel dreams. Believe Transworld is known as the most reliable Gujarati International Tour Operator based out of Ahmedabad, especially to organize vegetarian dinners and moreover considering Jain meals on tour. Our clients are our spine and most noteworthy advertisers. We have a 100% recurrent client proportion. We try to turn into the best vegetarian meal tour operator on the planet for both India tour packages as well as International tour packages and reliably wish to serve value.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

<?php require 'footer.php'; ?>