<?php 

namespace App\Services\Contracts;

interface IPAddressServiceInterface
{
    public function store(array $attribute);
    public function update(array $attribute,$id);
    // public function delete($id);
}