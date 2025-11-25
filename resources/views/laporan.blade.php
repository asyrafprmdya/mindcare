<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Catatan Medis - MindCare</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        /* --- PERBAIKAN LAYOUT FULL WIDTH (Sama seperti Jadwal & Dashboard) --- */
        
        /* 1. Main Content mengisi sisa ruang */
        .main-content {
            flex: 1;
            margin-left: 260px; /* Memberi ruang untuk sidebar */
            background: #f8fafc;
            min-height: 100vh;
            width: calc(100% - 260px); /* Memaksa lebar penuh */
            display: flex;
            flex-direction: column;
        }

        /* 2. Header Full Width */
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 40px;
            width: 100%; 
            box-sizing: border-box;
            max-width: none !important; /* Override style global */
        }

        /* 3. Content Wrapper Full Width */
        .content-wrapper {
            padding: 0 40px 40px 40px;
            width: 100%; 
            box-sizing: border-box;
            flex: 1;
            max-width: none !important; /* Override style global */
            margin: 0 !important;
        }

        /* --- STYLE KHUSUS LAPORAN --- */
        .report-card {
            background: white; border: 1px solid #e2e8f0; border-radius: 12px; 
            padding: 24px; margin-bottom: 20px; transition: 0.2s;
            width: 100%; /* Kartu melebar penuh */
        }
        .report-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        
        .report-header { 
            display: flex; justify-content: space-between; align-items: flex-start; 
            border-bottom: 1px solid #f1f5f9; padding-bottom: 16px; margin-bottom: 16px; 
        }
        
        .session-date { font-weight: 700; color: #1e293b; font-size: 16px; display: flex; align-items: center; gap: 8px; }
        .session-id { font-size: 12px; color: #94a3b8; font-weight: 400; background: #f8fafc; padding: 2px 8px; border-radius: 4px; }
        
        .report-status { 
            padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: capitalize; 
        }
        .status-completed { background: #dcfce7; color: #166534; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }
        
        .report-body { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        
        .report-section h4 { 
            font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; 
        }
        .report-text { font-size: 14px; color: #334155; line-height: 1.6; }
        
        .diagnosis-box { 
            background: #eff6ff; border-left: 4px solid #3b82f6; padding: 12px; border-radius: 4px; margin-bottom: 16px; 
        }
        .diagnosis-title { color: #1e40af; font-weight: 700; font-size: 13px; margin-bottom: 4px; }
        
        /* Stats Grid Kecil */
        .mini-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 30px; width: 100%; }
        .mini-card { background: white; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center; width: 100%; }
        .mini-value { font-size: 20px; font-weight: 700; color: #1e293b; }
        .mini-label { font-size: 12px; color: #64748b; margin-top: 4px; }

        .empty-state { 
            padding: 60px; 
            text-align: center; 
            background: white; 
            border-radius: 12px; 
            border: 1px dashed #cbd5e1; /* Ubah jadi dashed biar kelihatan area kosongnya */
            width: 100%; /* Pastikan lebar penuh */
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { width: 100%; margin-left: 0; }
            .report-body { grid-template-columns: 1fr; }
            .mini-stats { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        
        <aside class="sidebar">
            <div class="logo">
                <div class="logo-icon" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);"><i class="fas fa-brain"></i></div>
                <div class="logo-text"><span class="logo-title" style="color: #8b5cf6;">MindCare</span><span class="logo-subtitle">PROFESSIONAL</span></div>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-section"><div class="nav-section-title">MENU UTAMA</div>
                        <ul>
                            <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                            <li class="nav-item"><a href="{{ url('/pasien') }}" class="nav-link"><i class="fas fa-users"></i><span>Profil Pasien</span></a></li>
                            <li class="nav-item"><a href="{{ url('/jadwal') }}" class="nav-link"><i class="fas fa-calendar-alt"></i><span>Jadwal Konseling</span></a></li>
                            <li class="nav-item"><a href="{{ url('/chat') }}" class="nav-link"><i class="fas fa-comments"></i><span>Chat Dokter AI</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-section"><div class="nav-section-title">LAPORAN</div>
                        <ul><li class="nav-item"><a href="{{ url('/laporan') }}" class="nav-link active" style="background: #f5f3ff; color: #8b5cf6; font-weight: 600;"><i class="fas fa-file-medical-alt"></i><span>Laporan Sesi</span></a></li></ul>
                    </li>
                    <li class="nav-section"><div class="nav-section-title">AKUN</div>
                        <ul><li class="nav-item"><a href="{{ url('/logout') }}" class="nav-link" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li></ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header fade-in">
                <div class="header-top">
                    <div class="welcome-text">
                        <h1>Catatan Medis & Laporan</h1>
                        <p>Riwayat hasil konsultasi dan perkembangan kesehatan Anda.</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-primary" onclick="window.print()">
                            <i class="fas fa-print"></i> Cetak Laporan
                        </button>
                    </div>
                </div>
            </header>

            <div class="content-wrapper fade-in">
                
                <div class="mini-stats">
                    <div class="mini-card">
                        <div class="mini-value">{{ $stats['total_sessions'] }}</div>
                        <div class="mini-label">Total Sesi</div>
                    </div>
                    <div class="mini-card">
                        <div class="mini-value">{{ $stats['completed'] }}</div>
                        <div class="mini-label">Sesi Selesai</div>
                    </div>
                    <div class="mini-card">
                        <div class="mini-value">{{ $stats['avg_duration'] }} Menit</div>
                        <div class="mini-label">Rata-rata Durasi</div>
                    </div>
                    <div class="mini-card">
                        <div class="mini-value">{{ $stats['last_visit'] }}</div>
                        <div class="mini-label">Kunjungan Terakhir</div>
                    </div>
                </div>

                <h3 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 20px;">Riwayat Konsultasi</h3>

                @forelse($reports as $report)
                <div class="report-card">
                    <div class="report-header">
                        <div>
                            <div class="session-date">
                                <i class="far fa-calendar-alt" style="color: #8b5cf6;"></i>
                                {{ \Carbon\Carbon::parse($report->date)->translatedFormat('l, d F Y - H:i') }}
                                <span class="session-id">ID: #{{ $report->id }}</span>
                            </div>
                            <div style="font-size: 13px; color: #64748b; margin-top: 4px;">
                                Durasi: {{ $report->duration }} Menit
                            </div>
                        </div>
                        <span class="report-status status-{{ $report->status }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </div>

                    <div class="report-body">
                        <div>
                            <div class="diagnosis-box">
                                <div class="diagnosis-title">Diagnosis / Kesimpulan</div>
                                <div style="font-size: 14px; color: #1e3a8a;">
                                    {{ $report->diagnosis ?? 'Belum ada diagnosis.' }}
                                </div>
                            </div>
                            
                            <div class="report-section">
                                <h4>Catatan Sesi</h4>
                                <p class="report-text">
                                    {{ $report->notes ?? 'Tidak ada catatan tambahan.' }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <div class="report-section">
                                <h4>Saran / Tindakan Lanjutan</h4>
                                <div style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px dashed #cbd5e1;">
                                    <p class="report-text" style="font-style: italic; color: #475569;">
                                        "{{ $report->prescription ?? 'Tidak ada saran khusus.' }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="fas fa-file-medical-alt" style="font-size: 48px; color: #cbd5e1; margin-bottom: 16px;"></i>
                    <p style="color: #64748b; font-size: 15px;">Belum ada riwayat konsultasi yang tercatat.</p>
                </div>
                @endforelse

            </div>
        </main>
    </div>
</body>
</html>