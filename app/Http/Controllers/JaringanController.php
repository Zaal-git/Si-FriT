<?php

namespace App\Http\Controllers;

use App\Models\Infrastruktur;
use Illuminate\Http\Request;

class JaringanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infrastrukturs = Infrastruktur::all();
        return view('pengajuan.jaringan.main', compact('infrastrukturs'));
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
        $request->validate([
            'infrastruktur_id' => 'required|exists:infrastrukturs,id',
            'lokasi_pengajuan' => 'required|string|max:255',
        ]);

        // Temukan infrastruktur yang diajukan
        $infrastruktur = Infrastruktur::findOrFail($request->infrastruktur_id);

        // Update data pengajuan
        $infrastruktur->update([
            'lokasi_pengajuan' => $request->lokasi_pengajuan,
            'status' => '2', // Update status menjadi 2 (sedang diajukan)
        ]);

        return redirect()->route('pengajuan.jaringan.index')
            ->with('success', 'Pengajuan berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Infrastruktur $infrastruktur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Infrastruktur $infrastruktur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Infrastruktur $infrastruktur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infrastruktur $infrastruktur)
    {
        //
    }
}
