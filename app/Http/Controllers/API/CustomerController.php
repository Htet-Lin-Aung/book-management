<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ApiPaginatorHelper;
use Illuminate\Database\QueryException;
use App\Http\Resources\CustomerResource;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Http\Requests\{CustomerStoreRequest,CustomerUpdateRequest};

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
    public function index(Request $request)
    {
        $customers = $this->customerRepository->allWithPaginate(30);

        $data = CustomerResource::collection($customers);

        // Use the helper to format the paginated response
        $formattedData = ApiPaginatorHelper::format($customers, $data);

        return response()->json($formattedData, Response::HTTP_OK);
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
        $customer = $this->customerRepository->update($customer,$request->all());
        
        $data = new CustomerResource($customer);

        return response()->json([
            'data' => $data,
            'message' => 'Customer updated successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function show($customer)
    {
        $customer = Customer::findOrFail($customer);
        $data = new CustomerResource($customer);

        return response()->json([
            'data' => $data,
            'message' => 'Customer fetched successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete($customer);
        
        return response()->json([
            'message' => 'Customer deleted successfully',
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
        $customers = $this->customerRepository->search($key);

        $data = CustomerResource::collection($customers);

        // Use the helper to format the paginated response
        $formattedData = ApiPaginatorHelper::format($customers, $data);

        return response()->json($formattedData, Response::HTTP_OK);
    }
}
