<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Database\QueryException;
use App\Http\Requests\SaleStoreRequest;
use App\Repositories\Interfaces\{
    SaleRepositoryInterface, 
    BookRepositoryInterface,
    CustomerRepositoryInterface,
};

class SaleController extends Controller
{
    protected $saleRepository, $bookRepository, $customerRepository;

    public function __construct(
        SaleRepositoryInterface $saleRepository, 
        BookRepositoryInterface $bookRepository,
        CustomerRepositoryInterface $customerRepository
    ){
        $this->saleRepository = $saleRepository;
        $this->bookRepository = $bookRepository;
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index()
    {
        $sales = $this->saleRepository->allWithPaginate(30);

        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = $this->bookRepository->all();
        $customers = $this->customerRepository->all();
        return view('admin.sales.create',compact('books','customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleStoreRequest $request)
    {
        $status = $this->saleRepository->create($request->all());

        ($status) ? $message = trans('cruds.sale.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.sale.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.sale.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('admin.sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $books = $this->bookRepository->all();
        $customers = $this->customerRepository->all();
        return view('admin.sales.edit',compact('sale','books','customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleStoreRequest $request, Sale $sale)
    {
        $status = $this->saleRepository->update($sale, $request->all());

        ($status) ? $message = trans('cruds.sale.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.sale.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.sale.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        try {
            $sale->delete();
            
            return redirect()->route('admin.sale.index');

        } catch (QueryException $e) {
            toast('A foreign data is existing.','error');
            return redirect()->route('admin.sale.index');
        }
    }

    /**
     * Filter users by request
     * @param \Illuminate\Http\Request  $request
     * @return Collection
     */
    public function search(Request $request){
        $key = $request->search;

        $sales = $this->saleRepository->search($key);

        return view('admin.sales.index', compact('sales', 'key'));
    }
}
