<?php
require('conn.php');


if (!isset($_SESSION['username'])) {
  header('location:sign-in.php');
}

if (isset($_POST['submit'])) {

  $title = $_POST['title'];
  $days = $_POST['days'];
  $packagePrice = $_POST['packagePrice'];
  $description =$_POST['description'];
  $packageId =$_POST['packageType'];
  // print_r($description);die;

    //single image code
    $strfilename =  $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],'uploads/'.$strfilename);
    $file = $strfilename;

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
  $sql = "INSERT INTO `package` (`title`,`days`,`packagePrice`,`file`,`image`,`description`,`package_id`) values ('$title','$days','$packagePrice','$file','$image','$description','$packageId') ";
  $result = mysqli_query($con, $sql);

  if($result){
     $_SESSION['message'] = "Data Added Successfully";
  }
  else{
    $_SESSION['message'] = "Something went Wrong";
  }


}

$packageTypes = "SELECT * FROM `package_type`";
$resultPackageTypes = mysqli_query($con, $packageTypes);
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
                <input class="form-control" type="text" name="title" placeholder="Enter Package Title">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Days: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="days" placeholder="Enter Package Days">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Packageprice: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="packagePrice" placeholder="Enter Package Price">
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Featured Image <span class="tx-danger">*</span></label>
                <input class="form-control" type="file" name="image">
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Images <span class="tx-danger">*</span></label>
                <input class="form-control" type="file" name="file[]" multiple="multiple">
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Description <span class="tx-danger">*</span></label>
                <textarea rows="3" class="form-control" placeholder="Textarea" name="description" id="ckplot"></textarea>
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
        $(document).ready(function(){
            $('#myform').validate({
                rules:{
                    title : {
                        required : true,
                    },
                    days : {
                        required :true,
                    },
                    'packagePrice':{
                      required :true,
                    },
                    'image' : {
                      required : true,
                      accept: "image/jpg,image/jpeg,image/png,image/gif",
                    },
                    'file[]' :{
                      required :true,
                      accept: "image/jpg,image/jpeg,image/png,image/gif",
                    },
                    description:{
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
                    'packagePrice':{
                      required:'please enter package price',
                    },
                    'image':{
                      required : "please select Image",
                      accept : 'Please upload Valid Image',
                    },
                    'file[]':{
                      required : "please select Image",
                      accept : 'Please upload Valid Image',
                    },
                    description:{
                      required:"plase enter description",
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