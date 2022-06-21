<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function get();
    public function getvendors();
    public function getwithcondition(array $array);
    public function edit($id);
    public function delete($id);
    public function update($id, array $newDetails);
}