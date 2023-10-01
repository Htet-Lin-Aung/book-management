<?php

namespace App\Repositories;

use Exception;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\SaleRepositoryInterface;

class SaleRepository implements SaleRepositoryInterface
{
    public function allWithPaginate($paginate)
    {
        return Sale::with(['book','customer'])->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $sale = Sale::create($data);
            DB::commit();
            return $sale;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(Sale $sale, $data)
    {
        DB::beginTransaction();
        try{
            $sale->update($data);
            DB::commit();
            return $sale;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function search($key)
    {
        $sales = Sale::whereHas('customer', function ($query) use ($key) {
            $query->where('name', 'LIKE', '%' . $key . '%');
        })
        ->orWhereHas('book', function ($query) use ($key) {
            $query->where('name', 'LIKE', '%' . $key . '%');
        })
        ->paginate(30);
    
        return $sales;
    }
}
