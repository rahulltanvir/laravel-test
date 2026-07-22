<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    // Slider List
    public function index()
    {
        $sliders = Slider::latest()->get();

        return view('admin.slider.manage-slider', compact('sliders'));
    }


    // Add Slider Page
    public function create()
    {
        return view('admin.slider.index');
    }


    // Store Slider
    public function store(Request $request)
    {
         $request->validate([
            'title'        => 'required|max:255',
            'price'        => 'nullable|max:255',
            'description'  => 'nullable',
            'button_text'  => 'nullable|max:255',
            'button_link'  => 'nullable|max:255',
            'image'        => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'serial'       => 'required|integer',
            'status'       => 'required|boolean',
        ]);


        // Image Upload
        $imageName = null;

        if($request->hasFile('image')){

            $image = $request->file('image');

            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/sliders'),
                $imageName
            );
        }


        // Save Data
        Slider::create([

            'title'        => $request->title,
            'price'        => $request->price,
            'description'  => $request->description,
            'button_text'  => $request->button_text,
            'button_link'  => $request->button_link,
            'image'        => 'uploads/sliders/' . $imageName,
            'serial'       => $request->serial,
            'status'       => $request->status,

        ]);


        return redirect()
            ->route('sliders.index')
            ->with('success','Slider Added Successfully');
    }



    // Edit Slider Page
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }



    // Update Slider
    public function update(Request $request, Slider $slider)
    {

        $request->validate([
            'title'        => 'required|max:255',
            'price'    => 'nullable|max:255',
            'description'  => 'nullable',
            'button_text'  => 'nullable|max:255',
            'button_link'  => 'nullable|max:255',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'serial'       => 'required|integer',
            'status'       => 'required',
        ]);



        $data = [

            'title'        => $request->title,
            'price'    => $request->sub_title,
            'description'  => $request->description,
            'button_text'  => $request->button_text,
            'button_link'  => $request->button_link,
            'serial'       => $request->serial,
            'status'       => $request->status,

        ];



        // Update Image
        if($request->hasFile('image')){


            $image = $request->file('image');

            $imageName = time().'.'.$image->getClientOriginalExtension();


            $image->move(
                public_path('uploads/sliders'),
                $imageName
            );


            $data['image'] = 'uploads/sliders/'.$imageName;

        }



        $slider->update($data);



        return redirect()
            ->route('sliders.index')
            ->with('success','Slider Updated Successfully');

    }


 public function changeStatus($id)
    {
        $slider = Slider::findOrFail($id);

        $slider->status = $slider->status == 1 ? 0 : 1;

        $slider->save();

        return redirect()
            ->route('sliders.index')
            ->with('success', 'Slider status updated successfully.');
    }

    // Delete Slider
    public function destroy(Slider $slider)
    {

        $slider->delete();


        return redirect()
            ->route('sliders.index')
            ->with('success','Slider Deleted Successfully');

    }

}