<?php

require_once ('vendor/autoload.php');

// $customer = \Stripe\Customer::create([
//     'email' => 'customer@example.com',
    
//   ]);
    \Stripe\Stripe::setApiKey("sk_test_51NDMOUSD0j8SIVZgSN99eS62GTD8koItwPodtx4cFs9kfvpihSSrIJnRD4PGSycD0tsqaXQiQwFdHJKF1nrW7S9Y00BwcFutfk");
  $charge = \Stripe\PaymentIntent::create([
    'source' => $_POST['stripeToken'],
    'description' => 'Custom t-shirt',
    // 'customer' => $customer->id,
    'amount' => 5000,
    'currency' => 'usd',
  ]);
//   echo "<pre>";
// print_r($charge);die;
?>