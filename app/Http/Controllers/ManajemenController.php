<?php

namespace App\Http\Controllers;

use App\Models\Manajemen;
use Illuminate\Http\Request;

class ManajemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pengajuan()
    {
        return view('manajemen.pengajuan.main', ['title' => 'Manajemen Data Pengajuan']);
    }

    public function user()
    {
        return view('manajemen.user.main', ['title' => 'Manajemen User']);
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
    public function show(Manajemen $manajemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manajemen $manajemen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manajemen $manajemen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manajemen $manajemen)
    {
        //
    }
}
