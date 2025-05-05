@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<div class="container-fluid">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-message">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="flash-message">
        {{ session('error') }}
    </div>
@endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Manajemen - User</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Tambah User</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($users as $user)
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border-0 bg-light">
                                    <div class="card-body text-center">
                                        <!-- Icon Role -->
                                        @if ($user->role === 'admin')
                                            <i class="fas fa-user-shield fa-3x text-primary mb-2"></i>
                                        @elseif ($user->role === 'unit')
                                            <i class="fas fa-user-tag fa-3x text-success mb-2"></i>
                                        @else
                                            <i class="fas fa-user-circle fa-3x text-secondary mb-2"></i>
                                        @endif

                                        <!-- User Info -->
                                        <h5 class="card-title mt-2">{{ $user->name }}</h5>
                                        <p class="card-text mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                                        <p class="card-text mb-2"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                                        
                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('manajemen.user.index', ['edit' => $user->id]) }}" class="btn btn-sm btn-primary">
                                                Edit
                                            </a>                                            
                                            <form action="{{ route('manajemen.user.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Tambah User -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('manajemen.user.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="unit">Unit</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah User</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal untuk Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ $editUser ? route('manajemen.user.update', $editUser->id) : '' }}">
            @csrf
            @method('PUT')        
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editName" name="name" value="{{ $editUser->name ?? '' }}" required>
                    </div>

                    <!-- Input Email -->
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" value="{{ $editUser->email ?? '' }}" required>
                    </div>

                    <!-- Input Role -->
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-select" id="editRole" name="role" required>
                            <option value="admin" {{ $editUser && $editUser->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="unit" {{ $editUser && $editUser->role == 'unit' ? 'selected' : '' }}>Unit</option>
                        </select>
                    </div>

                    <!-- Input Password (Opsional) -->
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Password Baru (Opsional)</label>
                        <input type="password" class="form-control" id="editPassword" name="password">
                        <small class="text-muted">Masukkan password baru jika ingin mengganti password user.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </div>
        </form>
    </div>
</div>
@if(request()->has('edit') && $editUser)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editModal.show();
        });
    </script>
@endif



@include('layouts.footer')