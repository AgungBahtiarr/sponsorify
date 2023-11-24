<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProposalRequest;
use App\Http\Requests\UpdateProposalRequest;
use App\Models\Proposal;

class ProposalController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProposalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Proposal $proposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proposal $proposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProposalRequest $request, Proposal $proposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposal $proposal)
    {
        //
    }
}
