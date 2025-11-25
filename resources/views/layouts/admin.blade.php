<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Panel') - MindCare</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  
  <style>
<style>
    /* --- Reset & Base --- */
    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
    
    /* Sidebar Styling */
    .sidebar { width: 260px; padding: 24px 0; border-right: 1px solid #f1f5f9; background: white; height: 100vh; position: fixed; overflow-y: auto; z-index: 100; }
    .logo { padding: 0 24px 30px 24px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 20px; }
    .logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 22px; }
    .logo-text { display: flex; flex-direction: column; }
    .logo-title { font-weight: 800; font-size: 18px; color: #1e293b; line-height: 1.2; }
    .logo-subtitle { font-size: 10px; color: #94a3b8; font-weight: 600; letter-spacing: 0.5px; }

    /* Nav Menu */
    .nav-menu { list-style: none; padding: 0 16px; }
    .nav-section-title { font-size: 11px; font-weight: 700; color: #94a3b8; margin-bottom: 8px; padding-left: 12px; letter-spacing: 0.5px; margin-top: 20px; }
    .nav-section-title:first-child { margin-top: 0; }
    .nav-link { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; color: #64748b; font-weight: 500; font-size: 14px; transition: all 0.2s; margin-bottom: 4px; text-decoration: none; }
    .nav-link i { font-size: 18px; width: 20px; text-align: center; }
    .nav-link.active { background-color: #f5f3ff; color: #7c3aed; font-weight: 600; }
    .nav-link:hover:not(.active) { background-color: #f8fafc; color: #1e293b; }

    /* Layout Adjustment */
    .dashboard-container { display: flex; min-height: 100vh; }
    .main-content { flex: 1; margin-left: 260px; display: flex; flex-direction: column; background-color: #f8fafc; }
    
    /* Header */
    .header { background: transparent; padding: 0; }
    .header-top { 
        padding: 30px 40px; 
        display: flex; 
        justify-content: space-between; 
        align-items: flex-start; /* Header Rata Atas */
        background: white;
        border-bottom: 1px solid #f1f5f9;
    }
    .welcome-text h1 { font-size: 24px; color: #1e293b; font-weight: 700; margin: 0 0 4px 0; }
    .welcome-text p { color: #64748b; font-size: 14px; margin: 0; }

    /* Content Wrapper (PERBAIKAN DI SINI: HAPUS CENTER) */
    .content-wrapper { 
        padding: 30px 40px; 
        width: 100%; /* Full Width */
        /* Hapus max-width dan margin auto agar tidak ke tengah */
    }
</style>
  @stack('styles')
</head>
<body>
  <div class="dashboard-container">
    
    <aside class="sidebar">
      <div class="logo">
          <div class="logo-icon"><i class="fa-solid fa-brain"></i></div>
          <div class="logo-text">
              <span class="logo-title">MindCare</span>
              <span class="logo-subtitle">ADMIN PANEL</span>
          </div>
      </div>
      <nav>
        <ul class="nav-menu">
            <li class="nav-section">
                <div class="nav-section-title">MANAJEMEN ADMIN</div>
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-gauge-high"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pasien') }}" class="nav-link {{ request()->routeIs('admin.pasien') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-injured"></i><span>Manajemen Pasien</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pengguna') }}" class="nav-link {{ request()->routeIs('admin.pengguna') ? 'active' : '' }}">
                            <i class="fa-solid fa-users-gear"></i><span>Manajemen Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.sistem') }}" class="nav-link {{ request()->routeIs('admin.sistem') ? 'active' : '' }}">
                            <i class="fa-solid fa-sliders"></i><span>Manajemen Sistem</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-section">
                <div class="nav-section-title" style="margin-top: 20px;">AKUN</div>
                <ul>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}" class="nav-link" style="color: #64748b;">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i><span>Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
      </nav>
    </aside>

    <main class="main-content" style="flex: 1; display: flex; flex-direction: column;">
      <header class="header fade-in">
        <div class="header-top">
            <div class="welcome-text">
                <h1 style="font-size: 24px; color: #1e293b; margin-bottom: 4px; font-weight: 700;">@yield('header-title')</h1>
                <p style="color: #64748b; font-size: 14px;">@yield('header-subtitle')</p>
            </div>
            <div class="header-actions">
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
  <script>
    @if(session('success')) Swal.fire('Berhasil!', '{{ session('success') }}', 'success'); @endif
    @if(session('error')) Swal.fire('Gagal!', '{{ session('error') }}', 'error'); @endif
  </script>
  @stack('scripts')
</body>
</html>