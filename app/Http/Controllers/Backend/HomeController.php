<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch the count of sales records for each day
        $end_date = now(); // Current date

        for ($i = 6; $i >= 0; $i--) {
            $dates[] = now()->subDays($i)->toDateString();
        }
        
        // Create a temporary table to store the date range
        DB::statement('CREATE TEMPORARY TABLE temp_dates (date DATE)');
        foreach ($dates as $date) {
            DB::table('temp_dates')->insert(['date' => $date]);
        }

        // Fetch the count of book records for each day
        $booksCountData = DB::table('temp_dates')
            ->leftJoin('books', 'temp_dates.date', '=', DB::raw('DATE(books.created_at)'))
            ->groupBy('temp_dates.date')
            ->orderBy('temp_dates.date')
            ->selectRaw('temp_dates.date as date, COUNT(books.id) as count')
            ->get()
            ->toArray();

        $salesCountData = DB::table('temp_dates')
            ->leftJoin('sales', 'temp_dates.date', '=', DB::raw('DATE(sales.created_at)'))
            ->groupBy('temp_dates.date')
            ->orderBy('temp_dates.date')
            ->selectRaw('temp_dates.date as date, COUNT(sales.id) as count')
            ->get()
            ->toArray();

        $customersCountData = DB::table('temp_dates')
            ->leftJoin('customers', 'temp_dates.date', '=', DB::raw('DATE(customers.created_at)'))
            ->groupBy('temp_dates.date')
            ->orderBy('temp_dates.date')
            ->selectRaw('temp_dates.date as date, COUNT(customers.id) as count')
            ->get()
            ->toArray();

        // Drop the temporary table
        DB::statement('DROP TEMPORARY TABLE temp_dates');
    
        return view('admin.home', compact('salesCountData','customersCountData','booksCountData')); // Pass $interval to the view.
    }

}
