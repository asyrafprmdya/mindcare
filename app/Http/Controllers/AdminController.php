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
    public function showLogin() {
        if (Auth::check() && Auth::user()->role === 'admin') return redirect()->route('admin.dashboard');
        return view('admin.login');
    }

    public function login(Request $request) {
        $request->validate(['username' => 'required', 'password' => 'required']);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'role' => 'admin', 'is_active' => 1])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error', 'Login Gagal. Cek kredensial Anda.');
    }

    public function dashboard() {
        if (Auth::user()->role !== 'admin') return redirect('/');
        
        $totalUsers = User::count();
        $totalPatients = User::where('role', 'patient')->count();
        $totalAppointments = Schema::hasTable('appointments') ? DB::table('appointments')->count() : 0;
        $totalReviews = Schema::hasTable('ratings_reviews') ? DB::table('ratings_reviews')->count() : 0;
        
        $users = User::orderBy('created_at', 'desc')->limit(10)->get();
        $activities = []; // Placeholder activity log

        return view('admin.dashboard', compact('totalUsers', 'totalPatients', 'totalAppointments', 'totalReviews', 'users', 'activities'));
    }

    public function pengguna() {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.pengguna', compact('users'));
    }

    public function storePengguna(Request $request) {
        $request->validate(['username' => 'required|unique:users', 'email' => 'required|unique:users']);
        User::create([
            'full_name' => $request->full_name, 'username' => $request->username,
            'email' => $request->email, 'password' => Hash::make($request->password),
            'role' => $request->role, 'is_active' => 1
        ]);
        return back()->with('success', 'User berhasil ditambahkan.');
    }

    public function destroyPengguna($id) {
        if (Auth::id() == $id) return back()->with('error', 'Tidak bisa hapus akun sendiri.');
        User::destroy($id);
        return back()->with('success', 'User dihapus.');
    }

    public function pasien() {
        $patients = DB::table('users')
            ->leftJoin('patients', 'users.id', '=', 'patients.user_id')
            ->where('users.role', 'patient')
            ->select('users.id as user_id', 'users.*', 'patients.date_of_birth', 'patients.address')
            ->orderBy('users.created_at', 'desc')->get();
        return view('admin.pasien', compact('patients'));
    }

    public function storePasien(Request $request) {
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
        return back()->with('success', 'Data pasien diupdate.');
    }

    public function destroyPasien($id) {
        User::destroy($id);
        return back()->with('success', 'Pasien dihapus.');
    }

    public function sistem() {
        $settings = ['site_name' => 'MindCare', 'admin_email' => 'admin@mindcare.com', 'maintenance_mode' => false];
        return view('admin.manajemen', compact('settings'));
    }

    public function updateSistem(Request $request) {
        return back()->with('success', 'Pengaturan disimpan.');
    }
}