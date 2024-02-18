<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * https://github.com/yoeunes/toastr
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('is_delete','N')->get();
        return view('category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // store
        $item = new Category;
        $item->name = $request->category;
        $item->save();
        toastr()->success('Created Category');
        return redirect()->route('category.index');
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
        $category = Category::find($id);
        $categories = Category::where('is_delete','N')->get();
        return view('category.index')->with(compact(['categories','category']));
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
        $category = Category::find($id);
        if ($category) {
            $category->name = $request->category;
            $category->save();
            toastr()->success('Category Updated successfully.');
        } else {
            toastr()->error('Category not found.');
        }
        
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->is_delete = 'Y';
            $category->delete_at = now();
            $category->save();
            toastr()->success('Category deleted successfully.');
        } else {
            toastr()->error('Category not found.');
        }
        
        return redirect()->route('category.index');
    }
}
