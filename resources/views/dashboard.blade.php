<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MindCare</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%238b5cf6' d='M384 96c0-53-43-96-96-96l-16 0c-26.8 0-51.7 11.2-69.6 31.4L192 43.6c-2.2-2.4-5.5-3.6-8.8-3.3C114.5 46 64 103.6 64 172.7V176c0 10.7 2.7 20.8 7.5 29.7C30.7 224.4 4.3 266.1 5.1 312.6c1 55.8 44.2 101.8 99.5 106.8c1.8 .2 3.7 .3 5.5 .3h6.4c8.8 0 16-7.2 16-16s-7.2-16-16-16h-6.4c-1.3 0-2.6-.1-3.9-.2C68.8 384.2 37.8 351.3 37.1 311.2c-.6-34 19.5-64.8 50.9-78.1c7.8-3.3 12.2-12 10.7-20.3c-2.9-16.6-4.7-33.7-4.7-51.3v-1.5c0-55 37-102.6 89-110.2c1.6-.2 3.1-.8 4.4-1.7l23.9-16.6c11.6-8 25.3-12.3 39.4-12.3l13.3 0c35.3 0 64 28.7 64 64v8.7c0 10.5-3.1 20.7-8.8 29.3l-10.7 16c-5.5 8.3-6.2 19-1.8 27.9s13.4 14.3 23.4 14.3h5.4c45.2 0 83.7 29.5 94.6 72.4c2.6 10.1 13 16.2 23.1 13.6s16.2-13 13.6-23.1C450.2 201 390.8 160 320.6 160h-5.4l10.7-16c14.4-21.6 22-47 22-72.9V62.3c56.6 15.6 98 67.4 98 127.7v2c0 67.7-50.9 123.6-118 130c-10.4 1-17.9 10.3-16.9 20.7s10.3 17.9 20.7 16.9c86-8.2 151.2-81.4 151.2-167.6v-2C496 117.9 448 60.2 384 48.3v47.7zM192 160c0-17.7-14.3-32-32-32s-32 14.3-32 32v1.5c0 32.7 9.3 63.3 25.6 89.8c3.1 5 9 7.4 14.6 6l20-4.8c10.3-2.5 16.6-12.9 14.1-23.2s-12.9-16.6-23.2-14.1l-6.8 1.6C164.4 201.5 160 182.1 160 161.5V160zm32 128c-17.7 0-32 14.3-32 32s14.3 32 32 32h1.5c20.6 0 40-4.4 57.7-12.3l4.8-2.1c10.3-4.6 15-16.7 10.4-27s-16.7-15-27-10.4l-4.8 2.1c-12.9 5.7-27.1 8.8-41.8 8.8H224V288zm64 64c0 17.7 14.3 32 32 32h1.5c25.8 0 50-7.3 71-20.2l3.9-2.4c9.5-5.8 12.4-18.2 6.6-27.7s-18.2-12.4-27.7-6.6l-3.9 2.4c-14.9 9.1-32.1 14.3-50.4 14.3H319.5v1.5c0-17.7-14.3-32-32-32s-32 14.3-32 32v30.5c0 43.3 13.1 83.7 35.8 117.3l2.8 4.2c6.1 9.1 18.5 11.6 27.6 5.5s11.6-18.5 5.5-27.6l-2.8-4.2C309.4 443.9 300.9 414.7 300.9 384H320z'/%3E%3C/svg%3E">
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