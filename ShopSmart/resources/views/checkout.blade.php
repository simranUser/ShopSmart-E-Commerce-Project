<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Accept a payment</title>
    <meta name="description" content="A demo of a payment on Stripe" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}" />
    <!-- <meta http-equiv="Content-Security-Policy" content="img-src 'self' data: https://*.stripe.com  http://127.0.0.1:8000;
         default-src *; 
         style-src 'self'  checkout.stripe.com;; 
         script-src * 'self' https://js.stripe.com
         https://checkout.stripe.com;
        ;
         connect-src  * 'self'  *.stripe.com;
         frame-src  * 'self' * https://js.stripe.com https://hooks.stripe.com http://127.0.0.1:8000;
       
         ;" 
         > -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <!-- Display a payment form -->
    <form id="payment-form">
      <div id="payment-element">
        <!--Stripe.js injects the Payment Element-->
      </div>
      <button id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Pay now</span>
      </button>
      <div id="payment-message" class="hidden"></div>
      <br><br>
      <a href="/userhome" class="btn btn-warning" style="margin-left:180px;"><i class="fa fa-angle-left"></i> Go back </a>
    </form>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>    <script src="{{asset('js/checkout.js')}}"></script>
  </body>
</html>

