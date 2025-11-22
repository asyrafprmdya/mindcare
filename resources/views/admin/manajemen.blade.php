<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Sistem - MindCare</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <style>
      .toggle-switch { position: relative; display: inline-block; width: 50px; height: 28px; }
      .toggle-switch input { opacity: 0; width: 0; height: 0; }
      .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e1; transition: .4s; border-radius: 34px; }
      .slider:before { position: absolute; content: ""; height: 20px; width: 20px; left: 4px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%; }
      input:checked + .slider { background-color: #8b5cf6; }
      input:checked + .slider:before { transform: translateX(22px); }
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
                    <li class="nav-item"><a href="{{ route('admin.pasien') }}" class="nav-link"><i class="fas fa-users"></i><span>Manajemen Pasien</span></a></li>
                    <li class="nav-item"><a href="{{ route('admin.pengguna') }}" class="nav-link"><i class="fas fa-users-cog"></i><span>Manajemen Pengguna</span></a></li>
                    <li class="nav-item"><a href="{{ route('admin.sistem') }}" class="nav-link active"><i class="fas fa-cogs"></i><span>Manajemen Sistem</span></a></li>
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
            <div class="welcome-text"><h1>Manajemen Sistem</h1><p>Atur konfigurasi sistem.</p></div>
            <div class="header-actions">
                <button onclick="document.getElementById('settings-form').submit()" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>
      </header>

      <div class="content-wrapper">
        <form id="settings-form" method="POST" action="{{ route('admin.sistem.update') }}">
            @csrf
            <div class="content-grid">
                <div class="card fade-in">
                    <div class="card-header"><h3 class="chart-title">Pengaturan Umum</h3></div>
                    <div class="card-body">
                        <div class="form-group"><label>Nama Situs</label><input type="text" name="site_name" value="{{ $settings['site_name'] }}"></div>
                        <div class="form-group"><label>Email Admin</label><input type="email" name="admin_email" value="{{ $settings['admin_email'] }}"></div>
                        <div class="form-group">
                            <label>Mode Perbaikan</label>
                            <div style="display:flex; justify-content:space-between;">
                                <p style="font-size:13px; color:#64748b;">Aktifkan mode maintenance.</p>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="maintenance_mode" {{ $settings['maintenance_mode'] ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card fade-in">
                    <div class="card-header"><h3 class="chart-title">Registrasi</h3></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Peran Default</label>
                            <select name="default_role">
                                <option value="patient" {{ $settings['default_role'] == 'patient' ? 'selected' : '' }}>Patient</option>
                                <option value="counselor" {{ $settings['default_role'] == 'counselor' ? 'selected' : '' }}>Counselor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Izinkan Registrasi</label>
                             <div style="display:flex; justify-content:space-between;">
                                <p style="font-size:13px; color:#64748b;">Buka pendaftaran user baru.</p>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="allow_registration" {{ $settings['allow_registration'] ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>a
                    </div>
                </div>
            </div>
        </form>
      </div>
    </main>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    @if(session('success')) Swal.fire('Sukses', '{{ session('success') }}', 'success'); @endif
  </script>
</body>
</html>