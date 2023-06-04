<?php
require 'header.php';

if (isset($_GET['id'])) 
{
    $id = $_GET['id'];

    $sql = "SELECT * FROM `package` where id='" . $id . "' ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $title = $row['title'];
    $days = $row['days'];
    $description = $row['description'];
    $packagePrice = $row['packagePrice'];
}
?>

<div class="breadcrumb breadcrumb-style-one">
    <div class="container">
        <div class="col-lg-12 text-center">
            <h2 class="breadcrumb-title">
                <?php echo $title; ?>
            </h2>
            <ul class="d-flex justify-content-center breadcrumb-items">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">
                    <?php echo $title; ?>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="destination-details-wrapper pt-110 pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                <div class="tour-package-details singal_tour_section destination-details">
                    <div class="swiper testimonial-slider-two">
                        <div class="swiper-wrapper">
                            <?php
                            $sql = "SELECT * FROM `package` where id='" . $id . "' ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $images = json_decode($row['image']);
                                foreach ($images as $image) {
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="singal_img_slider">
                                            <img src="admin/uploads/<?php echo $image; ?>"
                                                class="img-fluid" />';
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="row single_tour_info">
                        <div class="col-lg-6 text-right">
                            <div class="header-bottom">
                                <h2 class="pd-title">
                                    <?php echo $title; ?>
                                </h2>
                                <h5 class="days_part">
                                    <?php echo $days; ?><br>
                                Package Price :  <?php echo $packagePrice; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-lg-6 text-left">
                            <div class="slider-arrows text-center d-lg-flex d-none justify-content-end">
                                <div class="testi-prev custom-swiper-prev" tabindex="0" role="button"
                                    aria-label="previous slide"> <i class="bx bxs-left-arrow-alt"></i> </div>
                                <div class="testi-next custom-swiper-next" tabindex="0" role="button"
                                    aria-label="next slide"><i class="bx bxs-right-arrow-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="dd-body">
                        <?php echo $description; ?>
                    </div>
                    <div class="accordion_part">
                        <div class="accordion plans-accordion" id="planAccordion">
                        <?php 
                                $faqSql = "SELECT * FROM `faq`";
                                $faqResult = mysqli_query($con,$faqSql);
                                while($row=mysqli_fetch_assoc($faqResult)){
                                    $i=1;
                                    $heading =json_decode($row['heading']);
                                    $description =json_decode($row['description']);
                                    foreach($heading as $key=>$values){
                                        $i++;
                                    
                                

                                ?>
                            <div class="accordion-item plans-accordion-single">
                                <div class="accordion-header" id="planHeading<?php echo $i; ?>">
                                    <div class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#planCollapse<?php echo $i; ?>" aria-expanded="true" role="navigation">
                                        <div class="plan-title">
                                            <h5><?php echo $values; ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div id="planCollapse<?php echo $i; ?>" class="accordion-collapse collapse "
                                    aria-labelledby="planHeading<?php echo $i; ?>" data-bs-parent="#planAccordion">
                                    <div class="accordion-body plan-info">
                                        <ul class="policy_info">
                                            <?php echo $description[$key]; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php  } }?>
                            
                        </div>
                    </div>
                    
                </div>

            </div>
            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="package-sidebar">
                    <aside class="package-widget-style-2 widget-form">
                        <div class="widget-title text-center d-flex justify-content-between">
                            <h4>Book This Tour</h4>

                        </div>
                        <div class="widget-body">
                            <form action="stripe/index.php" method="post" id="booking-form">
                                <div class="booking-form-wrapper">
                                    <div class="custom-input-group">
                                        <input type="text" placeholder="Your Full Name" name="name" id="name">
                                        <input type="hidden"  name="packageId" id="packageId" value="<?php echo $id; ?>">
                                        <input type="hidden"  name="packageTitle" id="packageTitle" value="<?php echo $title; ?>">
                                    </div>
                                    <div class="custom-input-group">
                                        <input type="email" placeholder="Your Email" id="email" name="email">
                                    </div>
                                    <div class="custom-input-group">
                                        <input type="text" placeholder="Phone" id="phone" name="phone">
                                    </div>
                                    <div class="custom-input-group">
                                        <input type="text" placeholder="Package Price" id="packagePrice" name="packagePrice" value="<?php echo $packagePrice; ?>" readonly>
                                    </div>

                                    <div class="custom-input-group">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <input placeholder="Travel Date" type="text" name="checkin" id="datepicker"
                                            value="" class="calendar datepicker" autocomplete="off" >
                                    </div>
                                    <div class="custom-input-group">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <input placeholder="Return Date" type="text" name="checkout"
                                            id="datepicker2" value="" class="calendar datepicker" autocomplete="off" >
                                    </div>
                                    <div class="custom-input-group">
                                        <textarea cols="20" rows="7" placeholder="Your message"
                                            name="message"></textarea>
                                    </div>
                                    <div class="custom-input-group">
                                        <div class="submite-btn">
                                            <button type="submit" name="submit" value="submit">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </aside>

                    <aside class="package-widget widget-gallary mt-30">
                        <div class="widget-title">
                            <h4>New Destination</h4>
                        </div>
                        <ul class="widget-body singal_destination">
                            <?php
                            $sql = "SELECT *FROM `package` ORDER BY RAND() LIMIT 4";
                            $result = mysqli_query($con, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="destination-card-style-two">
                                        <div class="d-card-thumb">
                                            <img src="admin/uploads/<?php echo $row['file'] ?>" alt="">
                                        </div>
                                        <div class="d-card-content">
                                            <h4 class="destination-title">
                                                <a href="tour-details.php?id=<?php echo $row['id']; ?>">
                                                    <?php echo $row['title'] ?>
                                                </a>
                                            </h4>
                                            <div class="place-count">
                                                <?php echo $row['days']; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            ?>
                        </ul>
                    </aside>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="destination-area similar_packages destination-style-two pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head-gamma text-left">
                    <h2>Similar Tour Packages</h2>
                </div>
            </div>
        </div>
        <div class="swiper destination-slider-two">
            <div class="swiper-wrapper">

                <?php
                $sql = "SELECT * FROM `package`";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="swiper-slide">
                            <div class="destination-card-style-two">
                                <div class="d-card-thumb">
                                    <img src="admin/uploads/<?php echo $row['file'] ?>" alt="">
                                </div>
                                <div class="d-card-content">
                                    <h4 class="destination-title"><a
                                            href="tour-details.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h4>
                                    <div class="place-count">
                                        <?php echo $row['days']; ?>
                                        <div class="book-now_btn">
                                            <a href="tour-details.php?id=<?php echo $row['id']; ?>">Book Now <i
                                                    class="bx bxs-right-arrow-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php 
                    }
                } ?>
            </div>
            <div class="testi-pagination text-center"></div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>