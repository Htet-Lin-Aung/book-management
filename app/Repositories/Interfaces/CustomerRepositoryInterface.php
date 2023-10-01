<?php
namespace App\Repositories\Interfaces;

use App\Models\Customer;

Interface CustomerRepositoryInterface{
    public function all();
    public function allWithPaginate($paginate);
    public function create($data);
    public function update(Customer $customer, $data);
    public function search($key);
}
