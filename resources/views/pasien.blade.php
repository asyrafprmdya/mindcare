<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Pasien - MindCare</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        .patient-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; margin-top: 24px; }
        .patient-card { background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; transition: all 0.3s ease; }
        .patient-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.05); border-color: #8b5cf6; }
        .patient-header { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; }
        .patient-avatar { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 18px; }
        .patient-tags { display: flex; gap: 8px; margin-bottom: 20px; }
        .tag { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; }
        .tag-age { background: #f1f5f9; color: #475569; }
        .tag-diagnosis { background: #eff6ff; color: #3b82f6; }
        .patient-footer { display: flex; justify-content: space-between; border-top: 1px solid #f1f5f9; padding-top: 16px; font-size: 12px; color: #64748b; }
        .btn-detail { width: 100%; margin-top: 16px; background: white; border: 1px solid #e2e8f0; padding: 10px; border-radius: 8px; cursor: pointer; transition: 0.2s; font-weight: 600; color: #0f172a; }
        .btn-detail:hover { background: #f8fafc; border-color: #8b5cf6; color: #8b5cf6; }
        .search-box { background: white; padding: 10px 16px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; align-items: center; width: 300px; }
        .search-box input { border: none; outline: none; width: 100%; font-size: 14px; margin-left: 10px; }
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
                            <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                            <li class="nav-item"><a href="{{ url('/pasien') }}" class="nav-link active" style="background: #f5f3ff; color: #8b5cf6; font-weight: 600;"><i class="fas fa-users"></i><span>Profil Pasien</span></a></li>
                            <li class="nav-item"><a href="{{ url('/chat') }}" class="nav-link"><i class="fas fa-comments"></i><span>Chat Dokter AI</span></a></li>
                        </ul>
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
                    <div class="welcome-text"><h1>Daftar Pasien Anda</h1><p>Kelola data medis dan perkembangan pasien.</p></div>
                    <div class="header-actions" style="display:flex; gap:12px;">
                        <div class="search-box"><i class="fas fa-search" style="color: #94a3b8;"></i><input type="text" placeholder="Cari nama pasien..."></div>
                        <button class="btn btn-primary"><i class="fas fa-plus"></i> Pasien Baru</button>
                    </div>
                </div>
            </header>

            <div class="content-wrapper fade-in">
                <div class="patient-grid">
                    @foreach($patients as $p)
                    <div class="patient-card">
                        <div class="patient-header">
                            <div class="patient-avatar" style="background: {{ $p['color'] }}">{{ $p['initials'] }}</div>
                            <div><h3 style="margin:0; font-size:16px;">{{ $p['name'] }}</h3><p style="margin:0; font-size:13px; color:#64748b;">{{ $p['gender'] }}</p></div>
                        </div>
                        <div class="patient-tags">
                            <span class="tag tag-age"><i class="fas fa-birthday-cake"></i> {{ $p['age'] }} Thn</span>
                            <span class="tag tag-diagnosis">{{ $p['diagnosis'] }}</span>
                        </div>
                        <div class="patient-footer">
                            <div><span style="color: {{ $p['status'] == 'Active' ? '#10b981' : '#f59e0b' }}">● {{ $p['status'] }}</span></div>
                            <div><i class="far fa-clock"></i> {{ $p['last_session'] }}</div>
                        </div>
                        <button class="btn-detail">Lihat Rekam Medis</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</body>
</html>