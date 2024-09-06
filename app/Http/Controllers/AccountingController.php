<?php

namespace App\Http\Controllers;

use App\Models\Accounting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Sales;

class AccountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalExpense = Accounting::where('type', 'Expense')
            ->where('Currency_id', 1)
            ->sum('price');
        $totalExpenseReal = Accounting::where('type', 'Expense')
            ->where('Currency_id', 2)
            ->sum('price');
        $totalIncome = Accounting::where('type', 'Income')
            ->where('Currency_id', 1)
            ->sum('price');
        $totalIncomeReal = Accounting::where('type', 'Income')
            ->where('Currency_id', 2)
            ->sum('price');
        $countTotalSale = Sales::count();
        $countTotalOrder = Orders::count();
        return view('accounting', compact('totalExpense','totalExpenseReal','totalIncome','totalIncomeReal','countTotalSale','countTotalOrder')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accounting  $accounting
     * @return \Illuminate\Http\Response
     */
    public function show(Accounting $accounting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accounting  $accounting
     * @return \Illuminate\Http\Response
     */
    public function edit(Accounting $accounting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accounting  $accounting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accounting $accounting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accounting  $accounting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accounting $accounting)
    {
        //
    }
}
