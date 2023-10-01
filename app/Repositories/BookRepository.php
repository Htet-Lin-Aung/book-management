<?php

namespace App\Repositories;

use Exception;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function all()
    {
        return Book::with('category')->get();
    }

    public function allWithPaginate($paginate)
    {
        return Book::with('category')->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $book = Book::create($data);
            DB::commit();
            return $book;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(Book $book, $data)
    {
        DB::beginTransaction();
        try{
            $book->update($data);
            DB::commit();
            return $book;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function search($key)
    {
        $books = Book::where('name', 'LIKE', '%' . $key . '%')
            ->orWhere('author','LIKE','%'.$key.'%')
            ->orWhereHas('category', function ($query) use ($key) {
                $query->where('name', 'LIKE', '%' . $key . '%');
            })
            ->paginate(30);

        return $books;
    }
}
