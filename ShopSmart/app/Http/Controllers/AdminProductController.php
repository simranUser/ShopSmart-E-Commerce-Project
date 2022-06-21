<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories;
use App\Models\Product;
use Illuminate\Support\Facades\Config;
use Auth;


class AdminProductController extends Controller
{
    //repository instances
    private ProductRepositoryInterface $productRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(ProductRepositoryInterface $productRepository,CategoryRepositoryInterface $categoryRepository,UserRepositoryInterface $userRepository) 
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;

    }

    public function show()
    {
        //
        $data=$this->productRepository->getbynotcondition(["status","!=","uploaded"]);
        $data2=$this->userRepository->getvendors();
        return view('allProducts',compact('data','data2'));
    }

    public function filter(Request $request)
    {
        //
        $input=$request->input;
        $data=$this->productRepository->filter($input);
        return $data;
    }

    public function editproduct(Request $request)
    {
        //
        $id=$request->id;
        $data=$this->productRepository->edit($id);
        return $data;
    }

    public function updateproduct(Request $request)
    {
        //
        $id=$request->id;
        $price=$request->price;
        $data=$this->productRepository->update($id,['price'=>$price]);
        return response()->json(['message'=>Config::get('constants.product_update'),'price'=>$price ,'id'=>$id ]);
    }

    public function accept(Request $request)
    {
        //
        //return "accepted";
        $id=$request->id;
        $data=$this->productRepository->update($id,['status'=>'accepted']);
        return response()->json(['message'=>Config::get('constants.product_accept') ,'id'=>$id ]);
    }

    public function reject(Request $request)
    {
        //
       //return "rejected";
       $id=$request->id;
       $data=$this->productRepository->update($id,['status'=>'rejected']);
       return response()->json(['message'=>Config::get('constants.product_reject') ,'id'=>$id ]);

    }

}
