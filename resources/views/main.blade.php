@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

@if (Auth::user()->role == 'admin')
<div class="container-fluid">
    <div class="row">
        {{-- Total Server --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-secondary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $totalServers }}</h4>
                        <p class="mb-0">Total Server Terdaftar</p>
                    </div>
                    <i class="ti ti-box fs-1"></i>
                </div>
            </div>
        </div>

        {{-- Total Jaringan --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $totalJaringan }}</h4>
                        <p class="mb-0">Total Jaringan Terdaftar</p>
                    </div>
                    <i class="ti ti-tags fs-1"></i>
                </div>
            </div>
        </div>

        {{-- Pengajuan Masuk --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $pengajuanMasuk }}</h4>
                        <p class="mb-0">Total Pengajuan Masuk</p>
                    </div>
                    <i class="ti ti-refresh fs-1"></i>
                </div>
            </div>
        </div>

        {{-- Pengajuan Disetujui --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $pengajuanDisetujui }}</h4>
                        <p class="mb-0">Pengajuan Disetujui</p>
                    </div>
                    <i class="ti ti-box fs-1"></i>
                </div>
            </div>
        </div>

        
        {{-- Pengajuan Ditolak --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-danger">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $pengajuanDitolak }}</h4>
                        <p class="mb-0">Pengajuan Yang Ditolak</p>
                    </div>
                    <i class="ti ti-box fs-1"></i>
                </div>
            </div>
        </div>

        {{-- Traffic Overview --}}
        <div class="col-lg-12 mt-4">
            <div class="card shadow-sm p-4 rounded-3">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                        Traffic Overview
                        <span>
                            <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success"
                                data-bs-title="Traffic Overview"></iconify-icon>
                        </span>
                    </h5>
                    <canvas id="traffic-overview" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="py-6 px-6 text-center mt-4">
        <p class="mb-0 fs-4">Design and Developed by Distributed by UPA TIK TEAM</p>
    </div>
</div>
@else
<div class="container-fluid">
    <div class="row">
        {{-- Selamat Datang --}}
        <div class="col-12 mb-3">
            <h4 class="mb-0">Selamat datang, {{ Auth::user()->name }} 👋</h4>
            <p class="text-muted">Lokasi Unit: {{ Auth::user()->lokasi }}</p>
        </div>


        {{-- Pengajuan Masuk --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $pengajuanMasuk }}</h4>
                        <p class="mb-0">Pengajuan Masuk</p>
                    </div>
                    <i class="ti ti-send fs-1"></i>
                </div>
            </div>
        </div>

        {{-- Pengajuan Disetujui --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $pengajuanDisetujui }}</h4>
                        <p class="mb-0">Pengajuan Disetujui</p>
                    </div>
                    <i class="ti ti-check fs-1"></i>
                </div>
            </div>
        </div>

        {{-- Pengajuan Ditolak --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 p-3 text-white bg-danger">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $pengajuanDitolak }}</h4>
                        <p class="mb-0">Pengajuan Ditolak</p>
                    </div>
                    <i class="ti ti-x fs-1"></i>
                </div>
            </div>
        </div>
    </div>


    {{-- Footer --}}
    <div class="py-6 px-6 text-center mt-4">
        <p class="mb-0 fs-4">Design and Developed by Distributed by UPA TIK TEAM</p>
    </div>
</div>

@endif




@include('layouts.footer')
@if (Auth::user()->role == 'admin')
<script>
    const ctx = document.getElementById('traffic-overview')?.getContext('2d');

    if (ctx) {
        const trafficChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [
                    {
                        label: 'Server',
                        data: @json($trafficData['servers']),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Infrastruktur',
                        data: @json($trafficData['infrastruktur']),
                        borderColor: 'rgba(255, 159, 64, 1)',
                        backgroundColor: 'rgba(255, 159, 64, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Aplikasi',
                        data: @json($trafficData['aplikasi']),
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            }
        });
    }
</script>
@endif

