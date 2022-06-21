<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data=Category::paginate(8);
        return view('dashboard',compact('data'));
    }

    public function user()
    {
        $products = Product::where('status','uploaded')->get();
        return view('userdashboard',compact('products'));
    }

    public function vendor()
    {
        $data=Category::all();
        return view('vendordashboard',compact('data'));
    }
}
