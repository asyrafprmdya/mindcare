<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AuthController extends Controller
{
    // --- LOGIN & REGISTER ---
    public function showLogin() {
        if (Auth::check()) return redirect('/dashboard');
        return view('index');
    }

    public function login(Request $request) {
        $credentials = $request->validate(['username' => 'required', 'password' => 'required']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Cek jika admin login di form biasa, arahkan ke admin
            if (Auth::user()->role === 'admin') return redirect()->route('admin.dashboard');
            return redirect()->intended('/dashboard');
        }
        return back()->with('error', 'Username atau password salah.');
    }

    public function showRegister() { return view('register'); }

    public function register(Request $request) {
        $request->validate([
            'full_name' => 'required', 'username' => 'required|unique:users',
            'email' => 'required|email|unique:users', 'password' => 'required|min:6',
            'confirm' => 'required|same:password'
        ]);
        User::create([
            'full_name' => $request->full_name, 'username' => $request->username,
            'email' => $request->email, 'password' => Hash::make($request->password),
            'role' => 'patient', 'is_active' => 1
        ]);
        return redirect('/')->with('register_success', 'Akun berhasil dibuat! Silakan login.');
    }

    // --- DASHBOARD USER ---
    public function dashboard() {
        $user = Auth::user();
        // Data Dummy Statistik
        $stats = ['total_patients' => 120, 'today_sessions' => 8, 'pending_sessions' => 3, 'satisfaction_rate'=> 98];
        $recentActivities = [
            ['action' => 'Login Berhasil', 'user_name' => $user->full_name, 'created_at' => Carbon::now()],
            ['action' => 'Update Profil', 'user_name' => 'Admin', 'created_at' => Carbon::now()->subHours(2)]
        ];
        $todayAppointments = [];
        return view('dashboard', compact('user', 'stats', 'recentActivities', 'todayAppointments'));
    }

    // --- HALAMAN PASIEN (TAMPILAN KARTU UNTUK USER) ---
    public function pasien() {
        $user = Auth::user();
        // Data Dummy untuk Tampilan User
        $patients = [
            ['id' => 1, 'name' => 'Budi Santoso', 'age' => 28, 'gender' => 'Pria', 'diagnosis' => 'Anxiety', 'status' => 'Active', 'last_session' => '2 Hari lalu', 'color' => '#3b82f6', 'initials' => 'BS'],
            ['id' => 2, 'name' => 'Siti Aminah', 'age' => 24, 'gender' => 'Wanita', 'diagnosis' => 'Depresi', 'status' => 'Active', 'last_session' => 'Hari ini', 'color' => '#ec4899', 'initials' => 'SA'],
            ['id' => 3, 'name' => 'Rudi Hartono', 'age' => 35, 'gender' => 'Pria', 'diagnosis' => 'Stress', 'status' => 'Pending', 'last_session' => '1 Minggu lalu', 'color' => '#f59e0b', 'initials' => 'RH']
        ];
        return view('pasien', compact('user', 'patients'));
    }

    // --- CHAT AI ---
    public function chat() {
        $user = Auth::user();
        if (!Session::has('chat_session_id')) Session::put('chat_session_id', uniqid('chat_', true));
        $sessionId = Session::get('chat_session_id');
        return view('chat', compact('user', 'sessionId'));
    }

    public function sendMessage(Request $request) {
        $n8n_url = "https://portative-practicable-lovie.ngrok-free.dev/webhook/c1f8d15b-e096-47f8-922e-a7484ebbc25c/chat";
        try {
            $response = Http::post($n8n_url, [
                'chatInput' => $request->message,
                'sessionId' => $request->session_id,
                'timestamp' => now()->toDateTimeString()
            ]);
            return response()->json(['success' => true, 'response' => $response->json()['output'] ?? 'No reply']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error', 'details' => $e->getMessage()], 500);
        }
    }

    // --- LAPORAN ---
    public function laporan() {
        $user = Auth::user();
        $reportStats = ['pendapatan' => 'Rp 12.5M', 'kenaikan_pasien' => '+15%', 'sesi_selesai' => 45];
        $logs = [];
        return view('laporan', compact('user', 'reportStats', 'logs'));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}