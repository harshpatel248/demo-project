<?php
require('conn.php');


if (!isset($_SESSION['username'])) {
    header('location:sign-in.php');
}
if (isset($_GET['update'])) {
    $id = $_GET['update'];
    $sql = "SELECT * FROM `package` where `id`='" . $id . "' ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $days = $row['days'];
    $packagePrice =$row['packagePrice'];
    $description = $row['description'];
    $package_id = $row['package_id'];
    $images = json_decode($row['image']);
    $packageTypes = "SELECT * FROM `package_type`";
    $resultPackageTypes = mysqli_query($con, $packageTypes);
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $days = $_POST['days'];
    $packagePrice = $_POST['packagePrice'];
    $description = $_POST['description'];
    $package_id = $_POST['packageType'];
    $str = [];

    //single image code
    if (!empty($_FILES['image']['name'])) {
        $strfilename = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $strfilename);
        $str[] = "`file` = '" . $strfilename . "'";
    }
    if (!empty($_FILES['file']['name'])) {
        $countfiles = count($_FILES['file']['name']);

        $valid_extensions = array("jpg", "jpeg", "png");
        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['file']['name'][$i];

            ## Location
            $location = "uploads/" . $filename;
            $extension = pathinfo($location, PATHINFO_EXTENSION);
            $extension = strtolower($extension);

            ## File upload allowed extensions

            $response = 0;
            ## Check file extension
            if (in_array(strtolower($extension), $valid_extensions)) {
                ## Upload file
                if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $location)) {
                    $image[] = $filename;
                }
            }
        }
        if (!empty($image)) {
            $imageList = json_encode($image);
            $str[] = "`image` = '" . $imageList . "'";
        }
    }
    $updateString = '';
    if (!empty($str)) {
        $updateString = implode(',', $str);
        $updateString = ',' . $updateString;
    }


    $sql = "UPDATE `package` SET `title` = '" . $title . "' , `days` = '" . $days . "' ,`packagePrice`='".$packagePrice."', `package_id` = ".$package_id.", `description` ='" . $description . "'  " . $updateString . "  WHERE id = '" . $id . "'";
    // echo $sql;die;
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['message'] = "Data Updated Successfully";
        header('location:viewpackage.php');
    } else {
        $_SESSION['message'] = "Something went Wrong";
    }


}



?>

<?php require 'header.php'; ?>
<!-- br-header -->
<!-- ########## END: HEAD PANEL ########## -->

<!-- ########## START: RIGHT PANEL ########## -->

<!-- ########## END: RIGHT PANEL ########## --->

<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Package</h4>
        </div>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label"> Update Package</h6>
            <div class="col-sm-3">
                <a href="viewpackage.php" class="btn btn-primary btn-block mg-b-10">Back</a>
            </div>
            <div class="form-layout form-layout-1">
                <form method="post" id="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                    enctype="multipart/form-data">
                    <div class="row mg-b-25">
                        <!-- message -->
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="title" placeholder="Enter Package Title"
                                    value="<?php echo $title; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Days: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="days" placeholder="Enter Package Days"
                                    value="<?php echo $days; ?>">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Package Price: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="packagePrice" placeholder="Enter Package Price"
                                    value="<?php echo $packagePrice; ?>">
                                    
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Featured Image <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="file" name="image">
                                <img src="uploads/<?php echo $row['file']; ?>" height="50" width="50" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Images <span class="tx-danger">*</span></label>
                                <input class="form-control" type="file" name="file[]" multiple="multiple">
                              <?php  foreach($images as $img){ ?>
                            <img height="50" width="50" src="uploads/<?php echo $img;?>" class="rounded-circle" >
                         <?php } ?>
                               
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Description <span class="tx-danger">*</span></label>
                                <textarea rows="3" class="form-control" placeholder="Textarea" name="description"
                                    id="ckplot"><?php echo $description; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Package Type <span class="tx-danger">*</span></label>
                                <select name="packageType">
                                <?php while($row = mysqli_fetch_assoc($resultPackageTypes)){ ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div><!-- row -->

                    <div class="form-layout-footer">
                        <button class="btn btn-info" type="submit" name="submit">Submit Form</button>
                    </div><!-- form-layout-footer -->
                </form>
            </div><!-- form-layout -->


        </div><!-- br-section-wrapper -->
    </div><!-- br-pagebody -->
    <?php require 'footer.php'; ?>
</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


<!-- jquery validate  -->
<!-- jquery validate cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"
    integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>

    $(document).ready(function () {
        CKEDITOR.replace("ckplot");
        CKEDITOR.instances["ckplot"].setData()
    });

</script>
<script>
    $(document).ready(function () {
        $('#myform').validate({
            rules: {
                title: {
                    required: true,
                },
                days: {
                    required: true,
                },
                packagePrice: {
                    required:true,
                },
            },
            messages: {
                title: {
                    required: 'Please Enter title',
                },
                days: {
                    required: 'Please Enter days',
                },
                packagePrice: {
                    required:true,
                },
            },
        });
    });
</script>
<script>
    $(function () {
        'use strict'

        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function () {
            minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
            if (window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
                // show only the icons and hide left menu label by default
                $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
                $('body').addClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideUp();
            } else if (window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
                $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
                $('body').removeClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideDown();
            }
        }
    });
</script>
</body>

<!-- Mirrored from themepixels.me/demo/bracketplus1.4/app/template/ by HTTrack Website Copier/3.x [XR&CO'2010], Sat, 12 Sep 2020 04:34:53 GMT -->

</html>