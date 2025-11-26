<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Sistem - MindCare</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%238b5cf6' d='M384 96c0-53-43-96-96-96l-16 0c-26.8 0-51.7 11.2-69.6 31.4L192 43.6c-2.2-2.4-5.5-3.6-8.8-3.3C114.5 46 64 103.6 64 172.7V176c0 10.7 2.7 20.8 7.5 29.7C30.7 224.4 4.3 266.1 5.1 312.6c1 55.8 44.2 101.8 99.5 106.8c1.8 .2 3.7 .3 5.5 .3h6.4c8.8 0 16-7.2 16-16s-7.2-16-16-16h-6.4c-1.3 0-2.6-.1-3.9-.2C68.8 384.2 37.8 351.3 37.1 311.2c-.6-34 19.5-64.8 50.9-78.1c7.8-3.3 12.2-12 10.7-20.3c-2.9-16.6-4.7-33.7-4.7-51.3v-1.5c0-55 37-102.6 89-110.2c1.6-.2 3.1-.8 4.4-1.7l23.9-16.6c11.6-8 25.3-12.3 39.4-12.3l13.3 0c35.3 0 64 28.7 64 64v8.7c0 10.5-3.1 20.7-8.8 29.3l-10.7 16c-5.5 8.3-6.2 19-1.8 27.9s13.4 14.3 23.4 14.3h5.4c45.2 0 83.7 29.5 94.6 72.4c2.6 10.1 13 16.2 23.1 13.6s16.2-13 13.6-23.1C450.2 201 390.8 160 320.6 160h-5.4l10.7-16c14.4-21.6 22-47 22-72.9V62.3c56.6 15.6 98 67.4 98 127.7v2c0 67.7-50.9 123.6-118 130c-10.4 1-17.9 10.3-16.9 20.7s10.3 17.9 20.7 16.9c86-8.2 151.2-81.4 151.2-167.6v-2C496 117.9 448 60.2 384 48.3v47.7zM192 160c0-17.7-14.3-32-32-32s-32 14.3-32 32v1.5c0 32.7 9.3 63.3 25.6 89.8c3.1 5 9 7.4 14.6 6l20-4.8c10.3-2.5 16.6-12.9 14.1-23.2s-12.9-16.6-23.2-14.1l-6.8 1.6C164.4 201.5 160 182.1 160 161.5V160zm32 128c-17.7 0-32 14.3-32 32s14.3 32 32 32h1.5c20.6 0 40-4.4 57.7-12.3l4.8-2.1c10.3-4.6 15-16.7 10.4-27s-16.7-15-27-10.4l-4.8 2.1c-12.9 5.7-27.1 8.8-41.8 8.8H224V288zm64 64c0 17.7 14.3 32 32 32h1.5c25.8 0 50-7.3 71-20.2l3.9-2.4c9.5-5.8 12.4-18.2 6.6-27.7s-18.2-12.4-27.7-6.6l-3.9 2.4c-14.9 9.1-32.1 14.3-50.4 14.3H319.5v1.5c0-17.7-14.3-32-32-32s-32 14.3-32 32v30.5c0 43.3 13.1 83.7 35.8 117.3l2.8 4.2c6.1 9.1 18.5 11.6 27.6 5.5s11.6-18.5 5.5-27.6l-2.8-4.2C309.4 443.9 300.9 414.7 300.9 384H320z'/%3E%3C/svg%3E">
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
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
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
                        </div>
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