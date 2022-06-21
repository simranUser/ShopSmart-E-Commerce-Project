<?php

namespace App\Interfaces;

interface ProductRepositoryInterface 
{
    public function get();
    public function edit($id);
    public function editwith($id);
    public function delete($id);
    public function filter($text);
    public function create(array $details);
    public function update($id, array $newDetails);
    public function getbycondition(array $details);
    public function getbynotcondition(array $details);
}