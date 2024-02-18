<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materials;
use App\Models\Category;
use App\Models\Stocks;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('is_delete','N')->get();
        $materials = Materials::with('category')->where('is_delete','N')->get();
        $stocks = Stocks::with('category')->with('material')->get();
        return view("stocks.index", compact('stocks','categories','materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_delete','N')->get();
        $materials = Materials::with('category')->where('is_delete','N')->get();
        
        return view('stocks.create', [
            'categories' => $categories,
            'materials' => $materials
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $material=Materials::find($request->material);
        $opening_bal = $material->qty;


        $stocks =new Stocks;
        $stocks->category_id = $request->category;
        $stocks->material_id = $request->material;
        $stocks->stock_qty = $request->qty;
        $stocks->stock_date = $request->stock_date;
        $stocks->opening_balance = $opening_bal;
        $stocks->closing_balance = $stocks->stock_qty + $stocks->opening_balance;
        
        if($stocks->save())
        {
            $material->qty=$stocks->closing_balance;
            $material->update();
            toastr()->success('Stock Updated successfully.');
            return redirect()->route('stocks.index');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
