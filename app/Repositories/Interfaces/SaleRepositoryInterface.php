<?php
namespace App\Repositories\Interfaces;

use App\Models\Sale;

Interface SaleRepositoryInterface{
    public function allWithPaginate($paginate);
    public function create($data);
    public function update(Sale $sale, $data);
    public function search($key);
}
