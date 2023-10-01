<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all()
    {
        return Customer::all();
    }

    public function allWithPaginate($paginate)
    {
        return Customer::paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $data['password'] = bcrypt($data['password']);
            $customer = Customer::create($data);
            DB::commit();
            return $customer;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(Customer $customer, $data)
    {
        DB::beginTransaction();
        try{
            if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                // Remove the password field from the data if it's not provided
                unset($data['password']);
            }
            $customer->update($data);
            DB::commit();
            return $customer;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function search($key)
    {
        $customers = Customer::where('name', 'LIKE', '%' . $key . '%')
        ->paginate(30);

        return $customers;
    }
}
