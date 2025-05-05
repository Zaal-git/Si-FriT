@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ $title }}</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServerModal">Tambah Server</button>
                    </div>

                    <div class="card-body">
                        <table id="dataTables" class="table table-striped">
                          <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Server</th>
                                <th>IP Address</th>
                                <th>Lokasi</th>
                                <th>Memory (GB)</th> {{-- Tambahan --}}
                                <th>Storage (GB)</th> {{-- Tambahan --}}
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                        
                          <tbody>
                            @foreach($servers as $server)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $server->name }}</td>
                                <td>{{ $server->ip_address }}</td>
                                <td>{{ $server->location }}</td>
                                <td>{{ $server->memory_gb ?? '-' }}</td> {{-- Tambahan --}}
                                <td>{{ $server->storage_gb ?? '-' }}</td> {{-- Tambahan --}}
                                <td>{{ $server->status ? 'Aktif' : 'Nonaktif' }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm editServer" data-id="{{ $server->id }}" data-bs-toggle="modal" data-bs-target="#editServerModal">Edit</button>
                                    <button class="btn btn-danger btn-sm deleteServer" data-id="{{ $server->id }}">Hapus</button>
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
    
    <!-- Modal Tambah Server -->
    <div class="modal fade" id="addServerModal" tabindex="-1" aria-labelledby="addServerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Server</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addServerForm" action="{{ route('master-data.server.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Server</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="ip_address" class="form-label">IP Address</label>
                            <input type="text" class="form-control" id="ip_address" name="ip_address" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="mb-3">
                          <label for="memory_gb" class="form-label">Memory (GB)</label>
                          <input type="number" class="form-control" id="memory_gb" name="memory_gb" min="0">
                        </div>
                        <div class="mb-3">
                            <label for="storage_gb" class="form-label">Storage (GB)</label>
                            <input type="number" class="form-control" id="storage_gb" name="storage_gb" min="0">
                        </div>                      
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Server -->
<div class="modal fade" id="editServerModal" tabindex="-1" aria-labelledby="editServerLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Server</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editServerForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_id" name="id">
            <div class="mb-3">
              <label for="edit_name" class="form-label">Nama Server</label>
              <input type="text" class="form-control" id="edit_name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="edit_ip_address" class="form-label">IP Address</label>
              <input type="text" class="form-control" id="edit_ip_address" name="ip_address" required>
            </div>
            <div class="mb-3">
              <label for="edit_location" class="form-label">Lokasi</label>
              <input type="text" class="form-control" id="edit_location" name="location" required>
            </div>
            <div class="mb-3">
              <label for="edit_memory_gb" class="form-label">Memory (GB)</label>
              <input type="number" class="form-control" id="edit_memory_gb" name="memory_gb" min="0">
          </div>
          <div class="mb-3">
              <label for="edit_storage_gb" class="form-label">Storage (GB)</label>
              <input type="number" class="form-control" id="edit_storage_gb" name="storage_gb" min="0">
          </div>          
          <div class="mb-3">
              <label for="edit_status" class="form-label">Status</label>
              <select class="form-control" id="edit_status" name="status">
                <option value="1">Aktif</option>
                <option value="0">Nonaktif</option>
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
  
<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus server ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
        </div>
      </div>
    </div>
  </div>
  
    
@include('layouts.footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  @if(session('success'))
      Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: '{{ session('success') }}',
          timer: 2500,
          showConfirmButton: false
      });
  @endif

  @if(session('alert'))
      Swal.fire({
          icon: '{{ session('alert.type') == "success" ? "success" : "error" }}',
          title: '{{ session('alert.type') == "success" ? "Berhasil!" : "Gagal!" }}',
          text: '{{ session('alert.message') }}',
          timer: 2500,
          showConfirmButton: false
      });
  @endif
