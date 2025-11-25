@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header-title', 'Dashboard Admin')
@section('header-subtitle', 'Selamat datang kembali, admin!')

@section('header-actions')
    <a href="{{ route('admin.pengguna') }}" class="btn btn-primary" style="background: #8b5cf6; color: white; border-radius: 8px; padding: 12px 20px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s;">
        <i class="fa-solid fa-plus"></i> Tambah User Baru
    </a>
@endsection

@section('content')
    <style>
        /* --- GRID LAYOUT --- */
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

        /* --- STAT CARDS (Rata Kiri) --- */
        .stat-card { 
            background: white; 
            border: 1px solid #e2e8f0; 
            border-radius: 12px; 
            padding: 24px; 
            display: flex; 
            flex-direction: column; 
            align-items: flex-start; /* Kiri */
            justify-content: flex-start; 
            text-align: left; /* Kiri */
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); border-color: #cbd5e1; }

        .stat-icon { 
            width: 48px; height: 48px; 
            border-radius: 12px; 
            display: flex; align-items: center; justify-content: center; 
            font-size: 20px; 
            margin-bottom: 20px; 
        }
        /* Warna Ikon Ungu Muda */
        .bg-icon { background: #f3e8ff; color: #7c3aed; }

        .stat-value { 
            font-size: 32px; 
            font-weight: 700; 
            color: #1e293b; 
            margin-bottom: 4px; 
            line-height: 1; 
        }

        .stat-label { font-size: 14px; color: #64748b; font-weight: 500; }

        /* --- CARD CONTAINER --- */
        .card { 
            background: white; 
            border: 1px solid #e2e8f0; 
            border-radius: 12px; 
            overflow: hidden; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.02); 
        }
        
        .card-header { 
            padding: 20px 24px; 
            border-bottom: 1px solid #f1f5f9; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            background: white;
        }
        
        .chart-title { font-size: 16px; font-weight: 700; color: #1e293b; margin: 0; }
        .see-all { font-size: 13px; color: #7c3aed; font-weight: 600; text-decoration: none; }
        .see-all:hover { text-decoration: underline; }
        
        /* --- TABLE STYLES (Rata Kiri) --- */
        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table th { 
            text-align: left; /* Header Kiri */
            padding: 16px 24px; 
            font-size: 11px; 
            font-weight: 700; 
            color: #94a3b8; 
            text-transform: uppercase; 
            background: #ffffff; /* Putih polos sesuai gambar */
            border-bottom: 1px solid #f1f5f9; 
            letter-spacing: 0.5px;
        }
        .custom-table td { 
            text-align: left; /* Isi Kiri */
            padding: 16px 24px; 
            font-size: 14px; 
            color: #334155; 
            border-bottom: 1px solid #f1f5f9; 
            font-weight: 500;
            vertical-align: middle;
        }
        .custom-table tr:last-child td { border-bottom: none; }
        
        /* --- BADGES --- */
        .badge { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block; }
        
        /* Role Colors */
        .badge-patient { background: #dbeafe; color: #1e40af; } /* Biru */
        .badge-admin { background: #f3e8ff; color: #7e22ce; }   /* Ungu */
        .badge-counselor { background: #ffedd5; color: #c2410c; } /* Orange */

        /* Status Colors */
        .badge-active { background: #dcfce7; color: #166534; } /* Hijau */
        .badge-inactive { background: #fee2e2; color: #991b1b; } /* Merah */
        
        /* --- ACTIVITY FEED --- */
        .empty-activities { height: 250px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 14px; font-weight: 500; }
        
        /* RESPONSIVE */
        @media (max-width: 1200px) { 
            .stats-grid { grid-template-columns: 1fr 1fr; } 
            .content-grid { grid-template-columns: 1fr; } 
        }
        @media (max-width: 768px) { 
            .stats-grid { grid-template-columns: 1fr; } 
        }
    </style>

    <div class="stats-grid fade-in">
        <div class="stat-card">
            <div class="stat-icon bg-icon"><i class="fa-solid fa-users"></i></div>
            <div class="stat-value">{{ $stats['total_users'] ?? 0 }}</div>
            <div class="stat-label">Total Pengguna</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-icon"><i class="fa-solid fa-user-injured"></i></div>
            <div class="stat-value">{{ $stats['total_patients'] ?? 0 }}</div>
            <div class="stat-label">Total Pasien</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-icon"><i class="fa-solid fa-calendar-days"></i></div>
            <div class="stat-value">{{ $stats['total_appointments'] ?? 0 }}</div>
            <div class="stat-label">Total Jadwal Sesi</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-icon"><i class="fa-solid fa-star"></i></div>
            <div class="stat-value">{{ $stats['total_reviews'] ?? 0 }}</div>
            <div class="stat-label">Total Ulasan</div>
        </div>
    </div>

    <div class="content-grid fade-in">
        <div class="card">
            <div class="card-header">
                <h3 class="chart-title">Pengguna Baru (10 Terbaru)</h3>
                <a href="{{ route('admin.pengguna') }}" class="see-all">Lihat Semua</a>
            </div>
            <div class="card-body" style="padding: 0;">
                <div style="overflow-x: auto;">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">NO</th>
                                <th>NAMA LENGKAP</th>
                                <th>ROLE</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $u)
                            <tr>
                                <td style="font-weight: 600; color: #64748b;">{{ $loop->iteration }}</td>
                                <td style="font-weight: 500; color: #1e293b;">{{ $u->full_name }}</td>
                                <td>
                                    <span class="badge badge-{{ $u->role }}">
                                        {{ ucfirst($u->role) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $u->is_active ? 'badge-active' : 'badge-inactive' }}">
                                        {{ $u->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 40px; color: #94a3b8;">
                                    Belum ada data pengguna.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="chart-title">Aktivitas Terbaru</h3>
            </div>
            <div class="card-body">
                @if(count($activities) > 0)
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach($activities as $a)
                        <li style="padding: 16px 0; border-bottom: 1px solid #f1f5f9; display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 36px; height: 36px; background: #f8fafc; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #7c3aed; flex-shrink: 0;">
                                <i class="fa-solid fa-info-circle" style="font-size: 16px;"></i>
                            </div>
                            <div>
                                <div style="font-size: 14px; font-weight: 600; color: #1e293b; margin-bottom: 2px;">{{ $a->action }}</div>
                                <div style="font-size: 12px; color: #64748b;">
                                    Oleh: {{ $a->username }} <br>
                                    <span style="font-size: 11px; color: #94a3b8;">{{ \Carbon\Carbon::parse($a->created_at)->diffForHumans() }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div class="empty-activities">
                        Tidak ada aktivitas terbaru.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection