@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

@php $isUnit = auth()->user()->role === 'unit'; @endphp

<div class="container-fluid">
    <h4 class="mb-4">Pengajuan - Jaringan</h4>

    <div class="row">
        @foreach(['Router', 'Switch', 'Firewall', 'Access-Point', 'LAN'] as $type)
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong>
                            @switch($type)
                                @case('Router') <iconify-icon icon="mdi:router-network" class="me-1"></iconify-icon> @break
                                @case('Switch') <iconify-icon icon="material-symbols:settings-ethernet" class="me-1"></iconify-icon> @break
                                @case('Firewall') <iconify-icon icon="mdi:firewall" class="me-1"></iconify-icon> @break
                                @case('Access-Point') <iconify-icon icon="mdi:access-point" class="me-1"></iconify-icon> @break
                                @case('LAN') <iconify-icon icon="ph:lan-fill" class="me-1"></iconify-icon> @break
                            @endswitch
                            {{ $type }}
                        </strong>
                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapse-{{ strtolower($type) }}">Lihat Daftar</button>
                    </div>
                    <div class="collapse" id="collapse-{{ strtolower($type) }}">
                        <ul class="list-group list-group-flush">
                            @foreach($infrastrukturs->where('type', $type) as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $item->name }}</strong><br>
                                        <small class="text-muted">{{ $item->ip_address }} - {{ $item->location }}</small>
                                        @if($item->status == '2')
                                            <div class="mt-1">
                                                <small class="text-info">Diajukan untuk: {{ $item->lokasi_pengajuan }}</small><br>
                                                <small class="text-secondary">Pengaju: {{ $item->pengaju }}</small>
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
        @endforeach
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
                        <label>Jenis</label>
                        <input type="text" id="modal-name" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Tipe</label>
                        <input type="text" id="modal-type" class="form-control" readonly>
                    </div>

                    @if(!$isUnit)
                        <div class="mb-3">
                            <label>Unit Pengaju</label>
                            <select name="unit_user_id" id="unit-user-select" class="form-select" required>
                                <option value="">Pilih Unit</option>
                                @foreach($unitUsers as $user)
                                    <option value="{{ $user->id }}" data-lokasi="{{ $user->lokasi }}">
                                        {{ $user->name }} ({{ $user->lokasi }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Lokasi Pemasangan / Peminjaman</label>
                            <input type="text" name="lokasi_pengajuan" id="lokasi-pengajuan" class="form-control" readonly required>
                        </div>
                    @else
                        <input type="hidden" name="unit_user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="lokasi_pengajuan" value="{{ auth()->user()->lokasi }}">
                        <input type="hidden" name="pengaju" value="{{ auth()->user()->name }}">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ajukan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('ajukanModal');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const type = button.getAttribute('data-type');
    
            document.getElementById('modal-infrastruktur-id').value = id;
            document.getElementById('modal-name').value = name;
            document.getElementById('modal-type').value = type;
        });
    
        // Untuk admin: Update lokasi pengajuan saat unit dipilih
        @if(!$isUnit)
        document.getElementById('unit-user-select').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const lokasi = selectedOption.getAttribute('data-lokasi');
            document.getElementById('lokasi-pengajuan').value = lokasi;
        });
        @endif
    });
    </script>
