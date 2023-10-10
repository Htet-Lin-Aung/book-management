<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Http\Requests\{CategoryStoreRequest,CategoryUpdateRequest};

class CategoryController extends Controller
{
    protected $categoryRepositoryInterface;

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
    public function index()
    {
        $categories = $this->categoryRepository->allWithPaginate(30);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        // dd($request->all());
        $status = $this->categoryRepository->create($request->all());

        ($status) ? $message = trans('cruds.category.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.category.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
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
        $status = $this->categoryRepository->update($category, $request->all());

        ($status) ? $message = trans('cruds.category.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.category.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('admin.category.index');
    }

    /**
     * Filter users by request
     * @param \Illuminate\Http\Request  $request
     * @return Collection
     */
    public function search(Request $request){
        $key = $request->search;

        $categories = $this->categoryRepository->search($key);

        return view('admin.categories.index', compact('categories', 'key'));
    }
}
