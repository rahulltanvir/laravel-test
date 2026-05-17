<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.subcategory.index', compact('categories'));
    }

 public function manage()
    {
        $subcategories = Subcategory::with('category')->latest()->get();
        return view('admin.subcategory.manage', compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'category_id'         => 'required',
        'sub_cat_name'        => 'required',
        'sub_cat_description' => 'required',
        'sub_cat_img'         => 'required|image',
        'sub_cat_status'      => 'required'
    ]);

    $imgname = null;

    if ($request->hasFile('sub_cat_img')) {

        $image = $request->file('sub_cat_img');

        $imgname = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads/subcategory'), $imgname);
    }

    Subcategory::create([
        'category_id' => $request->category_id,
        'name'        => $request->sub_cat_name,
        'description' => $request->sub_cat_description,
        'image'       => $imgname,
        'status'      => $request->sub_cat_status
    ]);

    return redirect()
        ->route('subcategory.manage')
        ->with('success', 'Sub Category created successfully');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        $subcategories=Subcategory::findOrFail($subcategory)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        //
    }
}
