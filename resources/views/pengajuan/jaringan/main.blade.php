@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div class="container-fluid">
    <h4 class="mb-4">Pengajuan - Jaringan</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        {{-- Router --}}
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>
                        <iconify-icon icon="mdi:router-network" class="me-1"></iconify-icon> Router
                    </strong>
                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapse-router">Lihat Daftar</button>
                </div>
                <div class="collapse" id="collapse-router">
                    <ul class="list-group list-group-flush">
                        @foreach($infrastrukturs->where('type', 'Router') as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->name }}</strong> <br>
                                    <small class="text-muted">{{ $item->ip_address }} - {{ $item->location }}</small>
                                    @if($item->status == '2')
                                        <div class="mt-1">
                                            <small class="text-info">Diajukan untuk: {{ $item->lokasi_pengajuan }}</small>
                                        </div>
                                    @endif
                                </div>
                                @if($item->status == '2')
                                    <span class="badge bg-warning">Telah Diajukan</span>
                                @else
                                    <button 
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#ajukanModal"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}"
                                        data-type="{{ $item->type }}"
                                    >Ajukan</button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Switch --}}
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>
                        <iconify-icon icon="material-symbols:settings-ethernet" class="me-1"></iconify-icon> Switch
                    </strong>
                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapse-switch">Lihat Daftar</button>
                </div>
                <div class="collapse" id="collapse-switch">
                    <ul class="list-group list-group-flush">
                        @foreach($infrastrukturs->where('type', 'Switch') as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->name }}</strong> <br>
                                    <small class="text-muted">{{ $item->ip_address }} - {{ $item->location }}</small>
                                    @if($item->status == '2')
                                        <div class="mt-1">
                                            <small class="text-info">Diajukan untuk: {{ $item->lokasi_pengajuan }}</small>
                                        </div>
                                    @endif
                                </div>
                                @if($item->status == '2')
                                    <span class="badge bg-warning">Telah Diajukan</span>
                                @else
                                    <button 
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#ajukanModal"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}"
                                        data-type="{{ $item->type }}"
                                    >Ajukan</button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Firewall --}}
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>
                        <iconify-icon icon="mdi:firewall" class="me-1"></iconify-icon> Firewall
                    </strong>
                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapse-firewall">Lihat Daftar</button>
                </div>
                <div class="collapse" id="collapse-firewall">
                    <ul class="list-group list-group-flush">
                        @foreach($infrastrukturs->where('type', 'Firewall') as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->name }}</strong> <br>
                                    <small class="text-muted">{{ $item->ip_address }} - {{ $item->location }}</small>
                                    @if($item->status == '2')
                                        <div class="mt-1">
                                            <small class="text-info">Diajukan untuk: {{ $item->lokasi_pengajuan }}</small>
                                        </div>
                                    @endif
                                </div>
                                @if($item->status == '2')
                                    <span class="badge bg-warning">Telah Diajukan</span>
                                @else
                                    <button 
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#ajukanModal"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}"
                                        data-type="{{ $item->type }}"
                                    >Ajukan</button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Access Point --}}
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>
                        <iconify-icon icon="mdi:access-point" class="me-1"></iconify-icon> Access Point
                    </strong>
                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapse-ap">Lihat Daftar</button>
                </div>
                <div class="collapse" id="collapse-ap">
                    <ul class="list-group list-group-flush">
                        @foreach($infrastrukturs->where('type', 'Access-Point') as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->name }}</strong> <br>
                                    <small class="text-muted">{{ $item->ip_address }} - {{ $item->location }}</small>
                                    @if($item->status == '2')
                                        <div class="mt-1">
                                            <small class="text-info">Diajukan untuk: {{ $item->lokasi_pengajuan }}</small>
                                        </div>
                                    @endif
                                </div>
                                @if($item->status == '2')
                                    <span class="badge bg-warning">Telah Diajukan</span>
                                @else
                                    <button 
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#ajukanModal"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}"
                                        data-type="{{ $item->type }}"
                                    >Ajukan</button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- LAN --}}
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>
                        <iconify-icon icon="ph:lan-fill" class="me-1"></iconify-icon> LAN
                    </strong>
                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapse-lan">Lihat Daftar</button>
                </div>
                <div class="collapse" id="collapse-lan">
                    <ul class="list-group list-group-flush">
                        @foreach($infrastrukturs->where('type', 'LAN') as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->name }}</strong> <br>
                                    <small class="text-muted">{{ $item->ip_address }} - {{ $item->location }}</small>
                                    @if($item->status == '2')
                                        <div class="mt-1">
                                            <small class="text-info">Diajukan untuk: {{ $item->lokasi_pengajuan }}</small>
                                        </div>
                                    @endif
                                </div>
                                @if($item->status == '2')
                                    <span class="badge bg-warning">Telah Diajukan</span>
                                @else
                                    <button 
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#ajukanModal"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}"
                                        data-type="{{ $item->type }}"
                                    >Ajukan</button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Ajukan --}}
<div class="modal fade" id="ajukanModal" tabindex="-1" aria-labelledby="ajukanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('pengajuan.jaringan.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Pengajuan Infrastruktur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="infrastruktur_id" id="modal-infrastruktur-id">
                    <div class="mb-3">
                        <label>Nama Barang</label>
                        <input type="text" id="modal-name" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Tipe</label>
                        <input type="text" id="modal-type" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Lokasi Pemasangan / Peminjaman</label>
                        <input type="text" name="lokasi_pengajuan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ajukan</button>
                </div>
            </div>
        </form>
    </div>
</div>



{{-- <style>
    .badge {
        padding: 0.5em 0.75em;
        font-size: 0.8em;
        font-weight: 600;
    }
</style> --}}

@include('layouts.footer')