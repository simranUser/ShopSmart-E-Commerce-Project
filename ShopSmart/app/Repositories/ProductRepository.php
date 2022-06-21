<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface 
{
    public function get() 
    {
        return Product::paginate(8);
    }

    public function edit($id) 
    {
        return Product::findOrFail($id);
    }
    public function editwith($id) 
    {
        return Product::with('category')->where('uuid',$id)->get();
    }

    public function delete($id) 
    {
        Product::destroy($id);
    }

    public function create(array $details) 
    {
        return Product::create($details);
    }

    public function update($id, array $newDetails) 
    {
        return Product::whereId($id)->update($newDetails);
    }

    public function getbycondition(array $details) 
    {
        return Product::where($details)->paginate(8);
    }

    public function getbynotcondition(array $details) 
    {
        return Product::where($details[0],$details[1],$details[2])->orderBy('status','desc')->paginate(8);
    }

    public function filter($text) 
    {
       return  Product::where('vendor', 'like', '%' . $text . '%')->where('status','!=','uploaded')->paginate(8);
    }

}