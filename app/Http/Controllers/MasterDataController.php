<?php

namespace App\Http\Controllers;

use App\Models\MasterData;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function server()
    {
        return view('master-data.server.main', ['title' => 'Master Data - Server']);
    }

    public function infrastruktur()
    {
        return view('master-data.infrastruktur/main', ['title' => 'Master Data - Infrastruktur']);
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
    public function show(MasterData $masterData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterData $masterData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterData $masterData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterData $masterData)
    {
        //
    }
}
