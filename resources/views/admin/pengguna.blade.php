<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Pengguna - MindCare</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <style>
     /* Tambahkan style tambahan khusus tabel/modal di sini jika perlu, atau gabung ke style.css */
     .modal-overlay { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
     .modal-content { background: white; padding: 24px; border-radius: 12px; width: 90%; max-width: 500px; }
     .action-buttons { display: flex; gap: 5px; }
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
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pasien') }}" class="nav-link {{ request()->routeIs('admin.pasien') ? 'active' : '' }}">
                            <i class="fas fa-users"></i><span>Manajemen Pasien</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pengguna') }}" class="nav-link {{ request()->routeIs('admin.pengguna') ? 'active' : '' }}">
                            <i class="fas fa-users-cog"></i><span>Manajemen Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.sistem') }}" class="nav-link {{ request()->routeIs('admin.sistem') ? 'active' : '' }}">
                            <i class="fas fa-cogs"></i><span>Manajemen Sistem</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-section">
                <ul>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
                </ul>
            </li>
        </ul>
      </nav>
    </aside>

    <main class="main-content">
      <header class="header fade-in">
        <div class="header-top">
            <div class="welcome-text">
                <h1>Manajemen Pengguna</h1>
                <p>Kelola semua pengguna yang terdaftar.</p>
            </div>
            <div class="header-actions">
                <button onclick="openModal()" class="btn btn-primary"><i class="fas fa-user-plus"></i> Tambah User</button>
            </div>
        </div>
      </header>

      <div class="content-wrapper">
        <div class="card fade-in">
            <div class="card-header">
                <h3 class="chart-title">Daftar Pengguna ({{ $users->count() }})</h3>
            </div>
            <div class="card-body report-table-container">
                <table class="report-table">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                    <tr>
                        <td>{{ $u->full_name }}</td>
                        <td>{{ $u->username }}</td>
                        <td>{{ $u->email }}</td>
                        <td><span class="status-badge" style="background:#f3f4f6;">{{ ucfirst($u->role) }}</span></td>
                        <td><span class="status-badge {{ $u->is_active ? 'status-aktif' : 'status-nonaktif' }}">{{ $u->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('admin.pengguna.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="empty-state">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>
      </div>
    </main>
  </div>

  <div id="userModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Tambah User Baru</h3>
        <form action="{{ route('admin.pengguna.store') }}" method="POST">
            @csrf
            <div class="form-group"><label>Nama Lengkap</label><input type="text" name="full_name" required></div>
            <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="patient">Patient</option>
                    <option value="counselor">Counselor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      function openModal() { document.getElementById('userModal').style.display = 'flex'; }
      function closeModal() { document.getElementById('userModal').style.display = 'none'; }
      
      @if(session('success'))
        Swal.fire('Sukses', '{{ session('success') }}', 'success');
      @endif
      @if($errors->any())
        Swal.fire('Error', '{{ $errors->first() }}', 'error');
      @endif
  </script>
</body>
</html>