<?php

namespace App\Http\Controllers;

use App\Models\Manajemen;
use Illuminate\Http\Request;

class ManajemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $tipe = $request->input('tipe', 'semua'); // Default tampilkan semua
    
    $aplikasi = [];
    $servers = [];
    $infrastruktur = [];

    // Filter berdasarkan tipe
    if ($tipe === 'semua' || $tipe === 'Aplikasi') {
        $aplikasi = \App\Models\Aplikasi::query()
            ->when($tipe === 'Aplikasi', function($query) {
                return $query->where('status', 2);
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'tipe' => 'Aplikasi',
                    'nama' => $item->nama_aplikasi,
                    'deskripsi' => $item->deskripsi,
                    'pengaju' => $item->pengaju,
                    'lokasi' => $item->lokasi_penempatan,
                    'status' => $item->status,
                    'tanggal' => $item->tanggal_pengajuan ?? $item->created_at,
                ];
            })->toArray();
    }

    if ($tipe === 'semua' || $tipe === 'Server') {
        $servers = \App\Models\servers::query()
            ->when($tipe === 'Server', function($query) {
                return $query->where('status', 2);
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'tipe' => 'Server',
                    'nama' => $item->name,
                    'deskripsi' => 'IP: ' . $item->ip_address . ', Memori: ' . $item->memory_gb . 'GB',
                    'pengaju' => $item->pengaju,
                    'lokasi' => $item->lokasi_pengaju,
                    'status' => $item->status,
                    'tanggal' => $item->created_at,
                ];
            })->toArray();
    }

    if ($tipe === 'semua' || $tipe === 'Infrastruktur') {
        $infrastruktur = \App\Models\Infrastruktur::query()
            ->when($tipe === 'Infrastruktur', function($query) {
                return $query->where('status', 2);
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'tipe' => 'Infrastruktur',
                    'nama' => $item->name,
                    'deskripsi' => 'Tipe: ' . $item->type . ', IP: ' . $item->ip_address,
                    'pengaju' => $item->pengaju ?? '-',
                    'lokasi' => $item->location,
                    'status' => $item->status,
                    'tanggal' => $item->created_at,
                ];
            })->toArray();
    }

    // Gabungkan semua data
    $pengajuanGabungan = array_merge($aplikasi, $servers, $infrastruktur);

    // Filter hanya yang status == 2 jika memilih semua
    if ($tipe === 'semua') {
        $pengajuanGabungan = array_filter($pengajuanGabungan, function ($item) {
            return $item['status'] == 2;
        });
    }

    // Urutkan berdasarkan tanggal menurun
    usort($pengajuanGabungan, function ($a, $b) {
        return strtotime($b['tanggal']) <=> strtotime($a['tanggal']);
    });

    return view('manajemen.pengajuan.main', [
        'dataPengajuan' => collect($pengajuanGabungan),
        'title' => 'Manajemen - Data Pengajuan',
        'tipeTerpilih' => $tipe
    ]);
}



    /**
     * Show the form for creating a new resource.
     */
    public function updateStatus(Request $request)
    {
        dd($request->all());

        $request->validate([
            'id' => 'required|integer',
            'tipe' => 'required|string|in:Aplikasi,Server,Infrastruktur',
            'status' => 'required|integer|in:3,4', // 3 = ACC, 4 = Tolak
        ]);

        switch ($request->tipe) {
            case 'Aplikasi':
                $data = \App\Models\Aplikasi::findOrFail($request->id);
                break;
            case 'Server':
                $data = \App\Models\servers::findOrFail($request->id); // sesuai nama model
                break;
            case 'Infrastruktur':
                $data = \App\Models\Infrastruktur::findOrFail($request->id);
                break;
            default:
                return redirect()->back()->withErrors('Tipe pengajuan tidak valid.');
        }

        $data->status = $request->status;
        $data->save();

        // Untuk request AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengajuan di ACC'
            ]);
        }

        // Untuk request biasa
        return redirect('manajemen/pengajuan')->with('alert', [
            'type' => 'success',
            'message' => 'Pengajuan di ACC'
        ]);
    }


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
    public function update(Request $request, $id) {}






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manajemen $manajemen)
    {
        //
    }
}
