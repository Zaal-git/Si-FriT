<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servers;
use App\Models\User;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user(); // semua user untuk select option
        $users = User::all();


        return view('pengajuan.server.main', compact(
            'servers',
            'totalPengajuan',
            'approved',
            'pending',
            'rejected',
            'user',
            'users'
        ));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'server_id' => 'required|exists:servers,id',
        ]);

        $server = servers::findOrFail($request->server_id);

        // Jika role unit, ambil dari user yang login
        if ($user->role == 'unit') {
            $pengaju = $user->name;
            $lokasiPengajuan = $user->lokasi; // atau 'lokasi_unit', tergantung struktur database Anda
        } else {
            // Kalau admin, pakai input manual dari form
            $request->validate([
                'lokasi_pengajuan' => 'required|max:255',
                'pengaju' => 'required|max:255',
            ]);
            $pengaju = $request->pengaju;
            $lokasiPengajuan = $request->lokasi_pengajuan;
        }

        $server->update([
            'pengaju' => $pengaju,
            'lokasi_pengaju' => $lokasiPengajuan,
            'status' => 2,
        ]);

        return redirect('pengajuan/server')->with('alert', [
            'type' => 'success',
            'message' => 'Server berhasil diajukan'
        ]);
    }


    public function show($id)
    {
        $server = servers::findOrFail($id);
        return response()->json($server);
    }
}
