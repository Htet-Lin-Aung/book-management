<?php
namespace App\Repositories\Interfaces;

Interface ReportRepositoryInterface{
    public function allWithPaginate($paginate);
    public function search($key);
}
