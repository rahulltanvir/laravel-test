<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();

        return view('admin.slider.index', compact('sliders'));
    }


    public function create()
    {
        return view('admin.slider.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Slider $slider)
    {
        //
    }


    public function edit(Slider $slider)
    {
        //
    }


    public function update(Request $request, Slider $slider)
    {
        //
    }


    public function destroy(Slider $slider)
    {
        //
    }
}