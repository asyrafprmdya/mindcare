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
            'role'      => 'patient',
            'is_active' => 1
        ]);

        return redirect('/')->with('register_success', 'Akun berhasil dibuat! Silakan login.');
    }

    // =========================================
    // 2. DASHBOARD (METHOD INI YANG HILANG TADI)
    // =========================================

    public function dashboard() {
        $user = Auth::user();

        // Data Statistik Dummy
        $totalPatients = User::where('role', 'patient')->count();
        $stats = [
            'total_patients'   => $totalPatients > 0 ? $totalPatients : 120,
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
                'action'     => 'Update Profil Pasien',
                'user_name'  => 'Admin Klinik',
                'created_at' => Carbon::now()->subMinutes(45)
            ],
            [
                'action'     => 'Pengecekan Sistem',
                'user_name'  => 'System',
                'created_at' => Carbon::now()->subHours(5)
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
    // 3. HALAMAN LAPORAN
    // =========================================

    public function laporan() {
        $user = Auth::user();
        
        $reportStats = [
            'pendapatan' => 'Rp 12.500.000',
            'kenaikan_pasien' => '+15%',
            'sesi_selesai' => 45,
            'ratarata_durasi' => '55 Menit'
        ];

        $logs = [
            ['date' => '2023-10-25', 'patient' => 'Budi Santoso', 'type' => 'Konseling', 'status' => 'Selesai', 'amount' => 'Rp 250.000'],
            ['date' => '2023-10-24', 'patient' => 'Siti Aminah', 'type' => 'Terapi', 'status' => 'Selesai', 'amount' => 'Rp 300.000'],
            ['date' => '2023-10-23', 'patient' => 'Rizky Pratama', 'type' => 'Konseling', 'status' => 'Batal', 'amount' => 'Rp 0'],
        ];

        return view('laporan', compact('user', 'reportStats', 'logs'));
    }

    // =========================================
    // 4. HALAMAN CHAT & KIRIM PESAN (N8N)
    // =========================================

    public function chat() {
        $user = Auth::user();
        
        // Generate Chat Session ID jika belum ada
        if (!Session::has('chat_session_id')) {
            Session::put('chat_session_id', uniqid('chat_', true));
        }
        $sessionId = Session::get('chat_session_id');

        return view('chat', compact('user', 'sessionId'));
    }

    public function sendMessage(Request $request) {
        $request->validate([
            'message' => 'required|string'
        ]);

        // URL N8N Webhook Kamu
        $n8n_webhook_url = "https://portative-practicable-lovie.ngrok-free.dev/webhook/c1f8d15b-e096-47f8-922e-a7484ebbc25c/chat";
        
        $sessionId = $request->session_id ?? Session::get('chat_session_id');

        try {
            // Kirim request ke N8N menggunakan HTTP Client Laravel
            $response = Http::post($n8n_webhook_url, [
                'chatInput' => $request->message,
                'sessionId' => $sessionId,
                'timestamp' => now()->toDateTimeString()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'response' => $data['output'] ?? 'Tidak ada balasan dari AI.',
                    'session_id' => $sessionId
                ]);
            } else {
                return response()->json([
                    'error' => 'Gagal menghubungi N8N',
                    'details' => $response->body()
                ], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'details' => $e->getMessage()
            ], 500);
        }
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