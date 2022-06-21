<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Config;
use Str;
use Mail;

class AddToCartController extends Controller
{
    
    public function put(Request $request)
    {
        //$uuid=$request->uuid;
        $id=$request->id;
        $product = Product::findOrFail($request->id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) 
        {
            $cart[$id]['quantity']++;
        } 
        else 
        {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);
        return Config::get('constants.add_cart'); 
    }
    
    public function get(Request $request)
    {
        return $request->session()->get('cart');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', Config::get('constants.update_cart'));
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) 
        {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', Config::get('constants.remove_cart'));
        }
    }

    public function cart()
    {
        return view('cart');
    }

    // public function order()
    // {$cart = session()->get('cart');id,
    //             'paystatus'=>'pending',
    //             'orderstatus'=>'pending',
    //             'customerId'=>'abcd'
    //         ]);
    //     }
    //     return 'Inserted';
    // }

    //for testing mail 
    // public function mail(Request $request)
    // {
    //    $data = array('name'=>"simran");
   
    //     Mail::send(['text'=>'mail'], $data, function($message) {
    //         $message->to('gurmeetjosan595@gmail.com', 'Tutorials Point')->subject
    //             ('Laravel Basic Testing Mail');
    //         $message->from('simranjeetkaur7898@gmail.com','simran');
    //     });
    //     echo "Basic Email Sent. Check your inbox.";
    // }
    
    //to make cart empty
    function removeSession()
    {
        session()->forget('cart'); 
    }
}
