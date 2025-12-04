<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
    public function updatePengguna(Request $request, $id) {
        $user = User::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'username'  => 'required|string|unique:users,username,'.$id, // Abaikan unique untuk diri sendiri
            'email'     => 'required|email|unique:users,email,'.$id,     // Abaikan unique untuk diri sendiri
            'role'      => 'required',
            'is_active' => 'required' // Kita perlu ambil status dari form
        ]);

        $data = [
            'full_name' => $request->full_name,
            'username'  => $request->username,
            'email'     => $request->email,
            'role'      => $request->role,
            'is_active' => $request->is_active,
        ];

        // Hanya update password jika field diisi (tidak kosong)
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Data pengguna berhasil diperbarui.');
    }
    public function sistem() {
        $settings = ['site_name' => 'MindCare', 'admin_email' => 'admin@mindcare.com', 'maintenance_mode' => false, 'default_role' => 'patient', 'allow_registration' => true];
        return view('admin.manajemen', compact('settings'));
    }

    public function updateSistem(Request $request) {
        return back()->with('success', 'Pengaturan disimpan (Simulasi).');
    }
}