<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    // =========================================
    // 1. AUTHENTICATION
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

        $user = User::create([
            'full_name' => $request->full_name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'patient',
            'is_active' => 1
        ]);

        DB::table('patients')->insert([
            'user_id' => $user->id,
            'date_of_birth' => null,
            'address' => '-'
        ]);

        return redirect('/')->with('register_success', 'Akun berhasil dibuat! Silakan login.');
    }

    // =========================================
    // 2. DASHBOARD & PROFIL (USER)
    // =========================================

    public function dashboard() {
        $user = Auth::user();
        if ($user->role === 'admin') return redirect()->route('admin.dashboard');

        $totalSessions = DB::table('counseling_sessions')->where('user_id', $user->id)->count();
        
        $stats = [
            'total_patients'   => 120,
            'today_sessions'   => $totalSessions,
            'pending_sessions' => 0,
            'satisfaction_rate'=> 98
        ];

        // FIX TIMEZONE: Menggunakan waktu lokal
        $recentActivities = [
            [
                'action' => 'Login Berhasil', 
                'user_name' => $user->full_name, 
                'created_at' => Carbon::now('Asia/Makassar')
            ],
        ];

        $todayAppointments = [];

        return view('dashboard', compact('user', 'stats', 'recentActivities', 'todayAppointments'));
    }

    public function pasien() {
        $userId = Auth::id();
        $patient = DB::table('users')
            ->leftJoin('patients', 'users.id', '=', 'patients.user_id')
            ->where('users.id', $userId)
            ->select('users.*', 'patients.date_of_birth', 'patients.address')
            ->first();
        $user = Auth::user();
        return view('pasien', compact('user', 'patient'));
    }

    // =========================================
    // 3. JADWAL KONSELING (FIX TIMEZONE)
    // =========================================
    public function jadwal() {
        $user = Auth::user();

        $schedules = DB::table('counseling_sessions')
            ->where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        // Gunakan Carbon dengan timezone Asia/Makassar untuk perbandingan waktu
        $now = Carbon::now('Asia/Makassar');

        $upcomingSchedules = $schedules->filter(function ($item) use ($now) {
            return $item->status === 'scheduled' && Carbon::parse($item->date)->gt($now);
        });

        $pastSchedules = $schedules->filter(function ($item) use ($now) {
            return $item->status === 'completed' || $item->status === 'cancelled' || Carbon::parse($item->date)->lte($now);
        });

        return view('jadwal', compact('user', 'upcomingSchedules', 'pastSchedules'));
    }

    // =========================================
    // 4. CHAT AI & LAPORAN (FIX TIMEZONE)
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
        $user = Auth::user();
        
        $n8n_webhook_url = "https://portative-practicable-lovie.ngrok-free.dev/webhook/c1f8d15b-e096-47f8-922e-a7484ebbc25c/chat";
        $sessionId = $request->session_id ?? Session::get('chat_session_id');

        // FIX TIMEZONE: Ambil waktu sekarang di Makassar
        $waktuSekarang = Carbon::now('Asia/Makassar');

        try {
            $response = Http::post($n8n_webhook_url, [
                'chatInput' => $request->message,
                'sessionId' => $sessionId,
                'timestamp' => $waktuSekarang->toDateTimeString()
            ]);

            if ($response->successful()) {
                $aiReply = $response->json()['output'] ?? 'Tidak ada balasan.';

                // Simpan ke DB dengan waktu lokal
                $sessionIdDb = DB::table('counseling_sessions')->insertGetId([
                    'user_id' => $user->id,
                    'date' => $waktuSekarang, // Masuk database sesuai waktu lokal
                    'duration' => 5,
                    'status' => 'completed',
                    'created_at' => $waktuSekarang
                ]);

                DB::table('medical_records')->insert([
                    'session_id' => $sessionIdDb,
                    'diagnosis' => 'Konsultasi AI',
                    'notes' => 'User: ' . $request->message,
                    'prescription' => $aiReply,
                    'created_at' => $waktuSekarang
                ]);

                return response()->json([
                    'success' => true,
                    'response' => $aiReply,
                    'session_id' => $sessionId
                ]);
            } else {
                return response()->json(['error' => 'Gagal menghubungi AI'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function laporan() {
        $user = Auth::user();
        
        $reports = DB::table('counseling_sessions')
            ->leftJoin('medical_records', 'counseling_sessions.id', '=', 'medical_records.session_id')
            ->where('counseling_sessions.user_id', $user->id)
            ->select(
                'counseling_sessions.id', 
                'counseling_sessions.date', 
                'counseling_sessions.duration', 
                'counseling_sessions.status',
                'medical_records.diagnosis',
                'medical_records.notes',
                'medical_records.prescription'
            )
            ->orderBy('counseling_sessions.date', 'desc')
            ->get();

        $stats = [
            'total_sessions' => $reports->count(),
            'completed' => $reports->where('status', 'completed')->count(),
            'avg_duration' => $reports->avg('duration') ? round($reports->avg('duration')) : 0,
            'last_visit' => $reports->first() ? Carbon::parse($reports->first()->date)->translatedFormat('d M Y') : '-'
        ];

        return view('laporan', compact('user', 'reports', 'stats'));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}