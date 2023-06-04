<?php
require('conn.php');


if (!isset($_SESSION['username'])) {
    header('location:sign-in.php');
}

//Insert  code
if (isset($_POST['submit'])) {

    $officeAddress = $_POST['officeAddress'];
    $instagramLink = $_POST['instagramLink'];
    $facebookLink = $_POST['facebookLink'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];

    foreach ($_POST['int_tours'] as $key => $value) {
        $int_tours[] = $value;
    }
    foreach ($_POST['domestic_tours'] as $key => $value) {
        $domestic_tours[] = $value;
    }
    $int_tours = json_encode($int_tours);
    $domestic_tours = json_encode($domestic_tours);

    $insertSql = "INSERT INTO `footer`  (`officeAddress`,`instagramLink`,`facebookLink`,`contactNumber`,`email`,`int_tours`,`domestic_tours`) VALUES ('" . $officeAddress . "','" . $instagramLink . "','" . $facebookLink . "','" . $contactNumber . "','" . $email . "','" . $int_tours . "','" . $domestic_tours . "')";
    $insertResult = mysqli_query($con, $insertSql);

    if ($insertResult) {
        $_SESSION['message'] = "Data Added Successfully";
    } else {
        $_SESSION['message'] = "Something went Wrong";
    }

}
//update code
    if(isset($_POST['update'])){
    $deleteSql = "DELETE FROM `footer` ";
    $deleteResult = mysqli_query($con,$deleteSql);

    $officeAddress = $_POST['officeAddress'];
    $instagramLink = $_POST['instagramLink'];
    $facebookLink = $_POST['facebookLink'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];

    foreach ($_POST['int_tours'] as $key => $value) {
        $int_tours[] = $value;
    }
    foreach ($_POST['domestic_tours'] as $key => $value) {
        $domestic_tours[] = $value;
    }
    $int_tours = json_encode($int_tours);
    $domestic_tours = json_encode($domestic_tours);

    $insertSql = "INSERT INTO `footer`  (`officeAddress`,`instagramLink`,`facebookLink`,`contactNumber`,`email`,`int_tours`,`domestic_tours`) VALUES ('" . $officeAddress . "','" . $instagramLink . "','" . $facebookLink . "','" . $contactNumber . "','" . $email . "','" . $int_tours . "','" . $domestic_tours . "')";
    $insertResult = mysqli_query($con, $insertSql);

    if ($insertResult) {
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
            <h4>Footer</h4>
        </div>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <?php
            $sql = "SELECT * FROM `footer`";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row =mysqli_fetch_assoc($result)){
                    $int_tours = json_decode($row['int_tours']);
                    $domestic_tours = json_decode($row['domestic_tours']);
               
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
                                    <label class="form-control-label">Office Address: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="officeAddress" value="<?Php echo $row['officeAddress'];?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Instagram Link: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="instagramLink" value="<?php echo $row['instagramLink']; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">FacebookLink <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="facebookLink" value="<?php echo $row['facebookLink'];?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Contact Number <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="contactNumber" value="<?php echo $row['contactNumber']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Email Address<span class="tx-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" value="<?php echo $row['email']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                            <div class="field_wrapper">
                                        <div>
                                            <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field">Add More</a>
                                        </div>
                                    </div>
                                <?php foreach($int_tours as $key => $value){ ?>        
                                    <div class="customer_records_dynamic">
                                            <div class="remove">
                                                <label class="form-control-label">International Tours <span class="tx-danger">*</span></label>
                                                <input name="int_tours[]" type="text" class="form-control" placeholder="International tours"
                                                    value="<?php echo $value; ?>">
                                                <label class="form-control-label">Domestic Tours <span class="tx-danger">*</span></label>
                                                <input name="domestic_tours[]" type="text" class="form-control" placeholder="Domestic tours"
                                                    value="<?php echo $domestic_tours[$key]; ?>">

                                                <a href="#" class="remove-field btn btn-danger btn-remove-customer mt-3">Remove</a>
                                            </div>
                                        </div>
                                <?php }?>

                                <div class="customer_records_dynamic"></div>

                            </div>


                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info" type="submit" name="update" value="update">Update</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>
            <?php 
             } } else {
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
                                    <label class="form-control-label">Office Address: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="officeAddress">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Instagram Link: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="instagramLink">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">FacebookLink <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="facebookLink">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Contact Number <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="contactNumber">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Email Address<span class="tx-danger">*</span></label>
                                    <input class="form-control" type="email" name="email">
                                </div>
                            </div>
                            <div class="col-lg-12">

                                <div class="customer_records form-group">
                                    <label class="form-control-label">International Tours <span
                                            class="tx-danger">*</span></label>
                                    <input name="int_tours[]" type="text" class="form-control"
                                        placeholder="International Tours">
                                    <label class="form-control-label">Domestic Tours<span class="tx-danger">*</span></label>
                                    <input name="domestic_tours[]" type="text" class="form-control"
                                        placeholder="Domestic Tours">
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
                'officeAddress': {
                    required: true,
                },
                'instagramLink': {
                    required: true,
                },
                'facebookLink': {
                    required: true,
                },
                'contactNumber': {
                    required: true,
                },
                'email': {
                    required: true,
                },
                'int_tours[]': {
                    required: true,
                },
                'domestic_tours[]': {
                    required: true,
                },
            },
            messages: {
                'officeAddress': {
                    required: "Please Enter office Address",
                },
                'instagramLink': {
                    required: "Please enter instagram link",
                },
                'facebookLink': {
                    required: "Please enter facebook link",
                },
                'contactNumber': {
                    required: "Please enter Contact number",
                },
                'email': {
                    required: "Please enter your email",
                },
                'int_tours[]': {
                    required: "please enter the details ",
                },
                'domestic_tours[]': {
                    required: "please enter the details",
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
    var fieldHTML = '<div><div class="customer_records form-group"> <label class="form-control-label">International Tours<span class="tx-danger">*</span></label> <input name="int_tours[]" type="text" class="form-control" placeholder="International Tours"><label class="form-control-label">Domestic Tours <span class="tx-danger">*</span></label><input name="domestic_tours[]" type="text" class="form-control" placeholder="Domestic Tours">  </div><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove<a /></div>'; //New input field html 
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