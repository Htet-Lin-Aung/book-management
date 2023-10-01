<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ApiPaginatorHelper;
use Illuminate\Database\QueryException;
use App\Http\Resources\BookResource;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Http\Requests\BookStoreRequest;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(Request $request)
    {
        $books = $this->bookRepository->allWithPaginate(30);
        $data = BookResource::collection($books);

        // Use the helper to format the paginated response
        $formattedData = ApiPaginatorHelper::format($books, $data);

        return response()->json($formattedData, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $book = $this->bookRepository->create($request->all());
        $data = new BookResource($book);

        return response()->json([
            'data' => $data,
            'message' => 'Book created successfully',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function show($book)
    {
        $book = Book::findOrFail($book);
        $data = new BookResource($book);

        return response()->json([
            'data' => $data,
            'message' => 'Book fetched successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookStoreRequest $request, book $book)
    {
        $book = $this->bookRepository->update($book,$request->all());
        $data = new BookResource($book);

        return response()->json([
            'data' => $data,
            'message' => 'Book updated successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete($book);
        
        return response()->json([
            'message' => 'Book deleted successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Filter users by request
     * @param \Illuminate\Http\Request  $request
     * @return Collection
     */
    public function search(Request $request)
    {            
        $key = $request->search;
        $books = $this->bookRepository->search($key);

        $data = BookResource::collection($books);

        // Use the helper to format the paginated response
        $formattedData = ApiPaginatorHelper::format($books, $data);

        return response()->json($formattedData, Response::HTTP_OK);        
    }
}
