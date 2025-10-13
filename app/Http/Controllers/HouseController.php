<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houses = House::all();
        return view('houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('houses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'description' => 'required|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string',
            'county' => 'required|string',
            'zip' => 'required|string',
            'beds' => 'required|integer',
            'baths' => 'required|integer',
            'square_metres' => 'required|integer',
            'energy_rating' => 'required|string',
            'house_type' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = $request->house_type . '_' . time() . '.' . $request->image->extension();
            $request->file('image')->move(public_path('images/houses'), $imageName);
        }

        House::create([
            'title' => $request->title,
            'description' => $request->description,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'county' => $request->county,
            'zip' => $request->zip,
            'beds' => $request->beds,
            'baths' => $request->baths,
            'square_metres' => $request->square_metres,
            'energy_rating' => $request->energy_rating,
            'house_type' => $request->house_type,
            'image' => $imageName,
        ]);

        return to_route('houses.index')->with('success', 'House created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        return view('houses.show')->with('house', $house);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        //
    }
}