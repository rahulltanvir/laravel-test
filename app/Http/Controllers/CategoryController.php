<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function manage()
    {
         $categories = Category::latest()->get();
        return view('admin.category.manage', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'cat_name'=>'required|unique:categories,name',
            'cat_description'=>'required',
            'cat_img'=>'required|image',
            'cat_status'=>'required',
            
            ]);

            $imgname=null;
            if($request->hasFile('cat_img')){
                $image=$request->file('cat_img');
                $imgname=time(). '.' .$image->getClientOriginalExtension();
                $image->move(public_path('uploads/category'), $imgname);
            }
            Category::create([
                'name'=>$request->cat_name,
                'description'=>$request->cat_description,
                'image'=> $imgname,
                'status'=>$request->cat_status,
            ]);
            return redirect()->route('category.manage')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
