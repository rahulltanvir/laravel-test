<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        'title'       => 'required|max:255',
        'price'       => 'nullable|max:255',
        'description' => 'nullable',
        'button_text' => 'nullable|max:255',
        'button_link' => 'nullable|max:255',
        'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:40960',
        'serial'      => 'required|integer',
        'status'      => 'required|boolean',
    ]);

    $imgname = null;

    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imgname = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        $uploadPath = public_path('uploads/sliders');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $image->move($uploadPath, $imgname);
    }

    Slider::create([
        'title'       => $request->title,
        'price'       => $request->price,
        'description' => $request->description,
        'button_text' => $request->button_text,
        'button_link' => $request->button_link,
        'image'       => $imgname,
        'serial'      => $request->serial,
        'status'      => $request->status,
    ]);

    return redirect()
        ->route('sliders.index')
        ->with('success', 'Slider Added Successfully');
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
            'title'       => 'required|max:255',
            'price'       => 'nullable|max:255',
            'description' => 'nullable',
            'button_text' => 'nullable|max:255',
            'button_link' => 'nullable|max:255',

            // Image optional হবে
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',

            'serial'      => 'required|integer',
            'status'      => 'required|boolean',
        ]);


        $data = [

            'title'       => $request->title,
            'price'       => $request->price,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'serial'      => $request->serial,
            'status'      => $request->status,

        ];


        // Update Image
        if ($request->hasFile('image')) {

            // Old image delete
            if (
                $slider->image &&
                File::exists(public_path('uploads/sliders/' . $slider->image))
            ) {
                File::delete(
                    public_path('uploads/sliders/' . $slider->image)
                );
            }


            // New image
            $image = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();


            // Upload folder
            $uploadPath = public_path('uploads/sliders');

            // Folder না থাকলে তৈরি করবে
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }


            // Upload image
            $image->move($uploadPath, $imageName);


            // Database এ শুধু filename save
            $data['image'] = $imageName;
        }


        $slider->update($data);


        return redirect()
            ->route('sliders.index')
            ->with('success', 'Slider Updated Successfully');
    }


    // Change Status
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
        // Delete image
        if (
            $slider->image &&
            File::exists(public_path('uploads/sliders/' . $slider->image))
        ) {
            File::delete(
                public_path('uploads/sliders/' . $slider->image)
            );
        }

        // Delete slider
        $slider->delete();

        return redirect()
            ->route('sliders.index')
            ->with('success', 'Slider Deleted Successfully');
    }
}