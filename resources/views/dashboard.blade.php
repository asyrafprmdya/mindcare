<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MindCare</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* --- PERBAIKAN LAYOUT FULL WIDTH --- */
        .header-top {
            max-width: none !important;
            width: 100% !important;
            padding: 24px 40px;
        }

        .content-wrapper {
            max-width: none !important;
            width: 100% !important;
            padding: 30px 40px;
            margin: 0 !important;
        }

        .main-content {
            width: calc(100% - 280px);
            margin-left: 280px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Grid Layout */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 30px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .content-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .main-content { width: 100%; margin-left: 0; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        
        <aside class="sidebar">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <div class="logo-text">
                    <span class="logo-title">MindCare</span>
                    <span class="logo-subtitle">Professional</span>
                </div>
            </div>
            
            <nav class="nav-scroll-area">
                <ul class="nav-menu">
                    <li class="nav-section">
                        <div class="nav-section-title">Menu Utama</div>
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    <i class="fas fa-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pasien.index') }}" class="nav-link {{ request()->routeIs('pasien.index') ? 'active' : '' }}">
                                    <i class="fas fa-users"></i>
                                    <span>Profil Pasien</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jadwal.index') }}" class="nav-link {{ request()->routeIs('jadwal.index') ? 'active' : '' }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Jadwal Konseling</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('chat.index') }}" class="nav-link {{ request()->routeIs('chat.index') ? 'active' : '' }}">
                                    <i class="fas fa-comments"></i>
                                    <span>Chat Dokter AI</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-section">
                        <div class="nav-section-title">Laporan</div>
                        <ul>
                             <li class="nav-item">
                                <a href="{{ url('/laporan') }}" class="nav-link {{ request()->is('laporan') ? 'active' : '' }}">
                                    <i class="fas fa-chart-bar"></i>
                                    <span>Laporan</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-section">
                        <div class="nav-section-title">Akun</div>
                        <ul>
                            <li class="nav-item">
                                <a href="{{ url('/logout') }}" class="nav-link" style="color: #ef4444;">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
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
                        <h1>Halo, {{ Auth::user()->full_name }} 👋</h1>
                        <p>{{ \Carbon\Carbon::now('Asia/Makassar')->translatedFormat('l, d F Y') }} - Ringkasan aktivitas Anda.</p>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('chat.index') }}" class="btn btn-primary">
                            <i class="fas fa-comment-medical"></i> Konsultasi AI
                        </a>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                
                <section class="stats-grid fade-in">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #dcfce7; color: #16a34a;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> +</div>
                        </div>
                        <div class="stat-value">{{ $stats['today_sessions'] ?? 0 }}</div>
                        <div class="stat-label">Total Sesi</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        </div>
                        <div class="stat-value">0</div>
                        <div class="stat-label">Jadwal Hari Ini</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-value">0</div>
                        <div class="stat-label">Menunggu</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #ede9fe; color: #7c3aed;">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                        <div class="stat-value">98%</div>
                        <div class="stat-label">Kepuasan</div>
                    </div>
                </section>

                <section class="content-grid fade-in">
                    
                    <div class="activity-feed">
                        <div class="card-header">
                            <h3 class="chart-title">Aktivitas Terkini</h3>
                        </div>
                        <div class="card-body">
                            @forelse($recentActivities as $activity)
                                <div class="activity-item">
                                    <div class="activity-icon" style="background: #dbeafe; color: #2563eb;">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="activity-content">
                                        <h4>{{ $activity['action'] }}</h4>
                                        <p>Oleh: {{ $activity['user_name'] }}</p>
                                        <div class="activity-time">
                                            {{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}
                                        </div>
                                    </div>  
                                </div>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>Belum ada aktivitas terkini</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="appointments-section">
                        <div class="card-header appointments-header">
                            <h3>Riwayat Konseling</h3>
                            <a href="{{ url('/laporan') }}" class="card-action">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="card-body" id="historyList">
                            @forelse($history as $h)
                                <div class="appointment-card">
                                    <div class="appointment-header">
                                        <span class="patient-name">{{ $h->diagnosis ?? 'Konsultasi AI' }}</span>
                                        <span class="appointment-time">
                                            <i class="far fa-clock"></i>
                                            {{ \Carbon\Carbon::parse($h->date)->format('d M, H:i') }}
                                        </span>
                                    </div>
                                    <div class="appointment-details">
                                        <span class="appointment-status status-{{ strtolower($h->status) }}">
                                            {{ ucfirst($h->status) }}
                                        </span>
                                        <span class="appointment-type">Sesi Chat</span>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-history"></i>
                                    <p>Belum ada riwayat konseling</p>
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