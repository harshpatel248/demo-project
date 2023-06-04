<?php
require('conn.php');


if (!isset($_SESSION['username'])) {
  header('location:sign-in.php');
}

if (isset($_POST['submit'])) {

  foreach ($_POST['heading'] as $key => $value) {
    $heading[] = $value;
  }
  $heading = json_encode($heading);


  foreach ($_POST['description'] as $key => $value) {
    $values = str_ireplace(array("\r", "\n", '\r', '\n'), '', $value);
    $description[] = stripslashes($values);
  }
  $description = json_encode($description);

  $insertSql = "INSERT INTO `faq` (`heading`,`description`) VALUES ('" . $heading . "','" . $description . "')";
  $insertResult = mysqli_query($con, $insertSql);
  //  die;
  if ($insertResult) {
    $_SESSION['message'] = "Data Added Successfully";
  } else {
    $_SESSION['message'] = "Something went Wrong";
  }

}

//update
if (isset($_POST['update'])) {


  $deleteSql = "DELETE FROM `faq`";
  $deleteResult = mysqli_query($con, $deleteSql);

  foreach ($_POST['heading'] as $key => $value) {
    $heading[] = $value;
  }
  $heading = json_encode($heading);


  foreach ($_POST['description'] as $key => $value) {
    $values = str_ireplace(array("\r", "\n", '\r', '\n'), '', $value);
    $description[] = stripslashes($values);
  }
  $description = json_encode($description);

  $insertSql = "INSERT INTO `faq` (`heading`,`description`) VALUES ('" . $heading . "','" . $description . "')";
  $insertResult = mysqli_query($con, $insertSql);
  //  die;
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
      <h4>FAQ</h4>
    </div>
  </div>

  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <?php
      $sql = "SELECT * FROM `faq`";
      $result = mysqli_query($con, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $heading = json_decode($row['heading']);
          $description = json_decode($row['description']);
          // print_r($row['description']);die;
          ?>
          <div class="form-layout form-layout-1">
            <div class="container">
              <form method="post" id="myform">
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
                <div class="row fieldGroup">
                <div class="col-md-2  ">
                  <a href="javascript:void(0)" class="btn btn-success addMore mt-3">
                    <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                  </a>
                </div>
                </div>
                <?php foreach ($heading as $key => $value) {
                  
                  ?>
                  <div class="row fieldGroup">
                    <div class="col-md-12">
                   
                      <div class="form-group">
                        <label for="sectionTitle">Heading</label>
                        <input type="text" name="heading[]" id="heading" class="form-control" value="<?php echo $value; ?>">
                      </div>
                    </div>
                    
                    <div class="col-md-12">
                      <div class="form-group">
                        <h4>Description</h4>
                        <textarea name="description[]" class="editor"><?php echo $description[$key]; ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-2  ">
                <a href="javascript:void(0)" class="btn btn-danger remove mb-3"><span
                    class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
              </div>
                  </div>
                    
                  <?php } ?>
                  
                <div class="form-layout-footer">
                  <button class="btn btn-info" type="submit" name="update" value="update">update</button>
                </div>
              </form>
            </div>

            <div class="row" id="fieldGroupTemplate">
              <div class="col-md-12 ">
                <div class="form-group floating-label">
                  <label for="sectionTitle">Heading</label>
                  <input type="text" name="heading[]" id="heading" class="form-control">

                </div>
              </div>
              <div class="col-md-2  ">
                <a href="javascript:void(0)" class="btn btn-danger remove"><span
                    class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
              </div>
              <div class="col-sm-12 ">
                <div class="form-group">
                  <h4>Description</h4>
                  <textarea name="description[]"></textarea>
                </div>
              </div>
            </div>
          </div>
        <?php }
      } else { ?>


        <div class="form-layout form-layout-1">
          <div class="container">
            <form method="post" id="myform">
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
              <div class="row fieldGroup">
              <div class="col-md-2  ">
                  <a href="javascript:void(0)" class="btn btn-success addMore">
                    <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                  </a>
                </div>
                <div class="col-md-12 ">
                  <div class="form-group">
                    <label for="sectionTitle">Heading</label>
                    <input type="text" name="heading[]" id="heading" class="form-control">
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-group">
                    <h4>Description</h4>
                    <textarea name="description[]" class="editor"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-layout-footer">
                <button class="btn btn-info" type="submit" name="submit">Submit Form</button>
              </div>
            </form>
          </div>

          <div class="row" id="fieldGroupTemplate">
            <div class="col-md-12 ">
              <div class="form-group floating-label">
                <label for="sectionTitle">Heading</label>
                <input type="text" name="heading[]" id="heading" class="form-control">

              </div>
            </div>
            <div class="col-md-2  ">
              <a href="javascript:void(0)" class="btn btn-danger remove"><span
                  class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
            </div>
            <div class="col-sm-12 ">
              <div class="form-group">
                <h4>Description</h4>
                <textarea name="description[]"></textarea>
              </div>
            </div>
          </div>
        </div>

      <?php }
      ?>
    </div>
  </div><!-- br-pagebody -->
  <?php require 'footer.php'; ?>
</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.21.0/ckeditor.js"
  integrity="sha512-ff67djVavIxfsnP13CZtuHqf7VyX62ZAObYle+JlObWZvS4/VQkNVaFBOO6eyx2cum8WtiZ0pqyxLCQKC7bjcg=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.21.0/adapters/jquery.min.js"
  integrity="sha512-YRvgGnMe4D3Vyx168nR0pr1HS0zToBpfePcCa+KnAk56YqaCLJyLWrxmw2+bwvAMMBfwiCsRbHRlU9hObT5E2w=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    'heading[]': {
                        required: true,
                    },
                    'description[]': {
                        required: true,
                    },
                },
                messages: {
                    'heading[]': {
                        required: "Please enter your heading",
                    },
                    'description[]': {
                        required: "Please Enter your description",
                    },
                },
            });
        });

    </script>

<script>
  $(function () {

    //section add limit
    var maxGroup = 10;

    // initialize all current editor(s)
    $('.editor').ckeditor();


    //add more section
    $(".addMore").click(function () {

      // define the number of existing sections
      var numGroups = $('.fieldGroup').length;

      // check whether the count is less than the maximum
      if (numGroups < maxGroup) {

        // create new section from template
        var $fieldHTML = $('<div>', {
          'class': 'row fieldGroup',
          'html': $("#fieldGroupTemplate").html()
        });

        // insert new group after last one
        $('.fieldGroup:last').after($fieldHTML);

        // instantiate ckeditor on new textarea
        $fieldHTML.find('textarea').ckeditor();

      } else {
        alert('Maximum ' + maxGroup + ' sections are allowed.');
      }

    });

    //remove fields 
    $("body").on("click", ".remove", function () {
      $(this).parents(".fieldGroup").remove();
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