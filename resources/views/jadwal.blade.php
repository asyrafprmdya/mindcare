<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Konseling - MindCare</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* --- Layout & Sidebar (Konsisten) --- */
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        .dashboard-container { display: flex; min-height: 100vh; }
        
        .sidebar { width: 260px; background: white; border-right: 1px solid #f1f5f9; padding: 24px 0; position: fixed; height: 100vh; z-index: 10; }
        .logo { padding: 0 24px 30px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid #f1f5f9; margin-bottom: 20px; }
        .logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; }
        .logo-text { display: flex; flex-direction: column; }
        .logo-title { font-weight: 800; font-size: 18px; color: #8b5cf6; }
        .logo-subtitle { font-size: 10px; color: #64748b; font-weight: 600; letter-spacing: 0.5px; }

        .nav-menu { list-style: none; padding: 0 16px; }
        .nav-section-title { font-size: 11px; font-weight: 700; color: #94a3b8; margin-bottom: 8px; padding-left: 12px; margin-top: 20px; }
        .nav-section-title:first-child { margin-top: 0; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; color: #64748b; font-weight: 500; font-size: 14px; text-decoration: none; transition: 0.2s; margin-bottom: 4px; }
        .nav-link:hover { background-color: #f8fafc; color: #8b5cf6; }
        .nav-link.active { background-color: #f5f3ff; color: #8b5cf6; font-weight: 600; }
        .nav-link i { width: 20px; text-align: center; font-size: 18px; }

        .main-content { flex: 1; margin-left: 260px; background: #f8fafc; padding: 30px 40px; min-height: 100vh; }

        /* --- STYLE KHUSUS JADWAL --- */
        .page-header { margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
        .page-title { font-size: 24px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0; }
        .page-subtitle { color: #64748b; font-size: 14px; }

        .section-title { font-size: 16px; font-weight: 700; color: #334155; margin-bottom: 16px; margin-top: 30px; }
        .section-title:first-child { margin-top: 0; }

        /* Kartu Jadwal */
        .schedule-card {
            background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px;
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 16px; transition: 0.2s;
        }
        .schedule-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-color: #cbd5e1; }

        .schedule-info { display: flex; align-items: center; gap: 20px; }
        
        .date-box {
            background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;
            width: 60px; height: 60px; display: flex; flex-direction: column;
            align-items: center; justify-content: center; text-align: center;
        }
        .date-day { font-size: 18px; font-weight: 700; color: #0f172a; line-height: 1; }
        .date-month { font-size: 11px; color: #64748b; text-transform: uppercase; margin-top: 2px; font-weight: 600; }

        .schedule-details h4 { margin: 0 0 4px 0; font-size: 16px; color: #0f172a; font-weight: 600; }
        .schedule-details p { margin: 0; font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 6px; }
        
        .schedule-status { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: capitalize; }
        .status-scheduled { background: #dbeafe; color: #1e40af; }
        .status-completed { background: #dcfce7; color: #166534; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }

        .btn-action { 
            padding: 8px 16px; border-radius: 8px; border: 1px solid #e2e8f0; background: white; 
            color: #0f172a; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none;
        }
        .btn-action:hover { background: #f8fafc; border-color: #cbd5e1; }

        .empty-state { padding: 40px; text-align: center; background: white; border-radius: 12px; border: 1px dashed #cbd5e1; color: #64748b; }

        /* Fade In Animation */
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
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
                    <li class="nav-section">
                        <div class="nav-section-title">MENU UTAMA</div>
                        <ul>
                            <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                            <li class="nav-item"><a href="{{ route('pasien.index') }}" class="nav-link"><i class="fas fa-users"></i><span>Profil Pasien</span></a></li>
                            <li class="nav-item"><a href="{{ route('jadwal.index') }}" class="nav-link active" style="background: #f5f3ff; color: #8b5cf6; font-weight: 600;"><i class="fas fa-calendar-alt"></i><span>Jadwal Konseling</span></a></li>
                            <li class="nav-item"><a href="{{ route('chat.index') }}" class="nav-link"><i class="fas fa-comments"></i><span>Chat Dokter AI</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-section">
                        <div class="nav-section-title">LAPORAN</div>
                        <ul><li class="nav-item"><a href="{{ url('/laporan') }}" class="nav-link"><i class="fas fa-file-alt"></i><span>Laporan</span></a></li></ul>
                    </li>
                    <li class="nav-section">
                        <div class="nav-section-title">AKUN</div>
                        <ul><li class="nav-item"><a href="{{ url('/logout') }}" class="nav-link" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li></ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="page-header fade-in">
                <div>
                    <h1 class="page-title">Jadwal Konseling</h1>
                    <p class="page-subtitle">Lihat jadwal sesi konsultasi Anda yang akan datang dan riwayat sesi.</p>
                </div>
                <button class="btn-action" style="background: #8b5cf6; color: white; border: none;">
                    <i class="fas fa-plus"></i> Buat Jadwal Baru
                </button>
            </div>

            <div class="content-wrapper fade-in">
                
                <div class="section-title">Jadwal Akan Datang</div>
                @forelse($upcomingSchedules as $s)
                <div class="schedule-card">
                    <div class="schedule-info">
                        <div class="date-box">
                            <span class="date-day">{{ \Carbon\Carbon::parse($s->date)->format('d') }}</span>
                            <span class="date-month">{{ \Carbon\Carbon::parse($s->date)->format('M') }}</span>
                        </div>
                        <div class="schedule-details">
                            <h4>Sesi Konseling AI</h4>
                            <p>
                                <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($s->date)->format('H:i') }} WIB
                                <span style="margin: 0 6px;">•</span>
                                <i class="far fa-hourglass"></i> {{ $s->duration ? $s->duration . ' Menit' : 'Estimasi 45 Menit' }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <span class="schedule-status status-scheduled">Terjadwal</span>
                        <a href="{{ route('chat.index') }}" class="btn-action" style="margin-left: 12px; border-color: #8b5cf6; color: #8b5cf6;">Masuk Sesi</a>
                    </div>
                </div>
                @empty
                <div class="empty-state" style="margin-bottom: 30px;">
                    <i class="far fa-calendar-check" style="font-size: 32px; margin-bottom: 10px;"></i>
                    <p>Belum ada jadwal konseling yang akan datang.</p>
                </div>
                @endforelse

                <div class="section-title">Riwayat Sesi</div>
                @forelse($pastSchedules as $s)
                <div class="schedule-card" style="opacity: 0.8;">
                    <div class="schedule-info">
                        <div class="date-box" style="background: #f1f5f9; color: #64748b;">
                            <span class="date-day">{{ \Carbon\Carbon::parse($s->date)->format('d') }}</span>
                            <span class="date-month">{{ \Carbon\Carbon::parse($s->date)->format('M') }}</span>
                        </div>
                        <div class="schedule-details">
                            <h4>Sesi Konseling AI</h4>
                            <p><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($s->date)->format('H:i') }} WIB</p>
                        </div>
                    </div>
                    <div>
                        <span class="schedule-status status-{{ $s->status == 'completed' ? 'completed' : 'cancelled' }}">
                            {{ $s->status == 'completed' ? 'Selesai' : 'Dibatalkan' }}
                        </span>
                        <a href="{{ url('/laporan') }}" class="btn-action" style="margin-left: 12px;">Lihat Hasil</a>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <p>Belum ada riwayat sesi.</p>
                </div>
                @endforelse

            </div>
        </main>
    </div>
</body>
</html>