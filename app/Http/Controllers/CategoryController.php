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
            'cat_name' => 'required|unique:categories,name',
            'cat_description' => 'required',
            'cat_img' => 'required|image',
            'cat_status' => 'required',

        ]);

        $imgname = null;
        if ($request->hasFile('cat_img')) {
            $image = $request->file('cat_img');
            $imgname = $imgname = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/category'), $imgname);
        }
        Category::create([
            'name' => $request->cat_name,
            'description' => $request->cat_description,
            'image' => $imgname,
            'status' => $request->cat_status,
        ]);
        return redirect()->route('category.manage')->with('success', 'Category created successfully');
    }

    /**
     *  edit Category.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update category.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Delete Category
     */
    public function destroy(Category $category)
    {

        if ($category->image) {
            $imagepath = public_path('/uploads/category/' . $category->image);
            if (file_exists($imagepath)) {
                unlink($imagepath);
            }
        }
        $category->delete();
        return redirect()->route('category.manage')->with('success', 'Category deleted successfully');
    }
}
