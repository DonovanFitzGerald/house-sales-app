<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RealtorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Trim the search term
        $term = trim($request->string('q'));

        // Define the columns to search
        $columns = [
            'name',
            'email',
        ];

        // Get the paginated houses data
        if ($term !== '') {
            $realtors = User::query()
                // Loop through the columns and search for the term in each column
                ->where('role', 'realtor')
                ->where(function ($q) use ($columns, $term) {
                    foreach ($columns as $col) {
                        $q->orWhere($col, 'like', "%{$term}%");
                    }
                })
                ->latest('created_at')
                ->paginate(12)
                ->withQueryString();
        } else {
            $realtors = User::query()
                ->where('role', 'realtor')
                ->latest('created_at')
                ->paginate(12)
                ->withQueryString();
        }

        // Return the view with the realtors data
        return view('realtors.index', compact('realtors'));
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
    public function show(User $realtor)
    {
        $houses = $realtor->houses;

        return view('realtors.show')->with('realtor', $realtor)->with('houses', $houses);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $realtor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $realtor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $realtor)
    {
                // Delete the house record
        User::where('id', $realtor->id)->delete();

        // Redirect back with a success message
        return back()->with('success', 'House deleted successfully.');
    }
}