<?php

namespace App\Http\Controllers;

use Str;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories;
use App\Models\Category;
use Illuminate\Support\Facades\Config;


class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$data=$this->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $category=strip_tags($request->category);
        $uuid=Str::uuid();
       
        $array=['name'=>$category,'uuid'=>$uuid];
        $data=$this->categoryRepository->create($array);

        return Config::get('constants.cat_add');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $id=$request->id;
        $data=$this->categoryRepository->edit($id);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //echo "hye";
        $id=$request->id;
        $data=$this->categoryRepository->update($id,['name'=>strip_tags($request->category)]);
        return response()->json(['message'=>Config::get('constants.cat_update'),'id'=>$id ,'name'=>$request->category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id=$request->id;        
        $data=$this->categoryRepository->delete($id);
        return response()->json(['message'=>Config::get('constants.cat_delete'),'id'=>$id]);
    }
}
