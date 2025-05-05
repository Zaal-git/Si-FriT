<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use Illuminate\Http\Request;

class AplikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); // ambil user yang login
        return view('pengajuan.aplikasi.main', compact('user'));
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
        // Validate the incoming request data
        $validated = $request->validate([
            'nama_aplikasi' => 'required|string|max:255',
            'jenis_aplikasi' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'pengaju' => 'required|string|max:255',
            'alasan_pengajuan' => 'nullable|string',
            'lokasi_penempatan' => 'nullable|string|max:255',
            'tanggal_pengajuan' => 'required|date',
        ]);

        // Create a new aplikasi record
        Aplikasi::create([
            'nama_aplikasi' => $validated['nama_aplikasi'],
            'jenis_aplikasi' => $validated['jenis_aplikasi'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'pengaju' => $validated['pengaju'],
            'alasan_pengajuan' => $validated['alasan_pengajuan'] ?? null,
            'lokasi_penempatan' => $validated['lokasi_penempatan'] ?? null,
            'status' => 2, // Default status is 'Menunggu'
            'tanggal_pengajuan' => $validated['tanggal_pengajuan'],
        ]);


        // Untuk request AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Aplikasi berhasil diajukan'
            ]);
        }

        // Untuk request biasa
        return redirect('pengajuan/aplikasi')->with('alert', [
            'type' => 'success',
            'message' => 'Aplikasi berhasil diajukan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aplikasi $aplikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aplikasi $aplikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aplikasi $aplikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aplikasi $aplikasi)
    {
        //
    }
}
