<?php 
require_once('conn.php');
 

    
if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

   $sql = "SELECT * FROM `user` where `username`='$username' and `password` = '$password' ";
   $result = mysqli_query($con,$sql);

   if(mysqli_num_rows($result) > 0){
   
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    $_SESSION['id'] = $row['id'];
    // print_r($_SESSION['id']);die;
    // print_r($_SESSION['username']);die;
    header('location:index.php');

   }
   else{
    $_SESSION['message'] = "Invalid username or password";
   }




}



?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themepixels.me/demo/bracketplus1.4/app/template/signin-simple.html by HTTrack Website Copier/3.x [XR&CO'2010], Sat, 12 Sep 2020 04:43:18 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket Plus">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="../../../../bracketplus/img/bracketplus-social.html">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracketplus">
    <meta property="og:title" content="Bracket Plus">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="../../../../bracketplus/img/bracketplus-social.html">
    <meta property="og:image:secure_url" content="../../../../bracketplus/img/bracketplus-social.html">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Bracket Plus Responsive Bootstrap 4 Admin Template</title>

    <!-- vendor css -->
    <link href="lib/_fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="css/bracket.css">
    <style type="text/css">
        .error {
    color: red;
}
    </style>
</head>

<body>

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal"></span> Admin <span class="tx-info">panel</span> <span class="tx-normal"></span></div>
        <!-- <div class="tx-center mg-b-60">The Admin Template For Perfectionist</div> -->
        <div>
                <?php if (isset($_SESSION['message'])) { ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?php echo $_SESSION['message']; ?></strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php unset($_SESSION['message']); } ?>
              </div>
        <form method="post" id="MyForm" action="">
        <div class="form-group">
          <input type="text" class="form-control" name="username" placeholder="Enter your username">
      </div><!-- form-group -->
      <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Enter your password">
          <a href="password-reset.php" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
      </div><!-- form-group -->
      <button type="submit" class="btn btn-info btn-block" name="submit">Sign In</button>
      </form>
      <div class="mg-t-60 tx-center">Not yet a member? <a href="#" class="tx-info">Sign Up</a></div>
  </div><!-- login-wrapper -->
</div><!-- d-flex -->

<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery-ui/ui/widgets/datepicker.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- jquery validate cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).ready(function() {
$("#MyForm").validate({
rules: {
'username': {
required: true,
},
'password':{
required: true,
minlength: 5,
},
},
messages: {
'username': "Please enter your username",
'password': {
     required: "Please enter a Password",
     minlength: "Your password must be at least 5 characters long",
    }
}
});
});
</script>
</body>

<!-- Mirrored from themepixels.me/demo/bracketplus1.4/app/template/signin-simple.html by HTTrack Website Copier/3.x [XR&CO'2010], Sat, 12 Sep 2020 04:43:18 GMT -->
</html>
