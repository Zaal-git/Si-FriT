@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

{{-- Bungkus konten utama dalam div dengan padding atas --}}
<div class="main-content" style="padding-top: 100px; padding-right: 20px; padding-left: 20px;">
    <div class="container-fluid">
        <div class="card shadow rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h5 class="mb-0 text-white">
                    <iconify-icon icon="carbon:add-alt" class="me-2 text-white"></iconify-icon>
                    Form Pengajuan Aplikasi
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pengajuan.aplikasi.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_aplikasi" class="form-label fw-semibold">Nama Aplikasi</label>
                        <input type="text" class="form-control" id="nama_aplikasi" name="nama_aplikasi" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_aplikasi" class="form-label fw-semibold">Jenis Aplikasi</label>
                        <select class="form-select" id="jenis_aplikasi" name="jenis_aplikasi" required>
                            <option selected disabled>Pilih jenis aplikasi</option>
                            <option value="Web">Web</option>
                            <option value="Mobile">Mobile</option>
                            <option value="Desktop">Desktop</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Tuliskan deskripsi singkat aplikasi..."></textarea>
                    </div>

                    @if ($user->role != 'unit')
                    <div class="mb-3">
                        <label for="pengaju" class="form-label fw-semibold">Pengaju</label>
                        <input type="text" class="form-control" id="pengaju" name="pengaju" required>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi_penempatan" class="form-label fw-semibold">Lokasi Penempatan</label>
                        <input type="text" class="form-control" id="lokasi_penempatan" name="lokasi_penempatan">
                    </div>
                    
                    @else
                    <div class="mb-3">
                        <label for="pengaju" class="form-label fw-semibold">Pengaju</label>
                        <input type="text" class="form-control" id="pengaju" name="pengaju" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi_penempatan" class="form-label fw-semibold">Lokasi Penempatan</label>
                        <input type="text" class="form-control" id="lokasi_penempatan" name="lokasi_penempatan" value="{{ $user->lokasi }}" readonly>
                    </div>
                    @endif
                    
                    <div class="mb-3">
                        <label for="alasan_pengajuan" class="form-label fw-semibold">Alasan Pengajuan</label>
                        <textarea class="form-control" id="alasan_pengajuan" name="alasan_pengajuan" rows="3" placeholder="Jelaskan alasan pengajuan..." value=></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pengajuan" class="form-label fw-semibold">Tanggal Pengajuan</label>
                        <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            <iconify-icon icon="mdi:send-outline" class="me-1"></iconify-icon>
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
