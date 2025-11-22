<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Pasien - MindCare</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <style>
     .modal-overlay { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
     .modal-content { background: white; padding: 24px; border-radius: 12px; width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto;}
     .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="logo">
          <div class="logo-icon"><i class="fas fa-brain"></i></div>
          <div class="logo-text"><span class="logo-title">MindCare</span><span class="logo-subtitle">Admin Panel</span></div>
      </div>
      <nav>
        <ul class="nav-menu">
            <li class="nav-section">
                <div class="nav-section-title">Manajemen Admin</div>
                <ul>
                    <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a href="{{ route('admin.pasien') }}" class="nav-link active"><i class="fas fa-users"></i><span>Manajemen Pasien</span></a></li>
                    <li class="nav-item"><a href="{{ route('admin.pengguna') }}" class="nav-link"><i class="fas fa-users-cog"></i><span>Manajemen Pengguna</span></a></li>
                    <li class="nav-item"><a href="{{ route('admin.sistem') }}" class="nav-link"><i class="fas fa-cogs"></i><span>Manajemen Sistem</span></a></li>
                </ul>
            </li>
            <li class="nav-section">
                <ul><li class="nav-item"><a href="{{ url('/logout') }}" class="nav-link" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li></ul>
            </li>
        </ul>
      </nav>
    </aside>

    <main class="main-content">
      <header class="header fade-in">
        <div class="header-top">
            <div class="welcome-text"><h1>Manajemen Pasien</h1><p>Kelola data pasien terdaftar.</p></div>
            <div class="header-actions"><button onclick="openTambahModal()" class="btn btn-primary"><i class="fas fa-user-plus"></i> Tambah Pasien</button></div>
        </div>
      </header>

      <div class="content-wrapper">
        <div class="card fade-in">
            <div class="card-body report-table-container">
                <table class="report-table">
                <thead>
                    <tr><th>Nama</th><th>Email</th><th>Telepon</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($patients as $p)
                    <tr>
                        <td>{{ $p->full_name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->phone }}</td>
                        <td><span class="status-badge {{ $p->is_active ? 'status-aktif' : 'status-nonaktif' }}">{{ $p->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                        <td>
                            <button onclick="openEditModal({{ json_encode($p) }})" class="btn-edit"><i class="fas fa-pen"></i></button>
                            <form action="{{ route('admin.pasien.destroy', $p->user_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus pasien ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="empty-state">Tidak ada data pasien.</td></tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>
      </div>
    </main>
  </div>

  <div id="tambahModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Tambah Pasien Baru</h3>
        <form action="{{ route('admin.pasien.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group"><label>Nama Lengkap</label><input type="text" name="full_name" required></div>
                <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
            </div>
            <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
            <div class="form-grid">
                <div class="form-group"><label>Telepon</label><input type="text" name="phone"></div>
                <div class="form-group"><label>Tgl Lahir</label><input type="date" name="date_of_birth"></div>
            </div>
            <div class="form-group"><label>Alamat</label><textarea name="address" rows="2" style="width:100%;"></textarea></div>
            <div class="modal-footer">
                <button type="button" onclick="closeTambahModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
  </div>

  <div id="editModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Edit Pasien</h3>
        <form id="editForm" method="POST">
            @csrf @method('PUT')
            <div class="form-group"><label>Nama Lengkap</label><input type="text" id="edit_full_name" name="full_name" required></div>
            <div class="form-grid">
                <div class="form-group"><label>Telepon</label><input type="text" id="edit_phone" name="phone"></div>
                <div class="form-group"><label>Status</label>
                    <select name="is_active" id="edit_is_active">
                        <option value="1">Aktif</option>
                        <option value="0">Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="form-group"><label>Tgl Lahir</label><input type="date" id="edit_date_of_birth" name="date_of_birth"></div>
            <div class="form-group"><label>Alamat</label><textarea id="edit_address" name="address" rows="2" style="width:100%;"></textarea></div>
            <div class="modal-footer">
                <button type="button" onclick="closeEditModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      function openTambahModal() { document.getElementById('tambahModal').style.display = 'flex'; }
      function closeTambahModal() { document.getElementById('tambahModal').style.display = 'none'; }
      
      function openEditModal(data) {
          document.getElementById('editForm').action = "/admin/pasien/" + data.user_id;
          document.getElementById('edit_full_name').value = data.full_name;
          document.getElementById('edit_phone').value = data.phone;
          document.getElementById('edit_is_active').value = data.is_active;
          document.getElementById('edit_date_of_birth').value = data.date_of_birth;
          document.getElementById('edit_address').value = data.address;
          document.getElementById('editModal').style.display = 'flex';
      }
      function closeEditModal() { document.getElementById('editModal').style.display = 'none'; }

      @if(session('success')) Swal.fire('Sukses', '{{ session('success') }}', 'success'); @endif
      @if($errors->any()) Swal.fire('Error', '{{ $errors->first() }}', 'error'); @endif
  </script>
</body>
</html> 