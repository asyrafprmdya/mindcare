<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - MindCare</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <style>
    .report-table { width: 100%; border-collapse: collapse; }
    .report-table th, .report-table td { padding: 16px; text-align: left; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
    .report-table th { font-size: 12px; font-weight: 600; color: #94a3b8; text-transform: uppercase; background: #f8fafc; }
    .status-badge { padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-transform: capitalize; }
    .status-active { background: #dcfce7; color: #166534; }
    .status-inactive { background: #fee2e2; color: #991b1b; }
  </style>
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
                    <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link active"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-users"></i><span>Manajemen Pasien</span></a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-users-cog"></i><span>Manajemen Pengguna</span></a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cogs"></i><span>Manajemen Sistem</span></a></li>
                </ul>
            </li>
            <li class="nav-section">
                <div class="nav-section-title">Akun</div>
                <ul>
                    <li class="nav-item"><a href="{{ url('/logout') }}" class="nav-link" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
                </ul>
            </li>
        </ul>
      </nav>
    </aside>

    <main class="main-content">
      <header class="header fade-in">
        <div class="header-top">
            <div class="welcome-text">
                <h1>Dashboard Admin</h1>
                <p>Selamat datang kembali, {{ Auth::user()->full_name }}!</p>
            </div>
            <div class="header-actions">
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> <span>Tambah User Baru</span>
                </a>
            </div>
        </div>
      </header>

      <div class="content-wrapper">
        
        <section class="stats-grid fade-in">
          <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background:#ede9fe; color:#7c3aed;"><i class="fas fa-users"></i></div>
                </div>
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-label">Total Pengguna</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background:#f5f3ff; color:#8b5cf6;"><i class="fas fa-user-injured"></i></div>
                </div>
                <div class="stat-value">{{ $totalPatients }}</div>
                <div class="stat-label">Total Pasien</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background:#f5f3ff; color:#8b5cf6;"><i class="fas fa-calendar-check"></i></div>
                </div>
                <div class="stat-value">{{ $totalAppointments }}</div>
                <div class="stat-label">Total Jadwal</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background:#f5f3ff; color:#8b5cf6;"><i class="fas fa-star"></i></div>
                </div>
                <div class="stat-value">{{ $totalReviews }}</div>
                <div class="stat-label">Total Ulasan</div>
            </div>
        </section>

        <section class="content-grid">
            
            <div class="card fade-in" style="background:white; border-radius:16px; border:1px solid #e2e8f0; overflow:hidden;">
                <div class="card-header">
                    <h3 class="chart-title">Pengguna Baru (10 Terbaru)</h3>
                    <a href="#" style="font-size: 13px; font-weight: 600; color: #8b5cf6;">Lihat Semua</a>
                </div>
                <div class="card-body" style="padding:0;">
                    <div style="overflow-x:auto;">
                        <table class="report-table">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $u)
                            <tr>
                                <td>{{ $u->id }}</td>
                                <td style="font-weight:600;">{{ $u->full_name }}</td>
                                <td>
                                    <span class="status-badge" style="background:#f3f4f6;">{{ ucfirst($u->role) }}</span>
                                </td>
                                <td>
                                    @if($u->is_active)
                                        <span class="status-badge status-active">Aktif</span>
                                    @else
                                        <span class="status-badge status-inactive">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="empty-state" style="text-align:center; padding:20px;">Tidak ada data pengguna.</td></tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="activity-feed fade-in">
                <div class="card-header">
                    <h3 class="chart-title">Aktivitas Terbaru</h3>
                </div>
                <div class="card-body">
                    @forelse($activities as $a)
                        <div class="activity-item">
                            <div class="activity-icon" style="background: #ede9fe; color: #7c3aed;">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="activity-content">
                                <h4>{{ $a->action ?? 'Action' }}</h4>
                                <p>Oleh: <strong>{{ $a->username ?? 'Sistem' }}</strong></p>
                                <div class="activity-time">{{ \Carbon\Carbon::parse($a->created_at ?? now())->diffForHumans() }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>Tidak ada aktivitas terbaru.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
      </div>
    </main>
  </div>
</body>
</html>