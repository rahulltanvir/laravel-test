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
        'sub_cat_name'        => 'required|unique:sub_categories,name',
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
        ->back()
        ->with('success', 'Sub Category created successfully');
}


    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $subcategory = Subcategory::with('category')->findOrFail($id);
    $categories = Category::all();

    return view('admin.subcategory.edit', compact('subcategory', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
   
    $request->validate([
        'up_category_id'        => 'required',
        'up_subcat_name'        => 'required|unique:sub_categories,name,' . $id,
        'up_subcat_description' => 'required',
        'up_subcat_img'         => 'nullable|image',
        'up_subcat_status'      =>'required'
    ]);
    
   $subcategory=Subcategory::findOrFail($id);
   $imgname=$subcategory->image;
   if($request->hasFile('up_subcat_img')){
    
    $oldImage = public_path('uploads/subcategory/' . $subcategory->image);
    if(file_exists( $oldImage)){
        unlink( $oldImage);
    }
    $image=$request->file('up_subcat_img');
    $imgname=time(). '_' . uniqid() . '.'. $image->getClientOriginalExtension();
    $image->move(public_path('uploads/subcategory/'),$imgname );
   }
   $subcategory->update([
    'category_id'=>$request->up_category_id,
    'name'=>$request->up_subcat_name,
    'description'=>$request->up_subcat_description,
    'image'=>$imgname,
    'status'=>$request->up_subcat_status
   ]);
   return redirect()->route('subcategory.manage')->with('success', 'Sub Category Updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $subcategory=Subcategory::findOrFail($id);
    if ($subcategory->image) {

        $imgpath = public_path('uploads/subcategory/' . $subcategory->image);

        if (file_exists($imgpath)) {
            unlink($imgpath);
        }
    }

    $subcategory->delete();

    return redirect()
        ->route('subcategory.manage')
        ->with('success', 'Sub Category Deleted Successfully');
}
}
