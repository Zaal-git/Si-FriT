<?php

namespace App\Http\Controllers;

use App\Models\servers;
use App\Models\Infrastruktur;
use App\Models\Aplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'SIFrIT';
        $user = Auth::user();
    
        // Default untuk admin (semua data)
        if ($user->role == 'admin') {
            // Total counts for Admin
            $totalServers = servers::count();
            $totalJaringan = Infrastruktur::count();
    
            $pengajuanMasuk = servers::where('status', 1)->count()
                + Infrastruktur::where('status', 1)->count()
                + Aplikasi::where('status', 1)->count();
    
            $pengajuanDitolak = servers::where('status', 4)->count()
                + Infrastruktur::where('status', 4)->count()
                + Aplikasi::where('status', 4)->count();
    
            $pengajuanDisetujui = servers::where('status', 3)->count()
                + Infrastruktur::where('status', 3)->count()
                + Aplikasi::where('status', 3)->count();
    
            // Raw data for chart
            $rawServer = servers::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')->pluck('total', 'month');
            $rawInfrastruktur = Infrastruktur::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')->pluck('total', 'month');
            $rawAplikasi = Aplikasi::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')->pluck('total', 'month');
    
            // Format data traffic (admin only)
            $filledServerData = array_fill(0, 12, 0);
            $filledInfrastrukturData = array_fill(0, 12, 0);
            $filledAplikasiData = array_fill(0, 12, 0);
    
            foreach ($rawServer as $month => $count) {
                $filledServerData[$month - 1] = $count;
            }
            foreach ($rawInfrastruktur as $month => $count) {
                $filledInfrastrukturData[$month - 1] = $count;
            }
            foreach ($rawAplikasi as $month => $count) {
                $filledAplikasiData[$month - 1] = $count;
            }
    
            $trafficData = [
                'servers' => $filledServerData,
                'infrastruktur' => $filledInfrastrukturData,
                'aplikasi' => $filledAplikasiData,
            ];
    
        } else {
            // For unit role, no chart data
            $totalServers = null;
            $totalJaringan = null;
            $pengajuanMasuk = servers::where('status', 2)->where('pengaju', $user->name)->count()
                + Infrastruktur::where('status', 2)->where('pengaju', $user->name)->count()
                + Aplikasi::where('status', 2)->where('pengaju', $user->name)->count();
    
            $pengajuanDitolak = servers::where('status', 4)->where('pengaju', $user->name)->count()
                + Infrastruktur::where('status', 4)->where('pengaju', $user->name)->count()
                + Aplikasi::where('status', 4)->where('pengaju', $user->name)->count();
    
            $pengajuanDisetujui = servers::where('status', 3)->where('pengaju', $user->name)->count()
                + Infrastruktur::where('status', 3)->where('pengaju', $user->name)->count()
                + Aplikasi::where('status', 3)->where('pengaju', $user->name)->count();
    
            // Set traffic data to null for non-admin
            $trafficData = null;
        }
    
        // Return the view with the appropriate data
        return view('main', compact(
            'title',
            'totalServers',
            'totalJaringan',
            'pengajuanMasuk',
            'pengajuanDitolak',
            'pengajuanDisetujui',
            'trafficData'
        ));
    }
    
}
