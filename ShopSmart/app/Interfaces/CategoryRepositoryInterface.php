<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface 
{
    public function get();
    public function edit($id);
    public function delete($id);
    public function create(array $details);
    public function update($id, array $newDetails);
}