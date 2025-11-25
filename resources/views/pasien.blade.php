<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - MindCare</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* --- Layout Dasar (Sama dengan Dashboard) --- */
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        .dashboard-container { display: flex; min-height: 100vh; }
        
        .sidebar { width: 280px; background: #ffffff; color: #1e293b; padding: 24px 0; border-right: 1px solid #e2e8f0; position: fixed; height: 100vh; overflow-y: auto; z-index: 100; }
        .logo { padding: 0 24px 24px; margin-bottom: 24px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 12px; }
        .logo-icon { width: 42px; height: 42px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; flex-shrink: 0; }
        .logo-text { display: flex; flex-direction: column; }
        .logo-title { font-size: 18px; font-weight: 700; color: #0f172a; letter-spacing: -0.5px; line-height: 1.2; }
        .logo-subtitle { font-size: 11px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }

        .nav-menu { list-style: none; padding: 0; }
        .nav-section { margin-bottom: 24px; padding: 0 12px; }
        .nav-section ul { list-style: none; padding: 0; }
        .nav-section-title { font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.8px; padding: 0 12px 8px; margin-bottom: 4px; }
        .nav-item { margin-bottom: 4px; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 10px 12px; color: #64748b; text-decoration: none; border-radius: 8px; transition: all 0.2s ease; font-weight: 500; font-size: 14px; }
        .nav-link:hover { background: #f8fafc; color: #8b5cf6; }
        .nav-link.active { background: #f5f3ff; color: #8b5cf6; font-weight: 600; }
        .nav-link i { font-size: 18px; width: 20px; text-align: center; }

        .main-content { flex: 1; margin-left: 280px; background: #f8fafc; padding: 30px 40px; min-height: 100vh; }

        /* --- STYLE PROFIL USER --- */
        .page-header { margin-bottom: 30px; }
        .page-title { font-size: 24px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0; }
        .page-subtitle { color: #64748b; font-size: 14px; }

        /* Card Utama */
        .profile-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        /* Bagian Header Profil (Foto & Nama) */
        .profile-header-section {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 40px;
        }
        
        .avatar-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            background-color: #e2e8f0;
            border: 4px solid #f8fafc;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        .profile-name h2 {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 4px 0;
        }

        .profile-id {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        /* Grid Informasi */
        .section-label {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 Kolom sesuai gambar */
            gap: 24px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 40px;
            margin-bottom: 40px;
        }

        .info-item label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .info-item p {
            font-size: 15px;
            color: #334155;
            font-weight: 500;
            margin: 0;
        }

        .medical-notes {
            font-size: 15px;
            color: #334155;
            line-height: 1.6;
        }

        /* Fade In Animation */
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
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
                                <a href="{{ url('/dashboard') }}" class="nav-link">
                                    <i class="fas fa-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/pasien') }}" class="nav-link active">
                                    <i class="fas fa-users"></i>
                                    <span>Profil Pasien</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/jadwal') }}" class="nav-link">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Jadwal Konseling</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/chat') }}" class="nav-link">
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
            <div class="page-header fade-in">
                <h1 class="page-title">Profil Pasien</h1>
                <p class="page-subtitle">Detail informasi pasien yang terdaftar</p>
            </div>

            <div class="profile-card fade-in">
                
                <div class="profile-header-section">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($patient->full_name) }}&background=random&size=128" alt="Avatar" class="avatar-circle">
                    
                    <div class="profile-name">
                        <h2>{{ $patient->full_name }}</h2>
                        <div class="profile-id">ID Pasien: P{{ str_pad($patient->id, 3, '0', STR_PAD_LEFT) }}</div>
                    </div>
                </div>

                <div class="section-label">Informasi Pribadi</div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>USERNAME</label>
                        <p>{{ $patient->username }}</p>
                    </div>
                    <div class="info-item">
                        <label>EMAIL</label>
                        <p>{{ $patient->email }}</p>
                    </div>
                    <div class="info-item">
                        <label>TELEPON</label>
                        <p>{{ $patient->phone ?? '-' }}</p>
                    </div>
                    <div class="info-item">
                        <label>ALAMAT</label>
                        <p>{{ $patient->address ?? '-' }}</p>
                    </div>
                </div>

                <div class="section-label">Catatan Medis</div>
                <div class="medical-notes">
                    Belum ada catatan medis.
                </div>

            </div>
        </main>
    </div>
</body>
</html>