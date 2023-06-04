<?php 
require('conn.php');

if(!isset($_SESSION['username'])){
  header('location:sign-in.php');
}
  //get data
  if(isset($_GET['update'])){
      $id = $_GET['update'];

      $sql = "SELECT * FROM `slider` where id='".$id."' ";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($result);
 
      $title = $row['title'];
      $heading = $row['heading'];
      $description = $row['description'];
      $link = $row['link'];
      $btn_txt = $row['btn_txt'];
      

  }


  if(isset($_POST['submit'])){
   $title = $_POST['title'];
   $heading = $_POST['heading'];
   $description = $_POST['description'];
   $link = $_POST['link']; 
   $btn_txt = $_POST['btn_txt'];

   $sql = "UPDATE `slider` SET `title` = '$title' , `heading` = '$heading' , `description` = '$description' , `link` = '$link' , `btn_txt` = '$btn_txt' where id='".$id."' ";
   

    $result = mysqli_query($con,$sql);

    if($result){
      $_SESSION['message'] =  'Data Updated Successfully';
      header('location:home.php');
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
          <h4>Home</h4>
        </div>
      </div>

      <div class="br-pagebody">
        <div class="col-sm-12">
            <div class="br-section-wrapper">
              <h6 class="br-section-label">Update Slider Content</h6>
              <a href="home.php" class="btn btn-primary mb-3">Back</a>
          <!-- <p class="br-section-text">A form with a label on top of each form control.</p> -->
          <div class="form-layout form-layout-1">
          <form method="post" id="MyForm" action="">
            <div class="row mg-b-25">
              <div class="col-lg-12">
             
                <div class="form-group">
                  <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="title"  placeholder="Enter Title" value="<?php echo $title; ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Heading: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="heading" placeholder="Enter Slider heading" value="<?php echo $heading; ?>">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                  <textarea rows="3" class="form-control" placeholder="Add Description" name="description"><?php echo $description; ?></textarea>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-12">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Button link <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="link" placeholder="Enter button link" value="<?php echo $link; ?>">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Button text <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="btn_txt" placeholder="Enter button text" value="<?php echo $btn_txt; ?>">
                </div>
              </div>
              
            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-info" name="submit">Submit</button>
            </div><!-- form-layout-footer -->
            </form>
          </div>
            </div> 
        </div>

      </div><!-- br-pagebody -->
      <?php require 'footer.php'; ?>
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

   
    <!-- jquery validate cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).ready(function() {
$("#MyForm").validate({
rules: {
 title: {
required: true,
},
 heading: {
required: true,
},
 description: {
required: true,
},
 link:{
required: true,
},
 btn_txt: {
required: true,
},
},
messages: {
title: {
  required:"Please enter title",
        },
heading: {
  required:"Please enter heading",
        },
description: {
  required:"Please enter description",
        },
link: {
  required:"Please enter link",
        },
btn_txt: {
  required:"Please enter text",
        },

}
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
