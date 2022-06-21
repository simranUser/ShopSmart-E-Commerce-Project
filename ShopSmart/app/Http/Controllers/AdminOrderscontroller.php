<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminOrderscontroller extends Controller
{
    //
    function show()
    {
        return view('adminOrders');
    }
}
