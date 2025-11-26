<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Catatan Medis - MindCare</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%238b5cf6' d='M384 96c0-53-43-96-96-96l-16 0c-26.8 0-51.7 11.2-69.6 31.4L192 43.6c-2.2-2.4-5.5-3.6-8.8-3.3C114.5 46 64 103.6 64 172.7V176c0 10.7 2.7 20.8 7.5 29.7C30.7 224.4 4.3 266.1 5.1 312.6c1 55.8 44.2 101.8 99.5 106.8c1.8 .2 3.7 .3 5.5 .3h6.4c8.8 0 16-7.2 16-16s-7.2-16-16-16h-6.4c-1.3 0-2.6-.1-3.9-.2C68.8 384.2 37.8 351.3 37.1 311.2c-.6-34 19.5-64.8 50.9-78.1c7.8-3.3 12.2-12 10.7-20.3c-2.9-16.6-4.7-33.7-4.7-51.3v-1.5c0-55 37-102.6 89-110.2c1.6-.2 3.1-.8 4.4-1.7l23.9-16.6c11.6-8 25.3-12.3 39.4-12.3l13.3 0c35.3 0 64 28.7 64 64v8.7c0 10.5-3.1 20.7-8.8 29.3l-10.7 16c-5.5 8.3-6.2 19-1.8 27.9s13.4 14.3 23.4 14.3h5.4c45.2 0 83.7 29.5 94.6 72.4c2.6 10.1 13 16.2 23.1 13.6s16.2-13 13.6-23.1C450.2 201 390.8 160 320.6 160h-5.4l10.7-16c14.4-21.6 22-47 22-72.9V62.3c56.6 15.6 98 67.4 98 127.7v2c0 67.7-50.9 123.6-118 130c-10.4 1-17.9 10.3-16.9 20.7s10.3 17.9 20.7 16.9c86-8.2 151.2-81.4 151.2-167.6v-2C496 117.9 448 60.2 384 48.3v47.7zM192 160c0-17.7-14.3-32-32-32s-32 14.3-32 32v1.5c0 32.7 9.3 63.3 25.6 89.8c3.1 5 9 7.4 14.6 6l20-4.8c10.3-2.5 16.6-12.9 14.1-23.2s-12.9-16.6-23.2-14.1l-6.8 1.6C164.4 201.5 160 182.1 160 161.5V160zm32 128c-17.7 0-32 14.3-32 32s14.3 32 32 32h1.5c20.6 0 40-4.4 57.7-12.3l4.8-2.1c10.3-4.6 15-16.7 10.4-27s-16.7-15-27-10.4l-4.8 2.1c-12.9 5.7-27.1 8.8-41.8 8.8H224V288zm64 64c0 17.7 14.3 32 32 32h1.5c25.8 0 50-7.3 71-20.2l3.9-2.4c9.5-5.8 12.4-18.2 6.6-27.7s-18.2-12.4-27.7-6.6l-3.9 2.4c-14.9 9.1-32.1 14.3-50.4 14.3H319.5v1.5c0-17.7-14.3-32-32-32s-32 14.3-32 32v30.5c0 43.3 13.1 83.7 35.8 117.3l2.8 4.2c6.1 9.1 18.5 11.6 27.6 5.5s11.6-18.5 5.5-27.6l-2.8-4.2C309.4 443.9 300.9 414.7 300.9 384H320z'/%3E%3C/svg%3E">
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