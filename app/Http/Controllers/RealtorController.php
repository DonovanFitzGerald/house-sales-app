<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RealtorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($request)
    {
        //
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
        //
    }
}