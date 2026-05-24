<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $brands      = Brand::all();
        $units       = Unit::all();

        return view('admin.products.index', compact(
            'categories',
            'brands',
            'units'
        ));
    }

    /**
     * Get Subcategory by Category ID (AJAX)
     */
    public function getSubcategory($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();

        return response()->json([
            'status' => true,
            'data'   => $subcategories
        ]);
    }

    /**
     * Store Product
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'category_id'     => 'required',
            'subcategory_id'  => 'required',
            'name'            => 'required',
            'product_code'    => 'required',
            'stock'           => 'required',
            'regular_price'   => 'required',
        ]);

        $imageName = null;

        // image upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/products'), $imageName);
        }

        // store product
        Product::create([
            'category_id'       => $request->category_id,
            'subcategory_id'    => $request->subcategory_id,
            'brand_id'          => $request->brand_id,
            'unit_id'           => $request->unit_id,
            'name'              => $request->name,
            'product_code'      => $request->product_code,
            'stock'             => $request->stock,
            'regular_price'     => $request->regular_price,
            'sale_price'        => $request->sale_price,
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'image'             => $imageName,
            'status'            => $request->status,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Product Added Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
