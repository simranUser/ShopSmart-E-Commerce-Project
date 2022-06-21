<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Auth;

class AdminVendorsController extends Controller
{
    //
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    function show(Request $request)
    {
        $data=$this->userRepository->getwithcondition(['role'=>'vendor']);
        return view('adminVendors',compact('data'));
    }

    public function accept(Request $request)
    {
        $id=$request->id;
        $data=$this->userRepository->update($id,['status'=>'accepted']);
        return response()->json(['message'=>Config::get('constants.vendor_accept'),'id'=>$id]);
    }

    public function reject(Request $request)
    {
        $id=$request->id;
        $data=$this->userRepository->update($id,['status'=>'rejected']);
        return response()->json(['message'=>Config::get('constants.vendor_reject'),'id'=>$id]);
    }
}
