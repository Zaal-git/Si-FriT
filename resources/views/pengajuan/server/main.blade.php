@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <iconify-icon icon="carbon:server-proxy" width="28" class="me-2"></iconify-icon>
            Pengajuan Server
        </h4>
        <div class="d-flex">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <iconify-icon icon="mi:filter"></iconify-icon> Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="#" data-filter="all">Semua</a></li>
                    <li><a class="dropdown-item" href="#" data-filter="pending">Menunggu</a></li>
                    <li><a class="dropdown-item" href="#" data-filter="approved">Disetujui</a></li>
                    <li><a class="dropdown-item" href="#" data-filter="rejected">Ditolak</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Statistik Cepat -->
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="card stat-card bg-primary bg-opacity-10 border-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total Server</h6>
                                    <h3 class="mb-0">{{ $totalPengajuan }}</h3>
                                </div>
                                <div class="bg-primary bg-opacity-25 p-3 rounded">
                                    <iconify-icon icon="carbon:request-quote" width="24" class="text-primary"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card bg-success bg-opacity-10 border-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Disetujui</h6>
                                    <h3 class="mb-0">{{ $approved }}</h3>
                                </div>
                                <div class="bg-success bg-opacity-25 p-3 rounded">
                                    <iconify-icon icon="mdi:approval" width="24" class="text-success"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card bg-warning bg-opacity-10 border-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Pengajuan</h6>
                                    <h3 class="mb-0">{{ $pending }}</h3>
                                </div>
                                <div class="bg-warning bg-opacity-25 p-3 rounded">
                                    <iconify-icon icon="mdi:clock-outline" width="24" class="text-warning"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card bg-danger bg-opacity-10 border-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Ditolak</h6>
                                    <h3 class="mb-0">{{ $rejected }}</h3>
                                </div>
                                <div class="bg-danger bg-opacity-25 p-3 rounded">
                                    <iconify-icon icon="mdi:close-circle-outline" width="24" class="text-danger"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Pengajuan -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="pengajuanTable">
                            <thead class="table-light">
                                <tr>
                                    <th width="50px">No</th>
                                    <th>Ip Address</th>
                                    <th>Spesifikasi</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($servers as $pengajuan)
                                <tr data-status="{{ 
                                    $pengajuan->status == 1 ? 'draft' : 
                                    ($pengajuan->status == 2 ? 'pending' : 
                                    ($pengajuan->status == 3 ? 'approved' : 
                                    ($pengajuan->status == 4 ? 'rejected' : 'unknown')))
                                }}">

                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3">
                                                <span class="symbol-label bg-light-primary">
                                                    <iconify-icon icon="carbon:server-proxy" width="24" class="text-primary"></iconify-icon>
                                                </span>
                                            </div>
                                            <div>
                                                <strong>{{ $pengajuan->nama_server }}</strong>
                                                <div class="text-muted small">{{ $pengajuan->ip_address }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                                <span class="fw-bold">Memory: {{ $pengajuan->memory_gb }} GB</span>
                                                <small class="text-muted">Storage: {{ $pengajuan->storage_gb }} GB</small>
                                        </div>                                       
                                    </td>
                                    <td>{{ $pengajuan->location }}</td>
                                    <td>{{ $pengajuan->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($pengajuan->status == 1)
                                            <button type="button" class="btn btn-primary btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#ajukanServerModal"
                                                    data-id="{{ $pengajuan->id }}"
                                                    data-ip="{{ $pengajuan->ip_address }}"
                                                    data-nama="{{ $pengajuan->nama_server }}">
                                                Ajukan
                                            </button>
                                        @elseif($pengajuan->status == 2)
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($pengajuan->status == 3)
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif($pengajuan->status == 4)
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>             
                                    <td>
                                        <!-- Tombol Detail -->
                                        <button type="button" class="btn btn-info btn-sm ms-2 text-white" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#detailModal"
                                        data-nama="{{ $pengajuan->name }}"
                                        data-ip="{{ $pengajuan->ip_address }}"
                                        data-lokasi="{{ $pengajuan->location }}"
                                        data-pengaju="{{ $pengajuan->pengaju }}"
                                        data-lokasiPengaju="{{ $pengajuan->lokasi_pengaju }}"
                                        data-status="{{ $pengajuan->status }}"
                                        data-tanggal="{{ $pengajuan->created_at->format('d M Y') }}">
                                        Detail
                                    </button>
                                     
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
<!-- Modal Ajukan Server -->
<div class="modal fade" id="ajukanServerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('pengajuan.server.store') }}" method="POST" id="formAjukanServer">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajukan Server</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="server_id" id="server_id">
  
            <div class="mb-3">
              <label class="form-label">IP Address</label>
              <input type="text" class="form-control" id="ip_address" readonly>
            </div>

            @if($user->role != 'unit')
                <div class="mb-3">
                    <label class="form-label">Pengaju</label>
                    <select name="pengaju" id="pengajuSelect" class="form-select" required>
                        <option value="">Pilih Pengaju</option>
                        @foreach($users as $u)
                            <option value="{{ $u->name }}" data-lokasi="{{ $u->lokasi }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi Pengajuan</label>
                    <input type="text" class="form-control" name="lokasi_pengajuan" id="lokasiPengajuanInput" readonly required>
                </div>
            @else
                <input type="hidden" name="pengaju" value="{{ $user->name }}">
                <input type="hidden" name="lokasi_pengajuan" value="{{ $user->lokasi }}">
            @endif

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Ajukan Server</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Detail Pengajuan Server</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Nama Server:</strong> <span id="detailNama"></span></li>
            <li class="list-group-item"><strong>IP Address:</strong> <span id="detailIp"></span></li>
            <li class="list-group-item"><strong>Lokasi:</strong> <span id="detailLokasi"></span></li>
            <li class="list-group-item"><strong>Pengaju:</strong> <span id="detailPengaju"></span></li>
            <li class="list-group-item"><strong>Lokasi Pengaju:</strong> <span id="detailLokasiPengaju"></span></li>
            <li class="list-group-item"><strong>Status:</strong> <span id="detailStatus"></span></li>
            <li class="list-group-item"><strong>Tanggal Pengajuan:</strong> <span id="detailTanggal"></span></li>
          </ul>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  
  





    
    
   

@include('layouts.footer')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pengajuSelect = document.getElementById('pengajuSelect');
        const lokasiInput = document.getElementById('lokasiPengajuanInput');

        if (pengajuSelect && lokasiInput) {
            pengajuSelect.addEventListener('change', function () {
                const selectedOption = pengajuSelect.options[pengajuSelect.selectedIndex];
                const lokasi = selectedOption.getAttribute('data-lokasi');
                lokasiInput.value = lokasi || '';
            });
        }
    });
</script>
