<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ApiPaginatorHelper;
use Illuminate\Database\QueryException;
use App\Http\Resources\ReportResource;
use App\Repositories\Interfaces\ReportRepositoryInterface;

class ReportController extends Controller
{
    protected $reportRepository;

    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(Request $request)
    {
        $reports = $this->reportRepository->allWithPaginate(30);

        $data = ReportResource::collection($reports);

        // Use the helper to format the paginated response
        $formattedData = ApiPaginatorHelper::format($reports, $data);

        return response()->json($formattedData, Response::HTTP_OK);
    }

    /**
     * Filter users by request
     * @param \Illuminate\Http\Request  $request
     * @return Collection
     */
    public function search(Request $request)
    {
        $key = $request->search;
        $reports = $this->reportRepository->search($key);

        $data = ReportResource::collection($reports);

        // Use the helper to format the paginated response
        $formattedData = ApiPaginatorHelper::format($reports, $data);

        return response()->json($formattedData, Response::HTTP_OK);
    }
}
