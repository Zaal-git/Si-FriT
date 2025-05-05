{{-- Footer Scripts --}}
</div> {{-- Body Wrapper --}}
</div> {{-- Page Wrapper --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/js/uikit.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.uikit.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>



$(document).ready(function() {
    // Init DataTables
    $('#dataTables').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Berikutnya",
                previous: "Sebelumnya"
            }
        }
    });

    // ========= EDIT INFRA =========
    $('.editInfra').on('click', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/master-data/infrastruktur/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $('#edit_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_type').val(response.type).change();
                $('#edit_ip_address').val(response.ip_address);
                $('#edit_location').val(response.location);
                $('#edit_status').val(response.status);
                $('#editServerForm').attr('action', '/master-data/infrastruktur/' + response.id);
            },
            error: function() {
                alert('Gagal mengambil data Infrastruktur.');
            }
        });
    });

    // ========= EDIT SERVER =========
    $('.editServer').on('click', function() {
    var id = $(this).data('id');
    $.ajax({
        url: '/master-data/server/' + id + '/edit',
        type: 'GET',
        success: function(response) {
            $('#edit_id').val(response.id);
            $('#edit_name').val(response.name);
            $('#edit_ip_address').val(response.ip_address);
            $('#edit_location').val(response.location);
            $('#edit_memory_gb').val(response.memory_gb);        // ✅ Tambahan
            $('#edit_storage_gb').val(response.storage_gb);      // ✅ Tambahan
            $('#edit_status').val(response.status);
            $('#editServerForm').attr('action', '/master-data/server/' + response.id);
        },
        error: function() {
            alert('Gagal mengambil data Server.');
        }
    });
});


    // ========= DELETE (INFRA & SERVER) =========
    let deleteType = null;
    let deleteId = null;

    $('.deleteInfra').click(function() {
        deleteType = 'infra';
        deleteId = $(this).data('id');
        confirmDelete();
    });

    $('.deleteServer').click(function() {
        deleteType = 'server';
        deleteId = $(this).data('id');
        confirmDelete();
    });

    function confirmDelete() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                deleteData(deleteType, deleteId);
            }
        });
    }

    function deleteData(type, id) {
        let url = (type === 'infra') ? `/master-data/infrastruktur/${id}` : `/master-data/server/${id}`;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _method: 'DELETE',
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal menghapus data!',
                        text: response.message,
                        showConfirmButton: true
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan!',
                    text: 'Gagal menghapus data.',
                    showConfirmButton: true
                });
            }
        });
    }
});

// Fungsi untuk menampilkan detail pengajuan
function showDetail(id) {
    fetch(`/pengajuan-server/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('detailPengajuanContent').innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Nama Server</label>
                            <p class="fw-bold">${data.nama_server}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Tipe Server</label>
                            <p class="fw-bold">${data.tipe_server}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">IP Address</label>
                            <p class="fw-bold">${data.ip_address}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Lokasi</label>
                            <p class="fw-bold">${data.lokasi}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Spesifikasi</label>
                            <p>CPU: ${data.cpu}<br>RAM: ${data.ram}<br>Storage: ${data.storage}</p>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Alasan Pengajuan</label>
                    <p>${data.alasan}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Kebutuhan Khusus</label>
                    <p>${data.kebutuhan_khusus || '-'}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Status</label>
                    <p>${renderStatusBadge(data.status)}</p>
                </div>
            `;

            var detailModal = new bootstrap.Modal(document.getElementById('detailPengajuanModal'));
            detailModal.show();
        });
}


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
});

    // Inisialisasi tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Filter pengajuan
    document.querySelectorAll('[data-filter]').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const filter = this.getAttribute('data-filter');

            document.querySelectorAll('#pengajuanTable tbody tr').forEach(row => {
                if (filter === 'all' || row.getAttribute('data-status') === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    $('#ajukanServerModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var ip = button.data('ip');

    var modal = $(this);
    modal.find('#server_id').val(id);
    modal.find('#ip_address').val(ip);
});


const statusLabel = {
    1: 'Draft',
    2: 'Menunggu',
    3: 'Disetujui',
    4: 'Ditolak'
  };

  const detailModal = document.getElementById('detailModal');
  detailModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    document.getElementById('detailNama').innerText = button.getAttribute('data-nama');
    document.getElementById('detailIp').innerText = button.getAttribute('data-ip');
    document.getElementById('detailLokasi').innerText = button.getAttribute('data-lokasi');
    document.getElementById('detailPengaju').innerText = button.getAttribute('data-pengaju');
    document.getElementById('detailLokasiPengaju').innerText = button.getAttribute('data-lokasiPengaju');
    document.getElementById('detailStatus').innerText = statusLabel[button.getAttribute('data-status')];
    document.getElementById('detailTanggal').innerText = button.getAttribute('data-tanggal');
  });

   // Menangani klik pada tombol ACC atau Tolak
   $('#confirmModal').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget); // Tombol yang diklik
    var id = button.data('id');
    var tipe = button.data('tipe');
    var status = button.data('status');
    var nama = button.data('nama');
    var actionText = button.data('action-text');

    // Menetapkan nilai ke form modal
    $('#modal-id').val(id);
    $('#modal-tipe').val(tipe);
    $('#modal-status').val(status);
    $('#modal-nama').val(nama);
    $('#modal-action-text').text('Apakah Anda yakin ingin ' + actionText + ' pengajuan ' + nama + '?');
});

$('#confirmForm').submit(function(event) {
    event.preventDefault(); // Mencegah form submit default

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        type: 'POST',
        url: url,
        data: form.serialize(),
        success: function(response) {
            if (response.success) {
                // Tindakan setelah sukses, misalnya refresh halaman atau memberi feedback
                location.reload(); // Untuk me-refresh halaman setelah update status
            }
        },
        error: function() {
            alert('Terjadi kesalahan saat memproses permintaan.');
        }
    });
});





    

</script>
<script>
    @if(session('alert'))
        Swal.fire({
            icon: '{{ session('alert.type') }}',
            title: '{{ session('alert.type') == 'success' ? 'Berhasil!' : 'Gagal!' }}',
            text: '{{ session('alert.message') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif
</script>


</body>
</html>
