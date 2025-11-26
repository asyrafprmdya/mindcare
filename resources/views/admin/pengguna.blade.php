@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('header-title', 'Manajemen Pengguna')
@section('header-subtitle', 'Kelola semua pengguna yang terdaftar di sistem.')

@section('header-actions')
    <button onclick="openModal()" class="btn btn-primary" style="background: #8b5cf6; border-radius: 8px; padding: 12px 24px; font-weight: 600;">
        <i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Tambah Pengguna Baru
    </button>
@endsection

@section('content')
    <style>
        /* --- Style Khusus Sesuai Gambar --- */
        
        .search-wrapper { position: relative; width: 300px; }
        .search-input { width: 100%; padding: 10px 16px 10px 40px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; color: #64748b; }
        .search-input:focus { border-color: #8b5cf6; }
        .search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; }

        /* Table Styling (RATA KIRI) */
        .custom-table th {
            font-size: 11px; color: #94a3b8; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;
            background: #ffffff; border-bottom: 1px solid #f1f5f9; padding: 20px 24px; text-align: left;
        }
        .custom-table td {
            padding: 16px 24px; color: #334155; font-size: 14px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; text-align: left;
        }

        /* Badges */
        .badge { padding: 6px 16px; border-radius: 6px; font-size: 12px; font-weight: 700; display: inline-block; }
        .badge-patient { background: #dbeafe; color: #1e40af; } 
        .badge-admin { background: #f3e8ff; color: #7e22ce; }   
        .badge-counselor { background: #ffedd5; color: #c2410c; } 
        .badge-active { background: #dcfce7; color: #166534; } 
        .badge-inactive { background: #fee2e2; color: #991b1b; } 

        /* Action Buttons */
        .btn-action { width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; border: none; cursor: pointer; transition: 0.2s; margin-right: 6px; }
        .btn-edit { background: #f3e8ff; color: #7c3aed; }
        .btn-edit:hover { background: #ede9fe; }
        .btn-delete { background: #fee2e2; color: #ef4444; }
        .btn-delete:hover { background: #fecaca; }

        /* Modal Styling */
        .modal-overlay { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
        .modal-content { background: white; padding: 30px; border-radius: 16px; width: 90%; max-width: 500px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px; color: #334155; }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; }
        
        /* SweetAlert Custom */
        .swal2-popup { border-radius: 16px !important; padding: 24px !important; }
        .swal2-title { font-size: 20px !important; color: #1e293b !important; }
        .swal2-confirm { background: #ef4444 !important; border-radius: 8px !important; }
        .swal2-cancel { background: #f1f5f9 !important; color: #64748b !important; border-radius: 8px !important; }
    </style>

    <div class="card fade-in" style="border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);">
        
        <div class="card-header" style="padding: 24px 30px; background: white; border-bottom: 1px solid #f1f5f9;">
            <h3 class="chart-title" style="font-size: 16px; font-weight: 700; color: #0f172a;">
                Daftar Semua Pengguna ({{ $users->count() }})
            </h3>
            
            <div class="search-wrapper">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" id="searchInput" placeholder="Cari pengguna berdasarkan..." class="search-input">
            </div>
        </div>

        <div class="card-body" style="padding: 0;">
            <div style="overflow-x: auto;">
                <table class="custom-table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="width: 60px;">NO</th>
                            <th>NAMA LENGKAP</th>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>ROLE</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        @forelse($users as $u)
                        <tr>
                            <td style="font-weight: 600;">{{ $loop->iteration }}</td>
                            <td style="font-weight: 500; color: #1e293b;">{{ $u->full_name }}</td>
                            <td>{{ $u->username }}</td>
                            <td style="color: #64748b;">{{ $u->email }}</td>
                            <td><span class="badge badge-{{ $u->role }}">{{ ucfirst($u->role) }}</span></td>
                            <td><span class="badge {{ $u->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $u->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                            <td>
                                <div style="display: flex;">
                                    <button class="btn-action btn-edit" title="Edit" onclick="openEditModal({{ $u }})">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <form action="{{ route('admin.pengguna.destroy', $u->id) }}" method="POST" class="delete-form" data-username="{{ $u->username }}">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn-action btn-delete btn-delete-user" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" style="text-align: center; padding: 40px; color: #94a3b8;">Tidak ada data pengguna.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="userModal" class="modal-overlay">
        <div class="modal-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 700; margin: 0;">Tambah Pengguna Baru</h3>
                <button onclick="closeModal()" style="background: none; border: none; font-size: 20px; cursor: pointer; color: #94a3b8;">&times;</button>
            </div>
            <form action="{{ route('admin.pengguna.store') }}" method="POST" id="createUserForm">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>
                <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div><label>Username</label><input type="text" name="username" class="form-control" required></div>
                    <div>
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="patient">Patient</option>
                            <option value="admin">Admin</option>
                            <option value="counselor">Counselor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                <div style="text-align: right; margin-top: 24px;">
                    <button type="button" onclick="closeModal()" class="btn" style="background: #f1f5f9; color: #475569; margin-right: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="background: #8b5cf6; color: white;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editUserModal" class="modal-overlay">
        <div class="modal-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 700; margin: 0;">Edit Pengguna</h3>
                <button onclick="closeEditModal()" style="background: none; border: none; font-size: 20px; cursor: pointer; color: #94a3b8;">&times;</button>
            </div>
            <form action="" method="POST" id="editUserForm">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="full_name" id="edit_full_name" class="form-control" required>
                </div>
                <div class="form-group"><label>Username</label><input type="text" name="username" id="edit_username" class="form-control" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" id="edit_email" class="form-control" required></div>
                <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label>Role</label>
                        <select name="role" id="edit_role" class="form-control" required>
                            <option value="patient">Patient</option>
                            <option value="admin">Admin</option>
                            <option value="counselor">Counselor</option>
                        </select>
                    </div>
                    <div>
                        <label>Status</label>
                        <select name="is_active" id="edit_is_active" class="form-control" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password Baru <small style="color:#94a3b8">(Opsional)</small></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div style="text-align: right; margin-top: 24px;">
                    <button type="button" onclick="closeEditModal()" class="btn" style="background: #f1f5f9; color: #475569; margin-right: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="background: #8b5cf6; color: white;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // --- MODAL FUNCTIONS ---
    function openModal() { document.getElementById('userModal').style.display = 'flex'; }
    function closeModal() { document.getElementById('userModal').style.display = 'none'; }
    
    function openEditModal(user) {
        document.getElementById('edit_full_name').value = user.full_name;
        document.getElementById('edit_username').value = user.username;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role').value = user.role;
        document.getElementById('edit_is_active').value = user.is_active;
        document.getElementById('editUserForm').action = "/admin/pengguna/" + user.id;
        document.getElementById('editUserModal').style.display = 'flex';
    }
    function closeEditModal() { document.getElementById('editUserModal').style.display = 'none'; }

    // Menutup modal saat klik di luar
    window.onclick = function(event) {
        if (event.target == document.getElementById('userModal')) closeModal();
        if (event.target == document.getElementById('editUserModal')) closeEditModal();
    }

    // --- SEARCH ---
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#userTableBody tr');
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // --- SWEETALERT DELETE ---
    document.querySelectorAll('.btn-delete-user').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('.delete-form');
            const username = form.dataset.username;
            
            Swal.fire({
                title: 'Hapus Pengguna?',
                html: `Yakin ingin menghapus <strong>${username}</strong>?<br><small>Data tidak bisa dikembalikan.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                customClass: { confirmButton: 'swal2-confirm', cancelButton: 'swal2-cancel' }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ title: 'Menghapus...', didOpen: () => Swal.showLoading() });
                    form.submit();
                }
            });
        });
    });

    // --- SWEETALERT FLASH MESSAGES ---
    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 3000, showConfirmButton: false });
    @endif
    @if(session('error'))
        Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}' });
    @endif
    @if($errors->any())
        Swal.fire({ icon: 'error', title: 'Error Validasi', html: '<ul style="text-align:left">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>' });
    @endif
</script>
@endpush