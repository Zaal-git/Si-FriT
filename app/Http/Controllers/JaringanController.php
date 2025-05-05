<?php

namespace App\Http\Controllers;

use App\Models\Infrastruktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class JaringanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infrastrukturs = Infrastruktur::all();
        $unitUsers = []; // Inisialisasi variabel
        
        if (auth()->user()->role === 'admin') {
            $unitUsers = \App\Models\User::where('role', 'unit')->get();
        }

        return view('pengajuan.jaringan.main', compact('infrastrukturs', 'unitUsers'));
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
         ]);
     
         $user = Auth::user();
         $infrastruktur = Infrastruktur::findOrFail($request->infrastruktur_id);
         
         // Data yang akan diupdate
         $updateData = [
             'status' => '2',
             'lokasi_pengajuan' => $user->role === 'unit' ? $user->lokasi : $request->lokasi_pengajuan,
         ];
     
         // Hanya set pengaju jika role adalah unit
         if ($user->role === 'unit') {
             $updateData['pengaju'] = $user->name;
         }
     
         $infrastruktur->update($updateData);
     
         if ($request->ajax()) {
             return response()->json([
                 'success' => true,
                 'message' => 'Infrastruktur berhasil diajukan'
             ]);
         }
     
         return redirect('pengajuan/jaringan')->with('alert', [
             'type' => 'success',
             'message' => 'Infrastruktur berhasil diajukan'
         ]);
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
