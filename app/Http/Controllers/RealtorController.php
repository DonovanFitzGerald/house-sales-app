<?php

namespace App\Http\Controllers;

use App\Models\Realtor;
use Illuminate\Http\Request;

class RealtorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($request)
    {
        // Trim the search term
        $term = trim($request->string('q'));

        // Define the columns to search
        $columns = [
            'name',
        ];

        // Get the paginated houses data
        if ($term !== '') {
            $houses = House::query()
                // Loop through the columns and search for the term in each column
                ->where(function ($q) use ($columns, $term) {
                    foreach ($columns as $col) {
                        $q->orWhere($col, 'like', "%{$term}%");
                    }
                })
                ->latest('created_at')
                ->paginate(12)
                ->withQueryString();
        } else {
            $houses = House::query()
                ->latest('created_at')
                ->paginate(12)
                ->withQueryString();
        }

        // Return the view with the houses data
        return view('houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Realtor $realtor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Realtor $realtor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Realtor $realtor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Realtor $realtor)
    {
        //
    }
}
