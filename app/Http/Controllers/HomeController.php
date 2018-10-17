<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Budget::groupBy(DB::raw('CAST(date AS DATE)'))->where('value', '>', 0)->get();
        $expenses = Budget::groupBy(DB::raw('CAST(date AS DATE)'))->where('value', '<', 0)->get();
        $totalMoney = Budget::groupBy(DB::raw('CAST(date AS DATE)'))->selectRaw('sum(value) as value_sum, date')->get();

        $parcels = Parcel::all();

        return view('home', compact('incomes', 'expenses', 'parcels', 'totalMoney'));
    }
}
