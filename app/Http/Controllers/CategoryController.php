<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.index');
    }
public function subcategory($id)
{
    $subcategory = SubCategory::findOrFail($id);

    return view('website.category.index', compact('subcategory'));
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
        return redirect()->back()->with('success', 'Category created successfully');
    }

    /**
     *  edit Category.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update category.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'up_cat_name' => 'required|unique:categories,name,' . $id,
            'up_cat_description' => 'required',
            'up_cat_img' => 'nullable|image',
            'up_cat_status' => 'required'
        ]);

        $category = Category::findOrFail($id);

        $imgName = $category->image;

        if ($request->hasFile('up_cat_img')) {
            $oldimgpath = public_path('uploads/category/' . $category->image);
            if (file_exists($oldimgpath)) {
                unlink($oldimgpath);
            }
            $image = $request->file('up_cat_img');
            $imgName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/category'), $imgName);
        }
        $category->update([
            'name' => $request->up_cat_name,
            'description' => $request->up_cat_description,
            'image' => $imgName,
            'status' => $request->up_cat_status
        ]);
        return redirect()->route('category.manage')->with('success', 'Category updated successfully');
    }

    /**
     * Delete Category
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
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
