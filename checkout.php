<?php
require '../stripe-php-master/init.php';
$stripe = new \Stripe\StripeClient(
  'sk_test_51HWuVJDkt38z7w7ydHb0wlnPOyjPPdCzRVfoOhY3ZCEAsyosFufq3vnklAG065jrktyrFXEb2CxnOG3aMf033LD900Ivw9SGHB'
);

$all_countries = $stripe->countrySpecs->all();
print "<pre>";print_r($all_countries);


$all_prices = $stripe->prices->all(['active'=>true,'product'=>'prod_I7A0eL8jbPPdW8']);
$prices_array = (array) $all_prices->data;
//print "<pre>";print_r($prices_array);

foreach($prices_array as $each_prices_array){
	echo $each_prices_array->id;
	echo "<br/>";
	echo $each_prices_array->unit_amount;
	echo "<br/>";
	echo $each_prices_array->currency;
	echo "<br/><br/>";
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Buy cool new product</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <section>
      <div class="product">
        <img
          src="https://i.imgur.com/EHyR2nP.png"
          alt="The cover of Stubborn Attachments"
        />
        <div class="description">
          <h3>Stubborn Attachments</h3>
          <h5>$20.00</h5>
        </div>
      </div>
      <button id="checkout-button">Checkout</button>
    </section>
  </body>
  <script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    //var stripe = Stripe("pk_test_51HWuVJDkt38z7w7yspBMbAxfaXGqnxDKy5DoXSK3tSU5F4Fe274OMIzQRs1OzigVp1GUGx66gUq1Ou6qVAanX1oc00Gkhilc7M");
	var stripe = Stripe("pk_test_51HWuVJDkt38z7w7yspBMbAxfaXGqnxDKy5DoXSK3tSU5F4Fe274OMIzQRs1OzigVp1GUGx66gUq1Ou6qVAanX1oc00Gkhilc7M");
    var checkoutButton = document.getElementById("checkout-button");

    checkoutButton.addEventListener("click", function () {
      fetch("stripe-create-session.php", {
        method: "POST",
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
          // If redirectToCheckout fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using error.message.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function (error) {
          console.error("Error:", error);
        });
    });
  </script>
</html>