<?php

//require 'vendor/autoload.php';
require 'stripe-php-master/init.php';
//\Stripe\Stripe::setApiKey('sk_test_51HWuVJDkt38z7w7ydHb0wlnPOyjPPdCzRVfoOhY3ZCEAsyosFufq3vnklAG065jrktyrFXEb2CxnOG3aMf033LD900Ivw9SGHB');
\Stripe\Stripe::setApiKey('sk_test_51HWuVJDkt38z7w7ydHb0wlnPOyjPPdCzRVfoOhY3ZCEAsyosFufq3vnklAG065jrktyrFXEb2CxnOG3aMf033LD900Ivw9SGHB');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/test/my-stripe-test/';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
      'price' => 'price_1HWvgZDkt38z7w7ya2PD2M68',
      'quantity' => 1,
    ]],
  'mode' => 'subscription',
  'success_url' => $YOUR_DOMAIN . '/success.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
  'locale' => 'en-GB',
]);

echo json_encode(['id' => $checkout_session->id]);