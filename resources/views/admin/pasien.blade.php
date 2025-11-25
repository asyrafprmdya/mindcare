<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Pengguna - MindCare</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  {{-- CSS Style Block --}}
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f8fafc; color: #1e293b; line-height: 1.6; }
    .dashboard-container { display: flex; min-height: 100vh; }
    .sidebar { width: 280px; background: #ffffff; color: #1e293b; padding: 24px 0; border-right: 1px solid #e2e8f0; position: fixed; height: 100vh; overflow-y: auto; z-index: 100; }
    .logo { padding: 0 24px 24px; margin-bottom: 24px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 12px; }
    .logo-icon { width: 42px; height: 42px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; flex-shrink: 0; }
    .logo-text { display: flex; flex-direction: column; }
    .logo-title { font-size: 18px; font-weight: 700; color: #0f172a; letter-spacing: -0.5px; line-height: 1.2; }
    .logo-subtitle { font-size: 11px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
    .nav-menu { list-style: none; padding: 0; }
    .nav-section { margin-bottom: 24px; padding: 0 12px; }
    .nav-section ul { list-style: none; padding: 0; }
    .nav-section-title { font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.8px; padding: 0 12px 8px; margin-bottom: 4px; }
    .nav-item { margin-bottom: 4px; }
    .nav-link { display: flex; align-items: center; gap: 12px; padding: 10px 12px; color: #64748b; text-decoration: none; border-radius: 8px; transition: all 0.2s ease; font-weight: 500; font-size: 14px; }
    .nav-link:hover { background: #f8fafc; color: #8b5cf6; }
    .nav-link.active { background: #f5f3ff; color: #8b5cf6; font-weight: 600; }
    .nav-link i { font-size: 18px; width: 20px; text-align: center; }
    .main-content { flex: 1; margin-left: 280px; background: #f8fafc; }
    .header { background: white; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 90; }
    .header-top { display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; max-width: 1600px; margin: 0 auto; }
    .welcome-text h1 { font-size: 24px; color: #0f172a; margin-bottom: 4px; font-weight: 700; letter-spacing: -0.5px; }
    .welcome-text p { color: #64748b; font-size: 14px; }
    .header-actions { display: flex; gap: 12px; }
    .btn { padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer; font-size: 14px; }
    .btn-primary { background: #8b5cf6; color: white; }
    .btn-primary:hover { background: #7c3aed; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3); }
    .btn-secondary { background: #e2e8f0; color: #1e293b; }
    .btn-secondary:hover { background: #cbd5e1; }
    .content-wrapper { padding: 32px 40px; max-width: 1600px; margin: 0 auto; }
    .fade-in { animation: fadeIn 0.5s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 24px; }
    .card-header { padding: 20px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
    .chart-title { font-size: 16px; color: #0f172a; font-weight: 700; letter-spacing: -0.3px; margin: 0; }
    .card-body { padding: 24px; }
    .search-bar { position: relative; max-width: 400px; }
    .search-bar input { width: 100%; padding: 10px 16px 10px 40px; border-radius: 8px; border: 1.5px solid #e2e8f0; font-size: 14px; }
    .search-bar input:focus { outline: none; border-color: #8b5cf6; box-shadow: 0 0 0 3px #f5f3ff; }
    .search-bar i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
    .report-table-container { overflow-x: auto; }
    .report-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .report-table th, .report-table td { padding: 16px; text-align: left; border-bottom: 1px solid #f1f5f9; font-size: 14px; vertical-align: middle; }
    .report-table th { font-size: 12px; font-weight: 600; color: #94a3b8; text-transform: uppercase; background: #f8fafc; }
    .report-table tbody tr:hover { background: #f8fafc; }
    .status-badge { padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-transform: capitalize; }
    .status-aktif { background: #dcfce7; color: #166534; }
    .status-nonaktif { background: #fee2e2; color: #991b1b; }
    .status-admin { background: #ede9fe; color: #5b21b6; }
    .status-patient { background: #dbeafe; color: #1e40af; }
    .status-counselor { background: #fef3c7; color: #92400e; }
    .action-buttons { display: flex; gap: 8px; }
    .btn-sm { padding: 6px 12px; font-size: 12px; font-weight: 600; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; border: none; cursor: pointer;}
    .btn-edit { background: #f5f3ff; color: #8b5cf6; }
    .btn-edit:hover { background: #ede9fe; }
    .btn-delete { background: #fef2f2; color: #dc2626; }
    .btn-delete:hover { background: #fee2e2; }
    
    /* CSS Modal */
    .modal-overlay { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
    .modal-content { background: white; padding: 24px; border-radius: 12px; width: 90%; max-width: 500px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); animation: modalFadeIn 0.3s ease-out; }
    @keyframes modalFadeIn { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
    .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 16px; margin-bottom: 20px; }
    .modal-title { font-size: 18px; font-weight: 700; color: #0f172a; }
    .modal-close { font-size: 24px; color: #94a3b8; cursor: pointer; border: none; background: none; }
    .modal-close:hover { color: #1e293b; }
    .form-group { margin-bottom: 16px; }
    .form-group label { display: block; font-size: 14px; font-weight: 500; color: #334155; margin-bottom: 8px; }
    .form-group input, .form-group select { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; font-family: 'Inter', sans-serif; }
    .form-group input:focus, .form-group select:focus { outline: none; border-color: #8b5cf6; box-shadow: 0 0 0 2px #f5f3ff; }
    .modal-footer { display: flex; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #f1f5f9; margin-top: 24px; }
    
    @media (max-width: 768px) {
        .sidebar { width: 70px; padding: 20px 10px; }
        .main-content { margin-left: 70px; }
        .logo-text, .nav-section-title, .nav-link span { display: none; }
        .nav-link { justify-content: center; padding: 12px; }
        .nav-section { padding: 0 6px; }
        .logo { justify-content: center; padding: 0 10px 20px; }
        .header-top { flex-direction: column; gap: 16px; text-align: center; padding: 16px 20px; }
        .header-actions { width: 100%; }
        .btn { width: 100%; justify-content: center; }
        .content-wrapper { padding: 24px 20px; }
        .card-header { flex-direction: column; align-items: flex-start; gap: 16px; }
        .search-bar { max-width: 100%; }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    {{-- Sidebar --}}
    <aside class="sidebar">
      <div class="logo">
          <div class="logo-icon"><i class="fas fa-brain"></i></div>
          <div class="logo-text">
              <span class="logo-title">MindCare</span>
              <span class="logo-subtitle">Admin Panel</span>
          </div>
      </div>
      <nav>
        <ul class="nav-menu">
            <li class="nav-section">
                <div class="nav-section-title">Manajemen Admin</div>
                <ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-users"></i><span>Manajemen Pasien</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link active"><i class="fas fa-users-cog"></i><span>Manajemen Pengguna</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-cogs"></i><span>Manajemen Sistem</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-section">
                <div class="nav-section-title">Laporan</div>
                <ul>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-bar"></i><span>Laporan Sesi</span></a></li>
                </ul>
            </li>
            <li class="nav-section">
                <div class="nav-section-title">Akun</div>
                <ul>
                    <li class="nav-item">
                        {{-- Form Logout Laravel --}}
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link" style="background:none; border:none; width:100%; text-align:left; cursor:pointer;">
                                <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                            </button>
                        </form>
                    </li>
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
                <p>Kelola semua pengguna yang terdaftar di sistem.</p>
            </div>
            <div class="header-actions">
                <button type="button" id="tambahUserBtn" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> <span>Tambah Pengguna Baru</span>
                </button>
            </div>
        </div>
      </header>

      <div class="content-wrapper">

        <div class="card fade-in">
            <div class="card-header">
                <h3 class="chart-title">Daftar Semua Pengguna ({{ $users->count() }})</h3>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" id="userSearch" placeholder="Cari pengguna berdasarkan nama, email...">
                </div>
            </div>
            <div class="card-body report-table-container">
                <table class="report-table" id="userTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Tgl. Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($users->isEmpty())
                        <tr><td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">Tidak ada data pengguna.</td></tr>
                    @else
                        @foreach($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->full_name }}</td>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                @php
                                    $roleClass = 'status-' . strtolower($u->role);
                                @endphp
                                <span class='status-badge {{ $roleClass }}'>{{ $u->role }}</span>
                            </td>
                            <td>
                                @php
                                    $class = $u->is_active ? 'status-aktif' : 'status-nonaktif';
                                    $status = $u->is_active ? 'Aktif' : 'Nonaktif';
                                @endphp
                                <span class='status-badge {{ $class }}'>{{ $status }}</span>
                            </td>
                            <td>{{ $u->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn-sm btn-edit" title="Edit Pengguna">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    
                                    {{-- Form Delete (Laravel Way) --}}
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete" title="Hapus Pengguna">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
                </table>
            </div>
        </div>
      </div>
    </main>
  </div>

  {{-- Modal Tambah User --}}
  <div id="userModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah User Baru</h3>
            <button id="closeModalBtn" class="modal-close">&times;</button>
        </div>
        
        {{-- Form Tambah User (Mengarah ke Route Laravel) --}}
        <form id="tambahUserForm" action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" id="full_name" name="full_name" required value="{{ old('full_name') }}">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required value="{{ old('username') }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="patient" {{ old('role') == 'patient' ? 'selected' : '' }}>Patient</option>
                    <option value="counselor" {{ old('role') == 'counselor' ? 'selected' : '' }}>Counselor</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" id="batalBtn" class="btn btn-secondary">Batal</button>
                <button type="button" id="simpanUserBtn" class="btn btn-primary">Simpan User</button>
            </div>
        </form>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Script Search Table
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('userSearch');
        const table = document.getElementById('userTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();
            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let match = false;
                // Cek kolom Nama (1), Username (2), Email (3)
                if(cells.length > 0) { 
                    for (let j = 1; j < 4; j++) { 
                        if (cells[j] && cells[j].textContent.toLowerCase().includes(searchTerm)) {
                            match = true;
                            break;
                        }
                    }
                    row.style.display = match ? '' : 'none';
                }
            }
        });
    });

    // Script Modal
    const modal = document.getElementById('userModal');
    const openBtn = document.getElementById('tambahUserBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    const batalBtn = document.getElementById('batalBtn');
    function openModal() { modal.style.display = 'flex'; }
    function closeModal() { modal.style.display = 'none'; }
    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    batalBtn.addEventListener('click', closeModal);
    window.addEventListener('click', (event) => {
        if (event.target == modal) closeModal();
    });

    // Tampilkan modal jika ada Error Validasi Laravel
    @if($errors->any())
        openModal();
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            text: 'Mohon periksa inputan Anda.',
        });
    @endif

    // SweetAlert untuk Session Flash Laravel
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: '{{ session('error') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    @endif

    // Konfirmasi Hapus (Menyesuaikan Form Laravel)
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); 
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data pengguna ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#8b5cf6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form DELETE
                }
            });
        });
    });

    // Konfirmasi Simpan
    const tambahForm = document.getElementById('tambahUserForm');
    const simpanUserBtn = document.getElementById('simpanUserBtn');
    simpanUserBtn.addEventListener('click', function (event) {
        event.preventDefault(); 
        if (!tambahForm.checkValidity()) {
            tambahForm.reportValidity();
        } else {
            Swal.fire({
                title: 'Tambahkan User Baru?',
                text: "Pastikan data yang dimasukkan sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#8b5cf6',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, tambahkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    tambahForm.submit();
                }
            });
        }
    });
</script>

</body>
</html>