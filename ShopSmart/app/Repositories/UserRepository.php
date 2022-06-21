<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function get() 
    {
        return User::paginate(8);
    }

    public function getvendors() 
    {
        return User::where('role','vendor')->paginate(8);
    }

    public function getwithcondition(array $array) 
    {
        return User::where($array)->paginate(8);
    }

    public function edit($id) 
    {
        return User::findOrFail($id);
    }
    
    public function delete($id) 
    {
        User::destroy($id);
    }

    public function update($id, array $newDetails) 
    {
        return User::whereId($id)->update($newDetails);
    }

}