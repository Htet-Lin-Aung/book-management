<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Http\Requests\BookStoreRequest;

class BookController extends Controller
{
    protected $bookRepository, $categoryRepository;

    public function __construct(BookRepositoryInterface $bookRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index()
    {
        $books = $this->bookRepository->allWithPaginate(30);

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();
        return view('admin.books.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $status = $this->bookRepository->create($request->all());

        ($status) ? $message = trans('cruds.book.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.book.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = $this->categoryRepository->all();
        return view('admin.books.edit', compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookStoreRequest $request, Book $book)
    {
        $status = $this->bookRepository->update($book, $request->all());

        ($status) ? $message = trans('cruds.book.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.book.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {
            
            $book->delete();
            
            return redirect()->route('admin.book.index');

        } catch (QueryException $e) {

            toast('A child data is existing.','error');

            return redirect()->route('admin.book.index');
        }
    }

    /**
     * Filter users by request
     * @param \Illuminate\Http\Request  $request
     * @return Collection
     */
    public function search(Request $request){
        $key = $request->search;

        $books = $this->bookRepository->search($key);

        return view('admin.books.index', compact('books', 'key'));
    }
}
