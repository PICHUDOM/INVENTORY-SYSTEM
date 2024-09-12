<?php

namespace App\Http\Controllers;

use App\Models\UOM;
use App\Models\Material;
use App\Models\Currency;
use App\Models\Inventory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\MaterialCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = MaterialCategory::all();
        $Supplier = Supplier::all();
        $items = Material::all();
        $uom = UOM::all();
        $currency = Currency::all();
        $inventory = Inventory::with(['invShop', 'location'])
        ->where('S_id', Auth::user()->invshop->S_id)
        ->where('L_id', Auth::user()->invLocation->L_id)
        ->get();
        return view('inventory', compact('categories','inventory','Supplier','items','uom','currency')); 
    }
    
    public function __construct()
    {
        $this->middleware('auth');
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
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
    //search
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $inventory = Inventory::where('Item_Name', 'LIKE', "%{$searchTerm}%")->get();

        $output = '';
        foreach ($inventory as $data) {
            $output .= '
            <tr class="bg-zinc-200 text-base border-t-4 border-white">
              <td class="py-3 px-4 border border-white">'.$data->Item_Name.'</td>
              <td class="py-3 px-4 border border-white">'.$data->Category.'</td>
              <td class="py-3 px-4 border border-white">'.$data->Total_StockIn.'</td>
              <td class="py-3 px-4 border border-white">'.$data->Total_In_Hand.'</td>
              <td class="py-3 px-4 border border-white">'.$data->UOM.'</td>
              <td class="py-3 px-4 border border-white">'.$data->Expired_Date.'</td>
            </tr>';
        }

        return response()->json(['html' => $output]);
    }
}
