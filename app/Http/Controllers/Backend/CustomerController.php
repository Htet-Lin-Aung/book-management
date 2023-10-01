<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Http\Requests\{CustomerStoreRequest, CustomerUpdateRequest};

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
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
        $customers = $this->customerRepository->allWithPaginate(30);

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        $status = $this->customerRepository->create($request->all());

        ($status) ? $message = trans('cruds.customer.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.customer.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $status = $this->customerRepository->update($customer, $request->all());

        ($status) ? $message = trans('cruds.customer.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.customer.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            
            return redirect()->route('admin.customer.index');

        } catch (QueryException $e) {
            toast('A child data is existing.','error');
            return redirect()->route('admin.customer.index');
        }
    }

    /**
     * Filter users by request
     * @param \Illuminate\Http\Request  $request
     * @return Collection
     */
    public function search(Request $request){
        $key = $request->search;

        $customers = $this->customerRepository->search($key);

        return view('admin.customers.index', compact('customers', 'key'));
    }
}
