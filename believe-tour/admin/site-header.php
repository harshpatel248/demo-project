<?php
require('conn.php');


if (!isset($_SESSION['username'])) {
    header('location:sign-in.php');
}
if (isset($_POST['submit'])) {
    $logo = $_FILES['logo']['name'];
    $logoname = 'uploads/header/' . $logo;
    $tmp_name = $_FILES['logo']['tmp_name'];
    move_uploaded_file($tmp_name, $logoname);

    $inquiry = $_FILES['inquiryImage']['name'];
    $inquiryImage = 'uploads/header/' . $inquiry;
    $tmp_inquiryname = $_FILES['inquiryImage']['tmp_name'];
    move_uploaded_file($tmp_inquiryname, $inquiryImage);

    $inquiryText = $_POST['inquiryText'];
    $inquiryNumber = $_POST['inquiryNumber'];

    foreach ($_POST['pageName'] as $key => $values) {
        $pageName[] = $values;
    }
    $pageName = json_encode($pageName);

    foreach ($_POST['pageLink'] as $key => $values) {
        $pageLink[] = $values;
    }
    $pageLink = json_encode($pageLink);

    $sql = "INSERT INTO `header`(`logo`,`inquiryImage`,`inquiryText`,`inquiryNumber`,`pageName`,`pageLink`) VALUES ('" . $logoname . "','" . $inquiryImage . "','" . $inquiryText . "','" . $inquiryNumber . "','" . $pageName . "','" . $pageLink . "')";
    // echo $sql;die;
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['message'] = "Data Added Successfully";
    } else {
        $_SESSION['message'] = "Something went Wrong";                                            
    }


}

//update
if (isset($_POST['update'])) {
    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>";
    // die;
    $deleteSql = "DELETE FROM `header`";
    $deleteResult = mysqli_query($con, $deleteSql);

    if (!empty($_FILES['logo']['name'])) {
        $logo = $_FILES['logo']['name'];
        $logoname = 'uploads/header/' . $logo;
        $tmp_name = $_FILES['logo']['tmp_name'];
        move_uploaded_file($tmp_name, $logoname);
    } else {
        $logoname = $_POST['old_logo'];
    }

    if (!empty($_FILES['inquiryImage']['name'])) {
        $inquiry = $_FILES['inquiryImage']['name'];
        $inquiryImage = 'uploads/header/' . $inquiry;
        $tmp_inquiryname = $_FILES['inquiryImage']['tmp_name'];
        move_uploaded_file($tmp_inquiryname, $inquiryImage);
    } else {
        $inquiryImage = $_POST['old_inquiryImage'];
    }
    $inquiryText = $_POST['inquiryText'];
    $inquiryNumber = $_POST['inquiryNumber'];
    foreach ($_POST['pageName'] as $key => $values) {
        $pageName[] = $values;
    }
    $pageName = json_encode($pageName);

    foreach ($_POST['pageLink'] as $key => $values) {
        $pageLink[] = $values;
    }
    $pageLink = json_encode($pageLink);

    $sql = "INSERT INTO `header`(`logo`,`inquiryImage`,`inquiryText`,`inquiryNumber`,`pageName`,`pageLink`) VALUES ('" . $logoname . "','" . $inquiryImage . "','" . $inquiryText . "','" . $inquiryNumber . "','" . $pageName . "','" . $pageLink . "')";
    // echo $sql;die;
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['message'] = "Data Updated Successfully";
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
            <h4>Header</h4>
        </div>
    </div>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <?php
            $viewdata = "SELECT * FROM `header`";
            $viewdata_result = mysqli_query($con, $viewdata);

            if (mysqli_num_rows($viewdata_result) > 0) {
                while ($row = mysqli_fetch_assoc($viewdata_result)) {

                    $pageName = json_decode($row['pageName']);
                    $pageLink = json_decode($row['pageLink']);
                    ?>

                    <div class="form-layout form-layout-1">
                        <form method="post" id="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                            enctype="multipart/form-data">
                            <div class="row mg-b-25">
                                <!-- message -->
                                <div class="col-md-12">
                                    <?php
                                    if (isset($_SESSION['message'])) { ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>
                                                <?php echo $_SESSION['message']; ?>
                                            </strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php unset($_SESSION["message"]);
                                    } ?>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Logo: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="file" id="logo" name="logo">
                                        <img src="<?php echo $row['logo']; ?>"  height="70" width="70">
                                        <input type="hidden" name="old_logo" id="old_logo"  value="<?php echo $row['logo']; ?>">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Inquiry Image: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="file" name="inquiryImage" id="inquiryImage">
                                        <img src="<?php echo $row['inquiryImage']; ?>" height="30" width="30">
                                        <input type="hidden" name="old_inquiryImage" id="old_inquiryImage"
                                            value="<?php echo $row['inquiryImage']; ?>">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Inquiry Text <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="inquiryText"
                                            value="<?Php echo $row['inquiryText']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Inquiry Number <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="inquiryNumber"
                                            value="<?Php echo $row['inquiryNumber']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="field_wrapper">
                                        <div>
                                            <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field">Add More</a>
                                        </div>
                                    </div>
                                    <?php foreach ($pageName as $key => $value) { ?>
                                        <div class="customer_records_dynamic">
                                            <div class="remove">
                                                <label class="form-control-label">Page Name <span class="tx-danger">*</span></label>
                                                <input name="pageName[]" type="text" class="form-control" placeholder="Page Name"
                                                    value="<?php echo $value; ?>">
                                                <label class="form-control-label">Page Link <span class="tx-danger">*</span></label>
                                                <input name="pageLink[]" type="text" class="form-control" placeholder="Page Link"
                                                    value="<?php echo $pageLink[$key]; ?>">

                                                <a href="#" class="remove-field btn btn-danger btn-remove-customer mt-3">Remove</a>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>


                            </div><!-- row -->
                        <?php }
                ?>
                        <div class="form-layout-footer">
                            <button class="btn btn-info" type="submit" name="update">Update</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>

            <?php } else { ?>


                <div class="form-layout form-layout-1">
                    <form method="post" id="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                        enctype="multipart/form-data">
                        <div class="row mg-b-25">
                            <!-- message -->
                            <div class="col-md-12">
                                <?php
                                if (isset($_SESSION['message'])) { ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>
                                            <?php echo $_SESSION['message']; ?>
                                        </strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?php unset($_SESSION["message"]);
                                } ?>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Logo: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="file" name="logo">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Inquiry Image: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="file" name="inquiryImage">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Inquiry Text <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="inquiryText">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Inquiry Number <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="inquiryNumber">
                                </div>
                            </div>
                            <div class="col-lg-12">

                                <div class="customer_records form-group">
                                    <label class="form-control-label">Page Name <span class="tx-danger">*</span></label>
                                    <input name="pageName[]" type="text" class="form-control" placeholder="Page Name">
                                    <label class="form-control-label">Page Link <span class="tx-danger">*</span></label>
                                    <input name="pageLink[]" type="text" class="form-control" placeholder="Page Link">
                                    <a class="extra-fields-customer btn btn-primary mt-3" href="#">Add More</a>
                                </div>

                                <div class="customer_records_dynamic"></div>

                            </div>


                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info" type="submit" name="submit">Submit Form</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>
            <?php } ?>
        </div>
    </div><!-- br-pagebody -->
    <?php require 'footer.php'; ?>
</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


<!-- jquery validate cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"
    integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        $('#myform').validate({
            rules: {
                'logo': {
                    required: '#old_logo:blank',
                    accept: "image/jpg,image/jpeg,image/png,image/gif",
                },
                'inquiryImage': {
                    required: '#old_inquiryImage:blank',
                    accept: "image/jpg,image/jpeg,image/png,image/gif",
                },
                'inquiryText': {
                    required: true,
                },
                'inquiryNumber': {
                    required: true,
                },
                'pageName[]': {
                    required: true,
                },
                'pageLink[]': {
                    required: true,
                },
            },
            messages: {
                'logo': {
                    required: "Please upload logo",
                    accept: "upload only image",
                },
                'inquiryImage': {
                    required: "Please upload logo",
                    accept: "upload only image",
                },
                'inquiryText': {
                    required: "Please enter inquirytext",
                },
                'inquiryNumber': {
                    required: "Please enter inquirynumber",
                },
                'pageName[]': {
                    required: "please enter pagename",
                },
                'pageLink[]': {
                    required: "please enter pagelink",
                },
            },
        });
    });
</script>
<script>
    $('.extra-fields-customer').click(function () {
        $('.customer_records').clone().appendTo('.customer_records_dynamic');
        $('.customer_records_dynamic .customer_records').addClass('single remove');
        $('.single .extra-fields-customer').remove();
        $('.single').append('<a href="#" class="remove-field btn btn-danger btn-remove-customer mt-3">Remove</a>');
        $('.customer_records_dynamic > .single').attr("class", "remove");

        $('.customer_records_dynamic input').each(function () {
            var count = 0;
            var fieldname = $(this).attr("name");
            $(this).attr('name', fieldname);
            count++;
        });

    });

    $(document).on('click', '.remove-field', function (e) {
        $(this).parent('.remove').remove();
        e.preventDefault();
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div class="customer_records form-group"> <label class="form-control-label">Page Name <span class="tx-danger">*</span></label> <input name="pageName[]" type="text" class="form-control" placeholder="Page Name"><label class="form-control-label">Page Link <span class="tx-danger">*</span></label><input name="pageLink[]" type="text" class="form-control" placeholder="Page Link">  </div><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove<a /></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
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