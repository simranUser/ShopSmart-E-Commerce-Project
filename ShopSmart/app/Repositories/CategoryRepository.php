<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface 
{
    public function get() 
    {
        $users = Category::paginate(8);
        return $users->withPath('custom/url');
    }

    public function edit($id) 
    {
        return Category::findOrFail($id);
    }

    public function delete($id) 
    {
        Category::destroy($id);
    }

    public function create(array $details) 
    {
        return Category::create($details);
    }

    public function update($id, array $newDetails) 
    {
        return Category::whereId($id)->update($newDetails);
    }
}