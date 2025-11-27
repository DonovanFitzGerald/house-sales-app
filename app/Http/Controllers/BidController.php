<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\House;
use Illuminate\Http\Request;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(House $house)
    {
        return view('bids.create')->with('house', $house);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);

        $validated = $request->validate([
            'value' => 'required|integer|min:1',
        ]);

        $bid = Bid::create([
            'value' => $validated['value'],
            'user_id' => auth()->user()->id,
            'house_id' => $validated['house']->id,
        ]);

        return redirect()
            ->route('houses.show', $bid->house_id)
            ->with('success', 'Your bid was placed successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bid $bid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bid $bid)
    {
        return view('bids.edit')->with('bid', $bid);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bid $bid)
    {
        // Validate the input data
        $validated = $request->validate([
            'value' => 'required|integer',
        ]);

        // Update the bid record
        $bid->update($validated);

        $house = $bid->house;

        // Redirect back with a success message
        return to_route('houses.show', $house)->with('success', 'Bid edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bid $bid)
    {
        Bid::where('id', $bid->id)->delete();

        // Redirect back with a success message
        return back()->with('success', 'Bid deleted successfully.');
    }
}
