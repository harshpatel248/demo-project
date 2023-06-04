<?php
require('conn.php');


if (!isset($_SESSION['username'])) {
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
      <h4>Home</h4>
    </div>
  </div>

  <div class="br-pagebody">
    <div class="br-section-wrapper">
        
    </div>
  </div><!-- br-pagebody -->
  <?php require 'footer.php'; ?>
</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<!-- <script src="../lib/jquery/jquery.min.js"></script>
<script src="../lib/jquery-ui/ui/widgets/datepicker.js"></script>
<script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../lib/moment/min/moment.min.js"></script>
<script src="../lib/peity/jquery.peity.min.js"></script>
<script src="../lib/rickshaw/vendor/d3.min.js"></script>
<script src="../lib/rickshaw/vendor/d3.layout.min.js"></script>
<script src="../lib/rickshaw/rickshaw.min.js"></script>
<script src="../lib/jquery.flot/jquery.flot.js"></script>
<script src="../lib/jquery.flot/jquery.flot.resize.js"></script>
<script src="../lib/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="../lib/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="../lib/echarts/echarts.min.js"></script>
<script src="../lib/select2/js/select2.full.min.js"></script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyAq8o5-8Y5pudbJMJtDFzb8aHiWJufa5fg"></script>
<script src="../lib/gmaps/gmaps.min.js"></script>

<script src="../js/bracket.js"></script>
<script src="../js/map.shiftworker.js"></script>
<script src="../js/ResizeSensor.js"></script>
<script src="../js/dashboard.js"></script> -->
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