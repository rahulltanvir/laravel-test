<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.units.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_name'        => 'required',
            'unit_code'        => 'required|unique:units,code',
            'unit_description' => 'required',
            'unit_status'      => 'required',
        ]);

        Unit::create([
            'name'        => $request->unit_name,
            'code'        => $request->unit_code,
            'description' => $request->unit_description,
            'status'      => $request->unit_status,
        ]);

        return redirect()->back()->with('success', 'Unit created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function manage(Unit $unit)
    {
        $units = Unit::all();
        return view('admin.units.manage', compact('units'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $units = Unit::findOrFail($id);
        return view('admin.units.edit', compact('units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'up_unit_name'        => 'required',
        'up_unit_code'        => 'required|unique:units,code,' . $id,
        'up_unit_description' => 'required',
        'up_unit_status'      => 'required',
    ]);

    $units = Unit::findOrFail($id);

    $units->update([
        'name'        => $request->up_unit_name,
        'code'        => $request->up_unit_code,
        'description' => $request->up_unit_description,
        'status'      => $request->up_unit_status,
    ]);

    return redirect()->route('unit.manage')->with('success', 'Unit updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
