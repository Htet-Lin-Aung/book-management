<?php
namespace App\Repositories\Interfaces;

use App\Models\Book;

Interface BookRepositoryInterface{
    public function all();
    public function allWithPaginate($paginate);
    public function create($data);
    public function update(Book $book, $data);
    public function search($key);
}
