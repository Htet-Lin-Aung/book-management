<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ApiPaginatorHelper;
use Illuminate\Database\QueryException;
use App\Http\Resources\CategoryResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Http\Requests\{CategoryStoreRequest,CategoryUpdateRequest};
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->allWithPaginate(30);
        $data = CategoryResource::collection($categories);

        // Use the helper to format the paginated response
        $formattedData = ApiPaginatorHelper::format($categories, $data);

        return response()->json($formattedData, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = $this->categoryRepository->create($request->all());
        $data = new CategoryResource($category);

        return response()->json([
            'data' => $data,
            'message' => 'Category created successfully',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function show($category)
    {
        $category = Category::findOrFail($category);
        $data = new CategoryResource($category);

        return response()->json([
            'data' => $data,
            'message' => 'Category fetched successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category = $this->categoryRepository->update($category,$request->all());
        $data = new CategoryResource($category);

        return response()->json([
            'data' => $data,
            'message' => 'Category updated successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete($category);
        
        return response()->json([
            'message' => 'Category deleted successfully',
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
        $categories = $this->categoryRepository->search($key);

        $data = CategoryResource::collection($categories);

        // Use the helper to format the paginated response
        $formattedData = ApiPaginatorHelper::format($categories, $data);

        return response()->json($formattedData, Response::HTTP_OK);
    }
}
