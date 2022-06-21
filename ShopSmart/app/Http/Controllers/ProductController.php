<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Repositories;
use App\Models\Product;
use Illuminate\Support\Facades\Config;
use Auth;


class ProductController extends Controller
{
    //repository instances
    private ProductRepositoryInterface $productRepository;
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository,CategoryRepositoryInterface $categoryRepository) 
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;

    }

    public function index()
    {
        $email=Auth::user()->email;
        $data=$this->productRepository->getbycondition(['vendor'=>$email]);
        return view('viewProducts',compact('data'));
    }

    public function store(Request $request)
    {
        $uuid=Str::uuid();
        //image
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/uploads');
        $storeimage = substr($path, 15);
        
        $array=
        [
            'name'=>strip_tags($request->name),
            'description'=>strip_tags($request->description),
            'price'=>strip_tags($request->price),
            'CatId'=>strip_tags($request->catid),
            'image'=>strip_tags($storeimage),
            'uuid'=>$uuid,
            'vendor'=>strip_tags($request->vendor),
        ];

        $data=$this->productRepository->create($array);
        return Config::get('constants.product_add');
    }

    public function show()
    {
        //
        $data=$this->categoryRepository->get();
        return view('vendorproductform',compact('data'));
    }

    public function edit(Request $request)
    {
        //
        $uuid=$request->uuid;
        $data=$this->categoryRepository->get();
        $data2=$this->productRepository->editwith($uuid,['category']);
        return view('editProduct',compact('data','data2'));
    }

    public function update(Request $request)
    {
        //
        if($request->file('image'))
        {
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/uploads');
        $storeimage = substr($path, 15);
        }
        else
        {
            $storeimage = $request->imageinput;
        }
        $id=$request->editid;

        $array=
        [
            'name'=>strip_tags($request->name),
            'description'=>strip_tags($request->description),
            'price'=>strip_tags($request->price),
            'CatId'=>strip_tags($request->catid),
            'image'=>strip_tags($storeimage),
        ];
        $data=$this->productRepository->update($id,$array);
        return Config::get('constants.product_update');
    }

    public function destroy(Request $request)
    {
        $id=$request->id;
        $data=$this->productRepository->delete($id);
        //return $id;
        return response()->json(['id' => $id, 'message' => Config::get('constants.product_delete') ]);
    }

    public function showaddProduct()
    {
        $email=Auth::user()->email;
        $data=$this->productRepository->getbycondition(['vendor'=>$email,'status'=>'accepted']);
        return view('addProduct',compact('data'));
    }

    public function upload(Request $request)
    {
        $id=$request->id;
        $data=$this->productRepository->update($id,['status'=>'uploaded']);
        return response()->json(['message'=>Config::get('constants.product_upload'),'id'=>$id]);
    }


}
