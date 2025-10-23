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
    public function index(Request $request)
    {
        $term = trim($request->string('q'));

        $columns = [
            'description',
            'address_line_1',
            'address_line_2',
            'city',
            'county',
            'zip',
            'energy_rating',
            'house_type',
        ];

        $houses = House::query()
            ->when($term !== '', function ($q) use ($columns, $term) {
                $q->where(function ($q) use ($columns, $term) {
                    foreach ($columns as $col) {
                        $q->orWhere($col, 'like', "%{$term}%");
                    }
                });
            })
            ->latest('created_at')
            ->paginate(12)
            ->withQueryString(); 

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
            'featured_image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if ($request->hasFile('featured_image')) {
            $featured_imageName = $request->house_type . '_' . time() . '.' . $request->featured_image->extension();
            $request->file('featured_image')->move(public_path('images/houses'), $featured_imageName);
        }

        House::create([
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
            'featured_image' => $featured_imageName,
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
        return view('houses.edit')->with('house', $house);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house)
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
            'featured_image' => 'image|mimes:jpeg,png,jpg|max:4096',
        ]);

         $featured_image_path = $house->featured_image;

        if ($request->hasFile('featured_image')) {
            $featured_image_path = $request->house_type . '_' . time() . '.' . $request->featured_image->extension();
            $request->file('featured_image')->move(public_path('images/houses'), $featured_image_path);
        }

        $house->update([
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
            'featured_image' => $featured_image_path,
        ]);

        return to_route('houses.index')->with('success', 'House edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        House::where('id', $house->id)->delete();

         return to_route('houses.index')->with('success', 'House deleted successfully.');
    }
}