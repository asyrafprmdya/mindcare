<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Patient;

class AdminController extends Controller
{
    // =========================================================================
    // 1. AUTHENTICATION (LOGIN)
    // =========================================================================
    
    public function showLogin() {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required', 
            'password' => 'required'
        ]);
        
        // Cek kredensial dan pastikan role admin & aktif
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'role' => 'admin', 'is_active' => 1])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        
        return back()->with('error', 'Login Gagal. Pastikan Anda Admin dan akun aktif.');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // =========================================================================
    // 2. DASHBOARD
    // =========================================================================

    public function dashboard() {
        if (Auth::user()->role !== 'admin') return redirect('/');

        $totalUsers = User::count();
        $totalPatients = User::where('role', 'patient')->count();
        // Cek tabel dulu untuk menghindari error jika tabel belum dimigrasi
        $totalAppointments = Schema::hasTable('appointments') ? DB::table('appointments')->count() : 0;
        $totalReviews = Schema::hasTable('ratings_reviews') ? DB::table('ratings_reviews')->count() : 0;

        $users = User::orderBy('created_at', 'desc')->limit(10)->get();

        $activities = [];
        if (Schema::hasTable('activity_logs')) {
             $activities = DB::table('activity_logs')
                ->leftJoin('users', 'activity_logs.user_id', '=', 'users.id')
                ->select('activity_logs.action', 'users.username', 'activity_logs.created_at')
                ->orderBy('activity_logs.created_at', 'desc')
                ->limit(5)->get();
        }

        return view('admin.dashboard', compact('totalUsers', 'totalPatients', 'totalAppointments', 'totalReviews', 'users', 'activities'));
    }

    // =========================================================================
    // 3. MANAJEMEN PENGGUNA (User Umum)
    // =========================================================================

    public function pengguna() {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.pengguna', compact('users'));
    }

    public function storePengguna(Request $request) {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);
        
        DB::transaction(function () use ($request) {
            // 1. Buat User baru
            $user = User::create([
                'full_name' => $request->full_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'is_active' => 1
            ]);

            // 2. LOGIKA OTOMATIS: Jika role 'patient', buat data kosong di tabel patients
            if ($request->role === 'patient') {
                Patient::create([
                    'user_id' => $user->id
                    // Data lain (phone, gender, dll) null dulu, diisi nanti di menu Pasien
                ]);
            }
        });

        return back()->with('success', 'User berhasil ditambahkan.');
    }

    public function destroyPengguna($id) {
        if (Auth::id() == $id) return back()->with('error', 'Tidak bisa hapus akun sendiri.');
        
        // Hapus user (Data pasien otomatis terhapus karena ON DELETE CASCADE di database)
        User::destroy($id);
        
        return back()->with('success', 'User dihapus.');
    }

    // =========================================================================
    // 4. MANAJEMEN PASIEN (Detail Lengkap)
    // =========================================================================

    public function pasien() {
        // Menggabungkan tabel users dan patients untuk menampilkan data lengkap
        $patients = DB::table('users')
            ->leftJoin('patients', 'users.id', '=', 'patients.user_id')
            ->where('users.role', 'patient')
            ->select(
                'users.id as user_id', 
                'users.full_name',
                'users.username',
                'users.email',
                'users.is_active',
                'users.created_at',
                // Data Spesifik Pasien
                'patients.phone',
                'patients.date_of_birth',
                'patients.gender',
                'patients.address',
                'patients.medical_history',
                'patients.emergency_contact'
            )
            ->orderBy('users.created_at', 'desc')
            ->get();
            
        return view('admin.pasien', compact('patients'));
    }

    public function storePasien(Request $request) {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'full_name' => 'required',
            'password' => 'required|min:6'
        ]);
        
        DB::transaction(function () use ($request) {
            // 1. Simpan Login Info ke tabel USERS
            $user = User::create([
                'full_name' => $request->full_name, 
                'username' => $request->username, 
                'email' => $request->email, 
                'password' => Hash::make($request->password),
                'role' => 'patient', 
                'is_active' => 1
            ]);
            
            // 2. Simpan Detail Medis ke tabel PATIENTS
            Patient::create([
                'user_id' => $user->id, 
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth, 
                'gender' => $request->gender,
                'address' => $request->address,
                'medical_history' => $request->medical_history,
                'emergency_contact' => $request->emergency_contact
            ]);
        });

        return back()->with('success', 'Pasien baru berhasil ditambahkan.');
    }

    public function updatePasien(Request $request, $id) {
        DB::transaction(function () use ($request, $id) {
            // 1. Update tabel USERS
            $user = User::findOrFail($id);
            $user->update([
                'full_name' => $request->full_name, 
                'is_active' => $request->is_active
            ]);
            
            // 2. Update/Create tabel PATIENTS
            // updateOrCreate berguna jika user lama belum punya data di tabel patients
            Patient::updateOrCreate(
                ['user_id' => $id], 
                [
                    'phone' => $request->phone,
                    'date_of_birth' => $request->date_of_birth, 
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'medical_history' => $request->medical_history,
                    'emergency_contact' => $request->emergency_contact
                ]
            );
        });

        return back()->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroyPasien($id) {
        User::destroy($id);
        return back()->with('success', 'Data pasien dihapus.');
    }

    // =========================================================================
    // 5. MANAJEMEN SISTEM
    // =========================================================================

    public function sistem() {
        $settings = [
            'site_name' => 'MindCare', 
            'admin_email' => 'admin@mindcare.com', 
            'maintenance_mode' => false, 
            'allow_registration' => true
        ];
        return view('admin.manajemen', compact('settings'));
    }

    public function updateSistem(Request $request) {
        // Logika simpan pengaturan (bisa dikembangkan nanti)
        return back()->with('success', 'Pengaturan disimpan.');
    }
}