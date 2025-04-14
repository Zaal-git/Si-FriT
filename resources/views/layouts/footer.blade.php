{{-- Footer Scripts --}}
</div> {{-- Body Wrapper --}}
</div> {{-- Page Wrapper --}}

<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

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
                $('#edit_status').val(response.status);

                $('#editServerForm').attr('action', '/master-data/server/' + response.id);
            },
            error: function() {
                alert('Gagal mengambil data Server.');
            }
        });
    });

    // ========= DELETE INFRA =========
    let infraIdToDelete = null;
    $('.deleteInfra').click(function() {
        infraIdToDelete = $(this).data('id');
        $('#confirmDeleteModal').modal('show');
    });

    $('#confirmDeleteBtn').click(function() {
        if (infraIdToDelete) {
            $.ajax({
                url: `/master-data/infrastruktur/${infraIdToDelete}`,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    alert('Gagal menghapus Infrastruktur!');
                }
            });
        }
    });

    // ========= DELETE SERVER =========
    let serverIdToDelete = null;
    $('.deleteServer').click(function() {
        serverIdToDelete = $(this).data('id');
        $('#confirmDeleteModal').modal('show');
    });

    $('#confirmDeleteBtn').click(function() {
        if (serverIdToDelete) {
            $.ajax({
                url: `/master-data/server/${serverIdToDelete}`,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    alert('Gagal menghapus Server!');
                }
            });
        }
    });
});
</script>

</body>
</html>
