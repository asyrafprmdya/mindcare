<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    // =========================================
    // 1. LOGIN ADMIN
    // =========================================
    public function showLogin() {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request) {
        $request->validate(['username' => 'required', 'password' => 'required']);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'role' => 'admin', 'is_active' => 1])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Login Gagal. Pastikan Anda adalah Admin.');
    }

    // =========================================
    // 2. DASHBOARD ADMIN
    // =========================================
    public function dashboard() {
        if (Auth::user()->role !== 'admin') return redirect('/');

        $totalUsers = User::count();
        $totalPatients = User::where('role', 'patient')->count();
        
        // Cek tabel agar tidak error jika belum ada
        $totalAppointments = Schema::hasTable('appointments') ? DB::table('appointments')->count() : 0;
        $totalReviews = Schema::hasTable('ratings_reviews') ? DB::table('ratings_reviews')->count() : 0;

        // Variabel stats ini dipanggil di view admin/dashboard.blade.php sebagai $stats['...']
        $stats = [
            'total_users' => $totalUsers,
            'total_patients' => $totalPatients,
            'total_appointments' => $totalAppointments,
            'total_reviews' => $totalReviews
        ];

        $users = User::orderBy('created_at', 'desc')->limit(10)->get();

        $activities = [];
        if (Schema::hasTable('activity_logs')) {
             $activities = DB::table('activity_logs')
                ->leftJoin('users', 'activity_logs.user_id', '=', 'users.id')
                ->select('activity_logs.action', 'users.username', 'activity_logs.created_at')
                ->orderBy('activity_logs.created_at', 'desc')
                ->limit(5)
                ->get();
        }

        return view('admin.dashboard', compact('stats', 'users', 'activities', 'totalUsers', 'totalPatients', 'totalAppointments', 'totalReviews'));
    }

    // =========================================
    // 3. MANAJEMEN PENGGUNA
    // =========================================
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

        User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => 1
        ]);

        return back()->with('success', 'User berhasil ditambahkan.');
    }

    public function destroyPengguna($id) {
        if (Auth::id() == $id) return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        User::destroy($id);
        return back()->with('success', 'User berhasil dihapus.');
    }

    // =========================================
    // 4. MANAJEMEN PASIEN
    // =========================================
    public function pasien() {
        $patients = DB::table('users')
            ->leftJoin('patients', 'users.id', '=', 'patients.user_id')
            ->where('users.role', 'patient')
            ->select('users.id as user_id', 'users.*', 'patients.date_of_birth', 'patients.address')
            ->orderBy('users.created_at', 'desc')
            ->get();

        return view('admin.pasien', compact('patients'));
    }

    public function storePasien(Request $request) {
        $request->validate(['username' => 'required|unique:users', 'email' => 'required|email|unique:users']);
        
        DB::transaction(function () use ($request) {
            $user = User::create([
                'full_name' => $request->full_name, 'username' => $request->username,
                'email' => $request->email, 'password' => Hash::make($request->password),
                'phone' => $request->phone, 'role' => 'patient', 'is_active' => 1
            ]);
            Patient::create(['user_id' => $user->id, 'date_of_birth' => $request->date_of_birth, 'address' => $request->address]);
        });

        return back()->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function updatePasien(Request $request, $id) {
        DB::transaction(function () use ($request, $id) {
            $user = User::findOrFail($id);
            $user->update(['full_name' => $request->full_name, 'phone' => $request->phone, 'is_active' => $request->is_active]);
            Patient::updateOrCreate(['user_id' => $id], ['date_of_birth' => $request->date_of_birth, 'address' => $request->address]);
        });
        return back()->with('success', 'Data pasien diperbarui.');
    }

    public function destroyPasien($id) {
        User::destroy($id);
        return back()->with('success', 'Data pasien dihapus.');
    }

    // =========================================
    // 5. MANAJEMEN SISTEM
    // =========================================
    public function sistem() {
        $settings = ['site_name' => 'MindCare', 'admin_email' => 'admin@mindcare.com', 'maintenance_mode' => false, 'default_role' => 'patient', 'allow_registration' => true];
        return view('admin.manajemen', compact('settings'));
    }

    public function updateSistem(Request $request) {
        return back()->with('success', 'Pengaturan disimpan (Simulasi).');
    }
}