<?php
require('conn.php');


if (!isset($_SESSION['username'])) {
  header('location:sign-in.php');
}
if(isset($_GET['update'])){
    $id = $_GET['update'];
    $sql = "SELECT * FROM `package` where `id`='".$id."' ";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $title =$row['title'];
    $days =$row['days'];
    $link =$row['link'];
    $id =$row['id'];
    $temp = $row['image'];  
  
    
}

if (isset($_POST['submit'])) {
    $id =$_POST['id'];
  $title = $_POST['title'];
  $days = $_POST['days'];
  $link = $_POST['link'];

    //single image code
    if(!empty($_FILES['image']['name'])){
        $strfilename = time(). $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'uploads/'.$strfilename);
        $file = $strfilename;
    }
    else{
        $file =$_POST['old_image'];
    }

    
        if(!empty($_FILES['file']['name'])){
            $countfiles = count($_FILES['file']['name']);

    $totalFileUploaded = 0;
    for($i=0;$i<$countfiles;$i++){
         $filename = $_FILES['file']['name'][$i];

         ## Location
         $location = "uploads/".$filename;
         $extension = pathinfo($location,PATHINFO_EXTENSION);
         $extension = strtolower($extension);

         ## File upload allowed extensions
         $valid_extensions = array("jpg","jpeg","png","pdf","docx");

         $response = 0;
         ## Check file extension
         if(in_array(strtolower($extension), $valid_extensions)) {
              ## Upload file
              if(move_uploaded_file($_FILES['file']['tmp_name'][$i],'uploads/'.$filename)){
                    $image[] = $filename;

              }
         }

    }
    $image = json_encode($image);
        }
        else{
            $image[] =$_POST['old_file'];
            print_r($image);die;
           
        }
  
  $sql = "UPDATE `package` SET `title`='$title', `days`='$days', `link`='$link',`file`='$file',`image`='$image' WHERE `id` ='".$id."'";
  print_r($sql);die;
  $result = mysqli_query($con, $sql);

  if($result){
     $_SESSION['message'] = "Data Updated Successfully";
  }
  else{
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
      <h6 class="br-section-label">Package</h6>
      <div class="col-sm-3">
        <a href="viewpackage.php" class="btn btn-primary btn-block mg-b-10">view Package</a>
      </div>
      <div class="form-layout form-layout-1">
        <form method="post" id="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
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
                <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="title" placeholder="Enter Package Title" value="<?php echo $title; ?>">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            </div>
            </div><!-- col-4 -->
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Days: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="days" placeholder="Enter Package Days" value="<?php echo $days; ?>">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Link <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="link" placeholder="Enter Package link" value="<?php echo $link; ?>">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Featured Image <span class="tx-danger">*</span></label>
                <input class="form-control" type="file" name="image">
                <input type="hidden" name="old_image" value="<?php echo $row['file'];?>">
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Images <span class="tx-danger">*</span></label>
                <input class="form-control" type="file" name="file[]" multiple="multiple">
                <input type="hidden" name="old_file[]" value="<?php echo  $temp; ?>">
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
<script>
        $(document).ready(function(){
            $('#myform').validate({
                rules:{
                    title : {
                        required : true,
                    },
                    days : {
                        required :true,
                    },
                    link : {
                        required : true,
                    },
                },
                messages:{
                  title :{
                        required : 'Please Enter title',
                    },
                    days:{
                        required: 'Please Enter days',
                    },
                    link:{
                        required : 'Please enter link',
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