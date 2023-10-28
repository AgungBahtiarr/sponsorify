<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HandleUnLogin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Silahkan Login Terlebih Dahulu'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->json([
            'message' => 'Silahkan Login Terlebih Dahulu'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return response()->json([
            'message' => 'Silahkan Login Terlebih Dahulu'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return response()->json([
            'message' => 'Silahkan Login Terlebih Dahulu'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return response()->json([
            'message' => 'Silahkan Login Terlebih Dahulu'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return response()->json([
            'message' => 'Silahkan Login Terlebih Dahulu'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return response()->json([
            'message' => 'Silahkan Login Terlebih Dahulu'
        ]);
    }
}
