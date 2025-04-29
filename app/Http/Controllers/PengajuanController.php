<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servers;
use Illuminate\Validation\Validator;

class PengajuanController extends Controller
{
    public function index()
    {
        $servers = servers::latest()->get();

        $totalPengajuan = $servers->count();
        $pengajuan = $servers->where('status', 1)->count();
        $approved = $servers->where('status', 3)->count(); // Terpakai
        $pending = $servers->where('status', 2)->count();  // Ajukan
        $rejected = $servers->where('status', 4)->count(); // contoh status ditolak


        return view('pengajuan.server.main', compact(
            'servers',
            'totalPengajuan',
            'approved',
            'pending',
            'rejected'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'server_id' => 'required|exists:servers,id',
            'lokasi_pengajuan' => 'required|max:255'
        ]);

        $server = servers::findOrFail($request->server_id);

        $server->update([
            'location' => $request->lokasi_pengajuan,
            'status' => 2
        ]);

        return redirect()->route('pengajuan.server.index')
            ->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function show($id)
    {
        $server = servers::findOrFail($id);
        return response()->json($server);
    }
}
