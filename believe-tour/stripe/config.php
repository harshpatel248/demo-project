<?php 
session_start();
if(isset($_POST['submit'])){
   $_SESSION['id']= $_POST['packageId'];
   $name = $_POST['name'];
   $email = $_POST['email'];
   $_SESSION['phone'] = $_POST['phone'];
   $_SESSION['packagePrice'] = $_POST['packagePrice'];
   $_SESSION['packageTitle'] = $_POST['packageTitle'];
   $_SESSION['checkin'] = $_POST['checkin'];
   $_SESSION['checkout'] = $_POST['checkout'];
   $_SESSION['message'] = $_POST['message'];
   
}
else{
   // header('location:../destination.php');
}

// Minimum amount is $0.50 US 
// $itemName = "Demo Product"; 
// $itemPrice = 20;  
// $currency = "USD"; 

$itemName = trim($_SESSION['packageTitle']);
$itemPrice = trim($_SESSION['packagePrice']);
$currency = "USD"; 
$packageId = $_SESSION['id'];
$phone = $_SESSION['phone'];
$checkin = $_SESSION['checkin'];
$checkout = $_SESSION['checkout'];
$descriptions = $_SESSION['message'];
/* Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */ 
define('STRIPE_API_KEY', 'sk_test_51NDkcJBp3fAC39lYMUnngsXUA8VWHEwyDDttRilY7e4ts8MIrJowwINIUWAlNVBaDeuO7FtJXPdsFiBS2u1KLQI500OqLJ0a20'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51NDkcJBp3fAC39lYkXpJVjhDdDuYouwc53UWu0IgiiPSkhESWKlQIEBOiJmZd7XJq3R1U4cpvrxxTl5IV08Z8jYA00YAn4s0Lh'); 
  
// Database configuration  
define('DB_HOST', 'localhost');  
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', '');  
define('DB_NAME', 'believe'); 
?>