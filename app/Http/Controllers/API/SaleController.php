<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ApiPaginatorHelper;
use Illuminate\Database\QueryException;
use App\Http\Resources\SaleResource;
use App\Repositories\Interfaces\SaleRepositoryInterface;
use App\Http\Requests\SaleStoreRequest;

class SaleController extends Controller
{
    protected $saleRepository;

    public function __construct(SaleRepositoryInterface $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(Request $request)
    {
        $sales = $this->saleRepository->allWithPaginate(30);

        $data = SaleResource::collection($sales);

        // Use the helper to format the paginated response
        $formattedData = ApiPaginatorHelper::format($sales, $data);

        return response()->json($formattedData, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleStoreRequest $request)
    {
        $sale = $this->saleRepository->create($request->all());
        
        $data = new SaleResource($sale);

        return response()->json([
            'data' => $data,
            'message' => 'Sale created successfully',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function show($sale)
    {
        $sale = Sale::findOrFail($sale);
        $data = new SaleResource($sale);

        return response()->json([
            'data' => $data,
            'message' => 'Sale fetched successfully',
        ], Response::HTTP_OK);
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
        $sale = $this->saleRepository->update($sale,$request->all());
        $data = new SaleResource($sale);

        return response()->json([
            'data' => $data,
            'message' => 'Sale updated successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete($sale);
        
        return response()->json([
            'message' => 'Sale deleted successfully',
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
        $sales = $this->saleRepository->search($key);

        $data = SaleResource::collection($sales);

        // Use the helper to format the paginated response
        $formattedData = ApiPaginatorHelper::format($sales, $data);

        return response()->json($formattedData, Response::HTTP_OK);
    }
}
