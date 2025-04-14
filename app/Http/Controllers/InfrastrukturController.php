<?php

namespace App\Http\Controllers;

use App\Models\Infrastruktur;
use Illuminate\Http\Request;



class InfrastrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infrastruktur = Infrastruktur::all();
        return view('master-data.infrastruktur.main', [
            'title' => 'Master Data - Infrastruktur',
            'infrastruktur' => $infrastruktur
        ]);
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
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'ip_address' => 'nullable|ip', // <-- Tambahkan ini
            'location' => 'required|string',
            'status' => 'required|boolean',
        ]);


        Infrastruktur::create([
            'name' => $request->name,
            'type' => $request->type,
            'ip_address' => $request->ip_address,
            'location' => $request->location,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Infrastructure created successfully.');
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
        return response()->json($infrastruktur);
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
        try {
            $infrastruktur->delete();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }
}
