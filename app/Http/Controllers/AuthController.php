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
    // =========================================
    // 1. AUTHENTICATION (LOGIN & REGISTER)
    // =========================================

    public function showLogin() {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('index');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Jika admin login lewat form biasa, arahkan ke dashboard admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    public function showRegister() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username'  => 'required|string|unique:users,username|max:50',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'confirm'   => 'required|same:password'
        ]);

        User::create([
            'full_name' => $request->full_name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'patient', // Default role
            'is_active' => 1
        ]);

        return redirect('/')->with('register_success', 'Akun berhasil dibuat! Silakan login.');
    }

    // =========================================
    // 2. DASHBOARD USER (DOKTER/KONSELOR)
    // =========================================

    public function dashboard() {
        $user = Auth::user();

        // Jika admin nyasar ke sini, lempar ke admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Data Statistik Dummy
        $stats = [
            'total_patients'   => 120,
            'today_sessions'   => 8,
            'pending_sessions' => 3,
            'satisfaction_rate'=> 98
        ];

        // Data Aktivitas Dummy
        $recentActivities = [
            [
                'action'     => 'Login Berhasil',
                'user_name'  => $user->full_name,
                'created_at' => Carbon::now()
            ],
            [
                'action'     => 'Update Profil',
                'user_name'  => 'Admin',
                'created_at' => Carbon::now()->subHours(2)
            ]
        ];

        // Data Jadwal Dummy
        $todayAppointments = [
            [
                'patient_name' => 'Budi Santoso',
                'start_time'   => Carbon::now()->setHour(9)->setMinute(0),
                'status'       => 'scheduled'
            ],
            [
                'patient_name' => 'Siti Aminah',
                'start_time'   => Carbon::now()->setHour(13)->setMinute(30),
                'status'       => 'pending'
            ]
        ];

        return view('dashboard', compact('user', 'stats', 'recentActivities', 'todayAppointments'));
    }

    // =========================================
    // 3. HALAMAN PROFIL PASIEN (VIEW ONLY)
    // =========================================

    public function pasien() {
        $user = Auth::user();

        // Data Dummy Pasien untuk Tampilan User
        $patients = [
            [
                'id' => 1, 'name' => 'Budi Santoso', 'age' => 28, 'gender' => 'Pria',
                'diagnosis' => 'Anxiety Disorder', 'last_session' => '25 Nov 2025',
                'status' => 'Active', 'initials' => 'BS', 'color' => '#3b82f6'
            ],
            [
                'id' => 2, 'name' => 'Siti Aminah', 'age' => 24, 'gender' => 'Wanita',
                'diagnosis' => 'Mild Depression', 'last_session' => '22 Nov 2025',
                'status' => 'Active', 'initials' => 'SA', 'color' => '#ec4899'
            ],
            [
                'id' => 3, 'name' => 'Rudi Hartono', 'age' => 35, 'gender' => 'Pria',
                'diagnosis' => 'Stress Management', 'last_session' => '20 Nov 2025',
                'status' => 'Inactive', 'initials' => 'RH', 'color' => '#f59e0b'
            ]
        ];

        return view('pasien', compact('user', 'patients'));
    }

    // =========================================
    // 4. FITUR CHAT & LAPORAN
    // =========================================

    public function chat() {
        $user = Auth::user();
        if (!Session::has('chat_session_id')) {
            Session::put('chat_session_id', uniqid('chat_', true));
        }
        $sessionId = Session::get('chat_session_id');
        return view('chat', compact('user', 'sessionId'));
    }

    public function sendMessage(Request $request) {
        $request->validate(['message' => 'required|string']);
        
        $n8n_webhook_url = "https://portative-practicable-lovie.ngrok-free.dev/webhook/c1f8d15b-e096-47f8-922e-a7484ebbc25c/chat";
        $sessionId = $request->session_id ?? Session::get('chat_session_id');

        try {
            $response = Http::post($n8n_webhook_url, [
                'chatInput' => $request->message,
                'sessionId' => $sessionId,
                'timestamp' => now()->toDateTimeString()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'response' => $data['output'] ?? 'Tidak ada balasan.',
                    'session_id' => $sessionId
                ]);
            } else {
                return response()->json(['error' => 'Gagal menghubungi AI'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    public function laporan() {
        // Halaman Laporan Dummy
        $user = Auth::user();
        $reportStats = ['pendapatan' => 'Rp 12.5M', 'kenaikan_pasien' => '+15%', 'sesi_selesai' => 45];
        $logs = [];
        return view('laporan', compact('user', 'reportStats', 'logs'));
    }

    // =========================================
    // 5. LOGOUT
    // =========================================

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}