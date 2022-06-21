<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Stripe\PaymentIntent;
//use Stripe\Charge;
use Session;
use \Stripe\Stripe;
use \Stripe\Account;

class CheckoutController extends Controller
{

    function form()
    {
       return view('checkout');
    }

    function create()
    {

        // This is your test secret API key.
        Stripe::setApiKey('sk_test_51KyTVvSFqPVpcKeoE4TIvK7no1IRfiT6Cue69TPfBiZp7g32N6GHgRzEOj4QXkc9okizp0wGz4MV0SBK40zCkRv500qcv5m9Ef');
        header('Content-Type: application/json');

        try {

            // Create a PaymentIntent with amount and currency
            $paymentIntent = PaymentIntent::create([
                'amount' => '2000'*100,
                'currency' => 'INR',
                'description' => 'Software development services',
                'payment_method_options[card][request_three_d_secure]'=>'any',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'application_fee_amount' => 123*100,
                'transfer_data' => [
                    'destination' => 'acct_1L5MTJSDQ9ZczysD',
                ],
                //'on_behalf_of' => $account->id,
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
        } 
        catch (Error $e) 
        {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

}