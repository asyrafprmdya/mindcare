@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('header-title', 'Dashboard Admin')
@section('header-subtitle', 'Selamat datang kembali, ' . Auth::user()->full_name)

@section('header-actions')
    <a href="{{ route('admin.pengguna') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Tambah User</a>
@endsection

@section('content')
    <section class="stats-grid fade-in">
        {{-- NOTE: $stats adalah Array manual dari controller, jadi tetap pakai kurung siku [] --}}
        <div class="stat-card">
            <div class="stat-header"><div class="stat-icon" style="background:#ede9fe; color:#7c3aed;"><i class="fas fa-users"></i></div></div>
            <div class="stat-value">{{ $stats['total_users'] ?? 0 }}</div>
            <div class="stat-label">Total Pengguna</div>
        </div>
        <div class="stat-card">
            <div class="stat-header"><div class="stat-icon" style="background:#f5f3ff; color:#8b5cf6;"><i class="fas fa-user-injured"></i></div></div>
            <div class="stat-value">{{ $stats['total_patients'] ?? 0 }}</div>
            <div class="stat-label">Total Pasien</div>
        </div>
        <div class="stat-card">
            <div class="stat-header"><div class="stat-icon" style="background:#f5f3ff; color:#8b5cf6;"><i class="fas fa-calendar-check"></i></div></div>
            <div class="stat-value">{{ $stats['total_appointments'] ?? 0 }}</div>
            <div class="stat-label">Total Jadwal</div>
        </div>
        <div class="stat-card">
            <div class="stat-header"><div class="stat-icon" style="background:#f5f3ff; color:#8b5cf6;"><i class="fas fa-star"></i></div></div>
            <div class="stat-value">{{ $stats['total_reviews'] ?? 0 }}</div>
            <div class="stat-label">Total Ulasan</div>
        </div>
    </section>

    <section class="content-grid">
        <div class="card fade-in" style="background:white; border-radius:16px; border:1px solid #e2e8f0; overflow:hidden;">
            <div class="card-header"><h3 class="chart-title">Pengguna Baru</h3><a href="{{ route('admin.pengguna') }}" class="card-action">Lihat Semua</a></div>
            <div class="card-body report-table-container">
                <table class="report-table">
                <thead><tr><th>Nama</th><th>Role</th><th>Status</th></tr></thead>
                <tbody>
                    {{-- NOTE: $users adalah Object dari Database, jadi pakai tanda panah -> --}}
                    @forelse($users as $u)
                    <tr>
                        <td>{{ $u->full_name }}</td>
                        <td><span class="status-badge" style="background:#f3f4f6;">{{ ucfirst($u->role) }}</span></td>
                        <td><span class="status-badge {{ $u->is_active ? 'status-active' : 'status-inactive' }}">{{ $u->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="empty-state">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>

        <div class="activity-feed fade-in">
            <div class="card-header"><h3 class="chart-title">Aktivitas</h3></div>
            <div class="card-body">
                {{-- NOTE: $activities adalah Object, pakai tanda panah -> --}}
                @forelse($activities as $a)
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #ede9fe; color: #7c3aed;"><i class="fas fa-info-circle"></i></div>
                        <div class="activity-content">
                            <h4>{{ $a->action }}</h4>
                            <p>Oleh: {{ $a->username }}</p>
                            <div class="activity-time">{{ \Carbon\Carbon::parse($a->created_at)->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state"><p>Belum ada aktivitas.</p></div>
                @endforelse
            </div>
        </div>
    </section>
@endsection