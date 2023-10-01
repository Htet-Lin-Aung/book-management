<?php

namespace App\Repositories;

use Exception;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    public function allWithPaginate($paginate)
    {
        return Sale::selectRaw('customer_id, 
            SUM(quantity) as quantity, 
            SUM(discount) as discount, 
            SUM(total) as total, 
            SUM(paid) as paid'
        )
        ->groupBy('customer_id')
        ->paginate($paginate);
    }

    public function search($key)
    {
        $reports = Sale::join('customers', 'sales.customer_id', '=', 'customers.id')
        ->where('customers.name', 'LIKE', '%' . $key . '%')
        ->selectRaw('sales.customer_id, 
            SUM(sales.quantity) as quantity, 
            SUM(sales.discount) as discount, 
            SUM(sales.total) as total, 
            SUM(sales.paid) as paid'
        )
        ->groupBy('sales.customer_id')
        ->paginate(30);

        return $reports;
    }
}
