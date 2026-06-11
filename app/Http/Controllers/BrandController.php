<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.brands.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'brand_name'        => 'required|unique:brands,name',
        'brand_description' => 'required',
        'brand_img'         => 'required|image',
        'brand_status'      => 'required'
    ]);

    $imageName=null;

    if($request->hasFile('brand_img')){
        $image=$request->file('brand_img');
        $imageName=time(). '_' . uniqid(). '.' .$image->getClientOriginalExtension();
        $image->move(public_path('uploads/brands'),$imageName);
    }
    Brand::create([
        'name'        => $request->brand_name,
        'description' => $request->brand_description,
        'image'       => $imageName,
        'status'      => $request->brand_status
    ]);
    return redirect()->back()->with('success', 'Brand created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function manage()
    {
        $brands= Brand::all();
        return view('admin.brands.manage', compact('brands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brands=Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'up_brand_name'        => 'required|unique:brands,name,' . $id,
        'up_brand_description' => 'required',
        'up_brand_img'         => 'nullable|image',
        'up_brand_status'      =>'required'
        ]);
        $brands=Brand::findOrFail($id);
        $imagename=$brands->image;
        if($request->hasFile('up_brand_img')){
            $oldImg=public_path('upload/brands/'.$brands->image);
            if(file_exists($oldImg)){
                unlink($oldImg);
            }
            $image=$request->file('up_brand_img');
            $imageName=time(). '_' .uniqid() . '.' .$image->getClientOriginalExtension();
            $image->move(public_path('uploads/brands/'),$imageName);
        }
        $brands->update([
            
            'name'=>$request->up_brand_name,
            'description'=>$request->up_brand_description,
            'image'=>$imagename,
            'status'=>$request->up_brand_status
        ]);
        return redirect()->route('brand.manage')->with('success', 'Brand Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brands=Brand::findOrFail($id);
        if($brands->image){
            $imagepath=public_path('uploads/brands/'.$brands->image);
            if(file_exists($imagepath)){
                unlink($imagepath);
            }
        }
        $brands->delete();
        return redirect()->back()->with('success', 'Brand Delete successfully');
    }
}
