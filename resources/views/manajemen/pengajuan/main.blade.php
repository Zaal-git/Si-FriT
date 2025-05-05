@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter: {{ $tipeTerpilih === 'semua' ? 'Semua Pengajuan' : $tipeTerpilih }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item {{ $tipeTerpilih === 'semua' ? 'active' : '' }}" href="?tipe=semua">Semua Pengajuan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item {{ $tipeTerpilih === 'Aplikasi' ? 'active' : '' }}" href="?tipe=Aplikasi">Aplikasi</a></li>
                            <li><a class="dropdown-item {{ $tipeTerpilih === 'Server' ? 'active' : '' }}" href="?tipe=Server">Server</a></li>
                            <li><a class="dropdown-item {{ $tipeTerpilih === 'Infrastruktur' ? 'active' : '' }}" href="?tipe=Infrastruktur">Infrastruktur</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tipe</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Pengaju</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataPengajuan as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item['tipe'] }}</td>
                                        <td>
                                            @if($item['tipe'] === 'Aplikasi')
                                                <i class="fas fa-laptop-code text-primary"></i>
                                            @elseif($item['tipe'] === 'Server')
                                                <i class="fas fa-server text-success"></i>
                                            @elseif($item['tipe'] === 'Infrastruktur')
                                                <i class="fas fa-network-wired text-warning"></i>
                                            @endif
                                            {{ $item['nama'] }}
                                        </td>
                                        <td>{{ $item['deskripsi'] }}</td>
                                        <td>{{ $item['pengaju'] }}</td>
                                        <td>{{ $item['lokasi'] }}</td>
                                        <td>{{ $item['tanggal'] ? \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') : '-' }}</td>
                                        <td>
                                            @php
                                                $status = $item['status'];
                                                $statusText = '-';
                                                $statusClass = 'secondary';
                        
                                                if ($status == 2) {
                                                    $statusText = 'Menunggu';
                                                    $statusClass = 'warning';
                                                } elseif ($status == 3) {
                                                    $statusText = 'Disetujui';
                                                    $statusClass = 'success';
                                                } elseif ($status == 4 || $status == 1) {
                                                    $statusText = 'Ditolak';
                                                    $statusClass = 'danger';
                                                }
                                            @endphp
                                            <span class="btn btn-sm btn-{{ $statusClass }}">{{ $statusText }}</span>
                                        </td>
                                        <td>
                                            @if($status == 2)
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                    data-id="{{ $item['id'] }}"
                                                    data-nama="{{ $item['nama'] }}"
                                                    data-tipe="{{ $item['tipe'] }}"
                                                    data-status="3"
                                                    data-action-text="menyetujui">
                                                    ACC
                                                </button>
                                                
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                    data-id="{{ $item['id'] }}"
                                                    data-nama="{{ $item['nama'] }}"
                                                    data-tipe="{{ $item['tipe'] }}"
                                                    data-status="4"
                                                    data-action-text="menolak">
                                                    Tolak
                                                </button>
                                            @else
                                                <span class="text-muted">Tidak ada aksi</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin <span id="modal-action-text"></span> pengajuan <strong><span id="modal-nama-display"></span></strong>?</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('manajemen.updateStatus') }}" id="confirmForm">
                    @csrf
                    <input type="hidden" name="id" id="modal-id">
                    <input type="hidden" name="tipe" id="modal-tipe">
                    <input type="hidden" name="status" id="modal-status">
                    <input type="hidden" name="nama" id="modal-nama">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

