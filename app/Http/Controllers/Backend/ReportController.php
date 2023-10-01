<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ReportRepositoryInterface;

class ReportController extends Controller
{
    protected $reportRepository;

    public function __construct(ReportRepositoryInterface $reportRepository){
        $this->reportRepository = $reportRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index()
    {
        $reports = $this->reportRepository->allWithPaginate(30);

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Filter users by request
     * @param \Illuminate\Http\Request  $request
     * @return Collection
     */
    public function search(Request $request){
        $key = $request->search;

        $reports = $this->reportRepository->search($key);

        return view('admin.reports.index', compact('reports', 'key'));
    }
}