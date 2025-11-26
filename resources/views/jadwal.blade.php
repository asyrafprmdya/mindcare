<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Konseling - MindCare</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%238b5cf6' d='M384 96c0-53-43-96-96-96l-16 0c-26.8 0-51.7 11.2-69.6 31.4L192 43.6c-2.2-2.4-5.5-3.6-8.8-3.3C114.5 46 64 103.6 64 172.7V176c0 10.7 2.7 20.8 7.5 29.7C30.7 224.4 4.3 266.1 5.1 312.6c1 55.8 44.2 101.8 99.5 106.8c1.8 .2 3.7 .3 5.5 .3h6.4c8.8 0 16-7.2 16-16s-7.2-16-16-16h-6.4c-1.3 0-2.6-.1-3.9-.2C68.8 384.2 37.8 351.3 37.1 311.2c-.6-34 19.5-64.8 50.9-78.1c7.8-3.3 12.2-12 10.7-20.3c-2.9-16.6-4.7-33.7-4.7-51.3v-1.5c0-55 37-102.6 89-110.2c1.6-.2 3.1-.8 4.4-1.7l23.9-16.6c11.6-8 25.3-12.3 39.4-12.3l13.3 0c35.3 0 64 28.7 64 64v8.7c0 10.5-3.1 20.7-8.8 29.3l-10.7 16c-5.5 8.3-6.2 19-1.8 27.9s13.4 14.3 23.4 14.3h5.4c45.2 0 83.7 29.5 94.6 72.4c2.6 10.1 13 16.2 23.1 13.6s16.2-13 13.6-23.1C450.2 201 390.8 160 320.6 160h-5.4l10.7-16c14.4-21.6 22-47 22-72.9V62.3c56.6 15.6 98 67.4 98 127.7v2c0 67.7-50.9 123.6-118 130c-10.4 1-17.9 10.3-16.9 20.7s10.3 17.9 20.7 16.9c86-8.2 151.2-81.4 151.2-167.6v-2C496 117.9 448 60.2 384 48.3v47.7zM192 160c0-17.7-14.3-32-32-32s-32 14.3-32 32v1.5c0 32.7 9.3 63.3 25.6 89.8c3.1 5 9 7.4 14.6 6l20-4.8c10.3-2.5 16.6-12.9 14.1-23.2s-12.9-16.6-23.2-14.1l-6.8 1.6C164.4 201.5 160 182.1 160 161.5V160zm32 128c-17.7 0-32 14.3-32 32s14.3 32 32 32h1.5c20.6 0 40-4.4 57.7-12.3l4.8-2.1c10.3-4.6 15-16.7 10.4-27s-16.7-15-27-10.4l-4.8 2.1c-12.9 5.7-27.1 8.8-41.8 8.8H224V288zm64 64c0 17.7 14.3 32 32 32h1.5c25.8 0 50-7.3 71-20.2l3.9-2.4c9.5-5.8 12.4-18.2 6.6-27.7s-18.2-12.4-27.7-6.6l-3.9 2.4c-14.9 9.1-32.1 14.3-50.4 14.3H319.5v1.5c0-17.7-14.3-32-32-32s-32 14.3-32 32v30.5c0 43.3 13.1 83.7 35.8 117.3l2.8 4.2c6.1 9.1 18.5 11.6 27.6 5.5s11.6-18.5 5.5-27.6l-2.8-4.2C309.4 443.9 300.9 414.7 300.9 384H320z'/%3E%3C/svg%3E">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* --- Layout & Sidebar (SAMA PERSIS DENGAN DASHBOARD) --- */
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .dashboard-container { display: flex; min-height: 100vh; width: 100%; }
        
        .sidebar { width: 260px; background: white; border-right: 1px solid #f1f5f9; padding: 24px 0; position: fixed; height: 100vh; z-index: 10; top: 0; left: 0; }
        
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

        /* --- Main Content (Full Width) --- */
        .main-content { 
            flex: 1; 
            margin-left: 260px; 
            background: #f8fafc; 
            min-height: 100vh; 
            width: calc(100% - 260px); 
            display: flex;
            flex-direction: column;
        }

        /* --- Styles Khusus Halaman Jadwal --- */
        .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; width: 100%; }
        .page-title { font-size: 24px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0; }
        .page-subtitle { color: #64748b; font-size: 14px; margin: 0; }

        .section-title { font-size: 16px; font-weight: 700; color: #334155; margin-bottom: 16px; margin-top: 30px; }
        .section-title:first-child { margin-top: 0; }

        /* Kartu Jadwal */
        .schedule-card {
            background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px;
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 16px; transition: 0.2s; width: 100%;
        }
        .schedule-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-color: #cbd5e1; }

        .schedule-info { display: flex; align-items: center; gap: 20px; }
        
        .date-box {
            background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;
            width: 60px; height: 60px; display: flex; flex-direction: column;
            align-items: center; justify-content: center; text-align: center; flex-shrink: 0;
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
            color: #0f172a; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block;
        }
        .btn-action:hover { background: #f8fafc; border-color: #cbd5e1; }

        .empty-state { padding: 40px; text-align: center; background: white; border-radius: 12px; border: 1px dashed #cbd5e1; color: #64748b; width: 100%; }

        /* Wrapper Konten & Header agar Rata */
        .header-top { padding: 30px 40px; width: 100%; box-sizing: border-box; }
        .content-wrapper { padding: 0 40px 40px 40px; width: 100%; box-sizing: border-box; flex: 1; }

        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; width: 100%; }
            .schedule-card { flex-direction: column; align-items: flex-start; gap: 15px; }
            .schedule-info { width: 100%; }
            .btn-action { width: 100%; text-align: center; margin-left: 0 !important; margin-top: 10px; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        
        <aside class="sidebar">
            <div class="logo">
                <div class="logo-icon" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                    <i class="fas fa-brain"></i>
                </div>
                <div class="logo-text">
                    <span class="logo-title" style="color: #8b5cf6;">MindCare</span>
                    <span class="logo-subtitle">PROFESSIONAL</span>
                </div>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-section">
                        <div class="nav-section-title">MENU UTAMA</div>
                        <ul>
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="fas fa-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pasien.index') }}" class="nav-link">
                                    <i class="fas fa-users"></i>
                                    <span>Profil Pasien</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jadwal.index') }}" class="nav-link active" style="background: #f5f3ff; color: #8b5cf6; font-weight: 600;">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Jadwal Konseling</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('chat.index') }}" class="nav-link">
                                    <i class="fas fa-comments"></i>
                                    <span>Chat Dokter AI</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-section">
                        <div class="nav-section-title">LAPORAN</div>
                        <ul>
                             <li class="nav-item">
                                <a href="{{ url('/laporan') }}" class="nav-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Laporan</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-section">
                        <div class="nav-section-title">AKUN</div>
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
            <div class="header-top fade-in">
                <div class="page-header" style="width: 100%; margin-bottom: 0;">
                    <div>
                        <h1 class="page-title">Jadwal Konseling</h1>
                        <p class="page-subtitle">Lihat jadwal sesi konsultasi Anda yang akan datang dan riwayat sesi.</p>
                    </div>
                    <button class="btn-action" style="background: #8b5cf6; color: white; border: none;">
                        <i class="fas fa-plus"></i> Buat Jadwal Baru
                    </button>
                </div>
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
                    <div style="display: flex; align-items: center;">
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