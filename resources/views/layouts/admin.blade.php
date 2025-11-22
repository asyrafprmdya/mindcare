<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Panel') - MindCare</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  {{-- Slot untuk CSS tambahan per halaman --}}
  @stack('styles')
</head>
<body>
  <div class="dashboard-container">
    
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
                <div class="nav-section-title">Akun</div>
                <ul>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}" class="nav-link" style="color: #ef4444;">
                            <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                        </a>
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
                {{-- Judul Halaman Dinamis --}}
                <h1>@yield('header-title', 'Dashboard Admin')</h1>
                <p>@yield('header-subtitle', 'Selamat datang di panel admin.')</p>
            </div>
            <div class="header-actions">
                {{-- Tombol Aksi Dinamis (Misal: Tambah User) --}}
                @yield('header-actions')
            </div>
        </div>
      </header>

      <div class="content-wrapper">
         @yield('content')
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  {{-- Global Alert Script --}}
  <script>
    @if(session('success'))
        Swal.fire('Berhasil!', '{{ session('success') }}', 'success');
    @endif
    @if(session('error'))
        Swal.fire('Gagal!', '{{ session('error') }}', 'error');
    @endif
    @if($errors->any())
        Swal.fire('Error Validasi', '{{ $errors->first() }}', 'error');
    @endif
  </script>

  {{-- Slot untuk Script tambahan per halaman --}}
  @stack('scripts')
</body>
</html>