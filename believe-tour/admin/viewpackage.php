<?php 
  require('conn.php');
  
if(!isset($_SESSION['username'])){
  header('location:sign-in.php');
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
            <h4>View Package</h4>
          </div>
        </div>

        <div class="br-pagebody">

          <div class="col-sm-12">
          
            <div class="br-section-wrapper">
            <div class="col-sm-3">
              <a href="package.php" class="btn btn-primary btn-block mg-b-10">Add Package</a>
            </div>
            <div>
            <?php
          //message
        if (isset($_SESSION['message'])) { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                <h6 class="br-section-label">view Slider</h6>

                <div class="table-wrapper">
                <table id='example'>
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Days</th>
                      <th>Package Price</th>
                      <th>Featured Image</th>
                      <th>Images</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sql = "SELECT * FROM `package`";
                    $result =mysqli_query($con,$sql);
                    if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $days = $row['days'];
                        $packagePrice =$row['packagePrice'];
                        $file = $row['file'];
                        $images = json_decode($row['image']);
                      
                        echo "<tr>
                          <td>".$title."</td>
                          <td>".$days."</td>  
                          <td>".$packagePrice."</td>   
                          <td><img height='50' width='50' src='uploads/".$file."'  class='rounded-circle' ></td> 
                          <td>";
                          foreach($images as $img){
                            echo '<img height="50" width="50" src="uploads/'.$img.'" class="rounded-circle" >';
                          }
                        echo "</td>    
                          <td>
                           <a href='update_package.php?update=".$id."' class='btn btn-primary btn-sm'>Update</a> 
                          <a href='delete_package.php?delete=".$id."' class='btn btn-danger btn-sm'>Delete</a></td>
                        </tr>";
                      }

                    }
                    else {
                      echo "<tr><td>No data found</td></tr>";
                    }

                     ?>
                    
                  </tbody>
                </table>
          </div>

          </div>
        </div>
        

        </div><!-- br-pagebody -->
        <?php require 'footer.php'; ?>
      </div><!-- br-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->

     
      <!-- datatable -->
      <script src="lib/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
        <script type="text/javascript">
         $(document).ready(function () {
         $('#example').DataTable();
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
