<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCare - Laporan & Analitik</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        .date-filter { 
            padding: 10px 14px; 
            border-radius: 8px; 
            border: 1px solid #e2e8f0; 
            font-family: 'Inter', sans-serif; 
            font-size: 14px; 
            color: #334155; 
        }
        
        .report-table-container { 
            overflow-x: auto; 
        }
        
        .report-table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        
        .report-table th, .report-table td { 
            padding: 16px; 
            text-align: left; 
            border-bottom: 1px solid #f1f5f9; 
            font-size: 14px; 
            vertical-align: middle; 
        }
        
        .report-table th { 
            font-size: 12px; 
            font-weight: 600; 
            color: #94a3b8; 
            text-transform: uppercase; 
            background: #f8fafc; 
        }
        
        .report-table tbody tr:hover { 
            background: #f8fafc; 
        }
        
        .status-badge { 
            padding: 4px 12px; 
            border-radius: 6px; 
            font-size: 12px; 
            font-weight: 600; 
            text-transform: capitalize; 
        }
        
        .status-badge.status-scheduled, 
        .status-badge.status-dijadwalkan { 
            background: #dbeafe; 
            color: #1e40af; 
        }
        
        .status-badge.status-pending, 
        .status-badge.status-menunggu { 
            background: #fef3c7; 
            color: #92400e; 
        }
        
        .status-badge.status-completed, 
        .status-badge.status-selesai { 
            background: #d1fae5; 
            color: #065f46; 
        }
        
        .status-badge.status-cancelled, 
        .status-badge.status-dibatalkan { 
            background: #fee2e2; 
            color: #991b1b; 
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
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-section">
                        <div class="nav-section-title">Menu Utama</div>
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('user.dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
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
                                <a href="{{ route('chat.index') }}" class="nav-link {{ Request::is('chat') ? 'active' : '' }}">
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
                                <a href="{{ route('laporan') }}" class="nav-link active">
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
                                <a href="{{ route('logout') }}" class="nav-link" style="color: #ef4444;">
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
                        <h1>Laporan & Analitik</h1>
                        <p>Pantau performa dan tren layanan konseling.</p>
                    </div>
                    <div class="header-actions">
                        <input type="month" class="date-filter" value="{{ date('Y-m') }}">
                        <a href="#" class="btn btn-primary" onclick="window.print();">
                            <i class="fas fa-download"></i> Export PDF
                        </a>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <section class="stats-grid fade-in">
                    <div class="stat-card">
                        <div class="stat-icon" style="background:#ede9fe; color:#7c3aed;">
                            <i class="fas fa-video"></i>
                        </div>
                        <div class="stat-value">{{ $totalSessions ?? 0 }}</div>
                        <div class="stat-label">Total Sesi</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background:#dcfce7; color:#16a34a;">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="stat-value">{{ $newPatients ?? 0 }}</div>
                        <div class="stat-label">Pasien Baru Bulan Ini</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background:#fef3c7; color:#d97706;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-value">{{ $avgDuration ? $avgDuration.' Menit' : '-' }}</div>
                        <div class="stat-label">Rata-rata Durasi</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background:#dbeafe; color:#2563eb;">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-value">{{ $avgRating ? $avgRating.'/5.0' : '-' }}</div>
                        <div class="stat-label">Rating Kepuasan</div>
                    </div>
                </section>

                <div class="card fade-in">
                    <div class="card-header">
                        <h3 class="chart-title">Detail Sesi Terakhir</h3>
                    </div>
                    <div class="card-body report-table-container">
                        <table class="report-table">
                            <thead>
                                <tr>
                                    <th>ID Sesi</th>
                                    <th>Nama Pasien</th>
                                    <th>Tanggal</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reports as $r)
                                <tr>
                                    <td>S{{ str_pad($r['id'], 5, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $r['patient_name'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r['appointment_date'])->translatedFormat('d M Y') }}</td>
                                    <td>{{ $r['duration'] ? $r['duration'].' Menit' : '-' }}</td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($r['status']) }}">
                                            {{ ucfirst($r['status']) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px; color: #64748b;">
                                        Tidak ada data sesi.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>