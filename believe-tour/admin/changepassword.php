<?php 
require('conn.php');


if(!isset($_SESSION['username'])){
	header('location:sign-in.php');
}

    if(isset($_POST['submit'])){
        
        $id = $_SESSION['id'];
        //fetch data from user table

        $old_password =md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        
        
        
        $sql ='SELECT * FROM `user` where id="'.$id.'"';
        $result = mysqli_query($con,$sql);
        $row =mysqli_fetch_assoc($result);
        
        if($old_password == $row['password']){
            $sql =  "UPDATE `user` SET `password` ='$new_password' WHERE `id`='".$id."'";
            $result = mysqli_query($con,$sql);
            if($result){
                    $_SESSION['message'] = "Password Changed Successfully";
                    
            }
            else{
                $_SESSION['message'] = "Something went wrong";
            }
        }
        else{
            $_SESSION['message'] = "Please enter valid old password";       
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
          <h4>Change Password</h4>
        </div>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Change Password</h6>
          
          <div class="form-layout form-layout-1">
            <form method="post" id="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
                  <label class="form-control-label">Old Password: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="password" name="old_password"  placeholder="Enter your old password">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">New Password: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="password" name="new_password" id="new_password"  placeholder="Enter New Password">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Confirm Password <span class="tx-danger">*</span></label>
                  <input class="form-control" type="password" name="confirm_password"  placeholder="Enter Confirm Password">
                </div>
              </div><!-- col-4 -->
                  
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $('#myform').validate({
                rules:{
                    old_password : {
                        required : true,
                        minlength : 5,

                    },
                    new_password : {
                        required :true,
                        minlength : 5,
                    },
                    confirm_password : {
                        required : true,
                        minlength : 5,
                        equalTo: "#new_password",
                    },
                },
                messages:{
                    old_password :{
                        required : 'Please Enter old Password',
                        minlength: 'Your password must be at least 5 characters long',
                    },
                    new_password:{
                        required: 'Please Enter New Password',
                        minlength: 'Your password must be at least 5 characters long',
                    },
                    confirm_password:{
                        required : 'Please Enter New Password',
                        minlength:'Your password must be at least 5 characters long',
                        equalTo: "Password Not Matching",
                    },
                },
            });
        });
    </script>
   <script>
      $(function(){
        'use strict'

        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function(){
          minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
          if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
          } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
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
