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
        /* --- LAYOUT GLOBAL (Sama dengan Dashboard) --- */
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .dashboard-container { display: flex; min-height: 100vh; width: 100%; }
        .sidebar { width: 260px; background: white; border-right: 1px solid #f1f5f9; padding: 24px 0; position: fixed; height: 100vh; z-index: 10; top: 0; left: 0; }
        
        /* Sidebar Elements */
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

        /* Main Content */
        .main-content { flex: 1; margin-left: 260px; background: #f8fafc; min-height: 100vh; width: calc(100% - 260px); display: flex; flex-direction: column; }
        .header-top { display: flex; justify-content: space-between; align-items: center; padding: 30px 40px; width: 100%; box-sizing: border-box; }
        .content-wrapper { padding: 0 40px 40px 40px; width: 100%; box-sizing: border-box; flex: 1; }

        /* --- PAGE HEADER & BUTTONS --- */
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; width: 100%; }
        .page-title { font-size: 24px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0; }
        .page-subtitle { color: #64748b; font-size: 14px; margin: 0; }

        .btn-create {
            background: #8b5cf6; color: white; border: none; padding: 12px 20px; border-radius: 8px; 
            font-weight: 600; font-size: 14px; cursor: pointer; text-decoration: none; display: inline-flex; 
            align-items: center; gap: 8px; width: fit-content; transition: 0.2s;
        }
        .btn-create:hover { background: #7c3aed; transform: translateY(-2px); }

        /* --- TABS SYSTEM (BARU) --- */
        .tabs { display: flex; gap: 20px; border-bottom: 1px solid #e2e8f0; margin-bottom: 24px; }
        .tab-btn {
            padding: 12px 0; background: none; border: none; font-size: 14px; font-weight: 600; 
            color: #64748b; cursor: pointer; position: relative; transition: 0.2s;
        }
        .tab-btn:hover { color: #8b5cf6; }
        .tab-btn.active { color: #8b5cf6; }
        .tab-btn.active::after {
            content: ''; position: absolute; bottom: -1px; left: 0; width: 100%; height: 2px; 
            background: #8b5cf6; border-radius: 2px 2px 0 0;
        }

        /* --- CARD JADWAL (REDESIGNED) --- */
        .schedule-card {
            background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px;
            margin-bottom: 20px; transition: 0.2s; width: 100%; display: flex; flex-direction: column; gap: 20px;
        }
        .schedule-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.04); border-color: #cbd5e1; }

        /* Card Header: Date & Status */
        .card-top { display: flex; justify-content: space-between; align-items: flex-start; }
        
        .date-badge {
            display: flex; align-items: center; gap: 12px;
        }
        .date-icon {
            width: 50px; height: 50px; background: #f5f3ff; color: #8b5cf6; border-radius: 12px;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            font-weight: 700; line-height: 1.1;
        }
        .date-day { font-size: 18px; }
        .date-month { font-size: 10px; text-transform: uppercase; }
        
        .session-meta h4 { margin: 0 0 4px 0; font-size: 16px; color: #0f172a; }
        .session-meta p { margin: 0; font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 6px; }

        .status-pill { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-scheduled { background: #eff6ff; color: #1e40af; }
        .status-completed { background: #f0fdf4; color: #166534; }
        .status-cancelled { background: #fef2f2; color: #991b1b; }

        /* Card Body: Counselor Info */
        .counselor-info {
            display: flex; align-items: center; gap: 12px; padding: 16px; 
            background: #f8fafc; border-radius: 12px; border: 1px solid #f1f5f9;
        }
        .counselor-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
        .counselor-details div { font-size: 14px; font-weight: 600; color: #334155; }
        .counselor-details span { font-size: 12px; color: #64748b; }

        /* Card Footer: Action Buttons */
        .card-actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: 4px; }
        
        .btn-action {
            padding: 10px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; 
            text-decoration: none; cursor: pointer; transition: 0.2s; border: 1px solid transparent;
            display: inline-flex; align-items: center; gap: 6px;
        }
        
        .btn-primary-soft { background: #8b5cf6; color: white; }
        .btn-primary-soft:hover { background: #7c3aed; }
        
        .btn-secondary-soft { background: white; border-color: #e2e8f0; color: #64748b; }
        .btn-secondary-soft:hover { background: #f8fafc; color: #0f172a; border-color: #cbd5e1; }
        
        .btn-danger-soft { color: #ef4444; background: white; }
        .btn-danger-soft:hover { background: #fef2f2; }

        .empty-state { padding: 60px; text-align: center; background: white; border-radius: 12px; border: 1px dashed #cbd5e1; color: #64748b; width: 100%; }
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; width: 100%; }
            .card-top { flex-direction: column; gap: 12px; }
            .status-pill { align-self: flex-start; }
            .card-actions { flex-direction: column; }
            .btn-action { width: 100%; justify-content: center; }
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
                            <li class="nav-item"><a href="{{ route('pasien.index') }}" class="nav-link"><i class="fas fa-users"></i><span>Profil Pasien</span></a></li>
                            <li class="nav-item"><a href="{{ route('jadwal.index') }}" class="nav-link active" style="background: #f5f3ff; color: #8b5cf6; font-weight: 600;"><i class="fas fa-calendar-alt"></i><span>Jadwal Konseling</span></a></li>
                            <li class="nav-item"><a href="{{ route('chat.index') }}" class="nav-link"><i class="fas fa-comments"></i><span>Chat Dokter AI</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-section"><div class="nav-section-title">LAPORAN</div>
                        <ul><li class="nav-item"><a href="{{ url('/laporan') }}" class="nav-link"><i class="fas fa-file-alt"></i><span>Laporan</span></a></li></ul>
                    </li>
                    <li class="nav-section"><div class="nav-section-title">AKUN</div>
                        <ul><li class="nav-item"><a href="{{ url('/logout') }}" class="nav-link" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li></ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header-top fade-in">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Jadwal Konseling</h1>
                        <p class="page-subtitle">Kelola sesi pertemuan Anda dengan konselor.</p>
                    </div>
                    <a href="{{ route('chat.index') }}" class="btn-create">
                        <i class="fas fa-plus"></i> Buat Jadwal Baru
                    </a>
                </div>
            </div>

            <div class="content-wrapper fade-in">
                
                <div class="tabs">
                    <button class="tab-btn active" onclick="switchTab('upcoming')">Akan Datang</button>
                    <button class="tab-btn" onclick="switchTab('history')">Riwayat Sesi</button>
                </div>

                <div id="upcoming-section">
                    @forelse($upcomingSchedules as $s)
                    <div class="schedule-card">
                        <div class="card-top">
                            <div class="date-badge">
                                <div class="date-icon">
                                    <span class="date-day">{{ \Carbon\Carbon::parse($s->date)->format('d') }}</span>
                                    <span class="date-month">{{ \Carbon\Carbon::parse($s->date)->format('M') }}</span>
                                </div>
                                <div class="session-meta">
                                    <h4>Sesi Konseling AI</h4>
                                    <p>
                                        <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($s->date)->format('H:i') }} WITA
                                        <span style="margin: 0 6px;">•</span>
                                        <i class="fas fa-video"></i> Video Call
                                    </p>
                                </div>
                            </div>
                            <span class="status-pill status-scheduled">Terjadwal</span>
                        </div>

                        <div class="counselor-info">
                            <img src="https://ui-avatars.com/api/?name=Dr+AI&background=random" alt="Chat" class="counselor-avatar">
                            <div class="counselor-details">
                                <div>Chatbot</div>
                                <span>Psikolog Klinis & Asisten Virtual</span>
                            </div>
                        </div>

                        <div class="card-actions">
                            <button class="btn-action btn-danger-soft">Batalkan</button>
                            <button class="btn-action btn-secondary-soft">Reschedule</button>
                            <a href="{{ route('chat.index') }}" class="btn-action btn-primary-soft">
                                <i class="fas fa-video"></i> Masuk Sesi
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="far fa-calendar-check" style="font-size: 48px; margin-bottom: 16px; opacity: 0.3;"></i>
                        <p>Tidak ada jadwal konseling yang akan datang.</p>
                    </div>
                    @endforelse
                </div>

                <div id="history-section" style="display: none;">
                    @forelse($pastSchedules as $s)
                    <div class="schedule-card" style="opacity: 0.9;">
                        <div class="card-top">
                            <div class="date-badge">
                                <div class="date-icon" style="background: #f1f5f9; color: #64748b;">
                                    <span class="date-day">{{ \Carbon\Carbon::parse($s->date)->format('d') }}</span>
                                    <span class="date-month">{{ \Carbon\Carbon::parse($s->date)->format('M') }}</span>
                                </div>
                                <div class="session-meta">
                                    <h4>Sesi Konseling AI</h4>
                                    <p><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($s->date)->format('H:i') }} WITA</p>
                                </div>
                            </div>
                            <span class="status-pill status-{{ $s->status == 'completed' ? 'completed' : 'cancelled' }}">
                                {{ $s->status == 'completed' ? 'Selesai' : 'Dibatalkan' }}
                            </span>
                        </div>

                        <div class="counselor-info" style="opacity: 0.7;">
                            <img src="https://ui-avatars.com/api/?name=Dr+AI&background=random" alt="" class="counselor-avatar">
                            <div class="counselor-details">
                                <div>Chatbot</div>
                                <span>Psikolog Klinis</span>
                            </div>
                        </div>

                        <div class="card-actions">
                            <button class="btn-action btn-secondary-soft">Beri Ulasan</button>
                            <a href="{{ url('/laporan') }}" class="btn-action btn-secondary-soft" style="border-color: #e2e8f0; color: #0f172a;">
                                <i class="fas fa-file-medical-alt"></i> Lihat Catatan
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="fas fa-history" style="font-size: 48px; margin-bottom: 16px; opacity: 0.3;"></i>
                        <p>Belum ada riwayat sesi.</p>
                    </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>

    <script>
        function switchTab(tabName) {
            // Sembunyikan semua section
            document.getElementById('upcoming-section').style.display = 'none';
            document.getElementById('history-section').style.display = 'none';
            
            // Reset tombol aktif
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

            // Tampilkan section yang dipilih & set aktif
            if (tabName === 'upcoming') {
                document.getElementById('upcoming-section').style.display = 'block';
                document.querySelector('.tab-btn:nth-child(1)').classList.add('active');
            } else {
                document.getElementById('history-section').style.display = 'block';
                document.querySelector('.tab-btn:nth-child(2)').classList.add('active');
            }
        }
    </script>
</body>
</html>