<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Jobs\SendEmailJob;
use Carbon\Carbon; 
use App\Models\Product;

class taskController extends Controller
{
    // for testing mail 
    public function mail(Request $request)
    {
    //    $data = array('name'=>"simran");
   
    //     Mail::send(['text'=>'mail'], $data, function($message) {
    //         $message->to('gurmeetjosan595@gmail.com', 'Tutorials Point')->subject
    //             ('Laravel Basic Testing Mail');
    //         $message->from('simranjeetkaur7898@gmail.com','simran');
    //     });
    //     echo "Basic Email Sent. Check your inbox.";


    // $dispatchvariable = (new SendEmailJob())->delay(Carbon::now()->addSeconds(3));
    // dispatch($dispatchvariable);
    // echo 'email sent';


    //dispatching jobs from job named sendEmailJob
    $emailJob = new SendEmailJob();
    dispatch($emailJob);

   // echo $storage_path = storage_path();
    }

    public function chart(Request $request)
    {
        $products=Product::all();
        return view('chart',compact('products'));
    }
}
