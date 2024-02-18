<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materials;
use App\Models\Category;
use App\Models\Stocks;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('is_delete','N')->get(['id','name']);
        $materials = Materials::with('category')->where('is_delete','N')->get();
        //  return view("material.index",compact("materials","categories"));

         // Fetch opening balance and closing balance from tbl_stocks for each material
        $materialsWithStock = $materials->map(function ($material) {
            $latestStock = Stocks::where('material_id', $material->id)
                            ->where('category_id', $material->category_id)
                            ->orderBy('stock_date', 'desc')
                            ->first();
            $material->opening_balance = $latestStock ? $latestStock->opening_balance : 0;
            $material->closing_balance = $latestStock ? $latestStock->closing_balance : 0;
            return $material;
        });

        return view("material.index", compact("materialsWithStock", "categories"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_delete','N')->get(['id','name']);
        return view('material.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:tbl_materials',
                // Add other validation rules as needed
            ]);
        
            $material = new Materials;
            $material->category_id = $request->category;
            $material->name = $validatedData['name'];
            $material->qty = $request->qty;
            $material->save();
        
            toastr()->success('Material saved successfully.');
            return redirect()->route('material.index');
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                toastr()->error('Material name already exists.');
            } else {
                toastr()->error('Error saving material: ' . $e->getMessage());
            }
            return redirect()->back();
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
        $material = Materials::find($id);
        $categories = Category::where('is_delete','N')->get();
        $materials = Materials::where('is_delete','N')->get();
        return view('material.index')->with(compact(['categories','material','materials']));
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
        $material = Materials::find($id);
        if ($material) {
            $material->name = $request->name;
            $material->qty = $request->qty;
            $material->save();
            toastr()->success('Materials Updated successfully.');
        } else {
            toastr()->error('Materials not found.');
        }
        
        return redirect()->route('material.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Materials::find($id);
        if ($material) {
            $material->is_delete = 'Y';
            $material->deleted_at = now();
            $material->save();
            toastr()->success('Materials Deleted successfully.');
        } else {
            toastr()->error('Materials not found.');
        }
        
        return redirect()->route('material.index');
    }
}
