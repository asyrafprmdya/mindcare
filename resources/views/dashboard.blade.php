<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCare - Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
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
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-section">
                        <div class="nav-section-title">Menu Utama</div>
                        <ul>
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                                    <i class="fas fa-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-users"></i>
                                    <span>Profil Pasien</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Jadwal Konseling</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/chat') }}" class="nav-link {{ Request::is('chat') ? 'active' : '' }}">
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
                                <a href="{{ url('/laporan') }}" class="nav-link">
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
                        <p>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }} - Ringkasan aktivitas klinik.</p>
                    </div>
                    <div class="header-actions">
                        <a href="{{ url('/chat') }}" class="btn btn-primary">
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
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> 12%</div>
                        </div>
                        <div class="stat-value">{{ $stats['total_patients'] }}</div>
                        <div class="stat-label">Total Pasien</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> 8%</div>
                        </div>
                        <div class="stat-value">{{ $stats['today_sessions'] }}</div>
                        <div class="stat-label">Sesi Hari Ini</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-trend trend-down"><i class="fas fa-arrow-down"></i> 3%</div>
                        </div>
                        <div class="stat-value">{{ $stats['pending_sessions'] }}</div>
                        <div class="stat-label">Menunggu</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #ede9fe; color: #7c3aed;">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> 5%</div>
                        </div>
                        <div class="stat-value">{{ $stats['satisfaction_rate'] }}%</div>
                        <div class="stat-label">Kepuasan</div>
                    </div>
                </section>

                <section class="content-grid fade-in">
                    
                    <div class="activity-feed">
                        <div class="card-header">
                            <h3 class="chart-title">Aktivitas Terkini</h3>
                            <a href="#" class="card-action">Lihat Semua <i class="fas fa-arrow-right"></i></a>
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
                            <h3>Jadwal Hari Ini</h3>
                            <a href="#" class="card-action">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="card-body">
                            @forelse($todayAppointments as $appt)
                                <div class="appointment-card">
                                    <div class="appointment-header">
                                        <span class="patient-name">{{ $appt['patient_name'] }}</span>
                                        <span class="appointment-time">
                                            <i class="far fa-clock"></i>
                                            {{ \Carbon\Carbon::parse($appt['start_time'])->format('H:i') }}
                                        </span>
                                    </div>
                                    <div class="appointment-details">
                                        <span class="appointment-status status-{{ $appt['status'] }}">
                                            {{ ucfirst($appt['status']) }}
                                        </span>
                                        <span class="appointment-type">Konseling</span>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-calendar-times"></i>
                                    <p>Tidak ada jadwal hari ini</p>
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