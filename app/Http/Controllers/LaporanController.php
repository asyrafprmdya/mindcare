<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $role = Auth::user()->role;

        // ambil data statistik
        if ($role == 'admin') {
            $totalSessions = DB::table('appointments')->count();
            
            $newPatients = DB::table('users')
                ->where('role', 'patient')
                ->whereMonth('created_at', now()->month)
                ->count();
            
            $avgDuration = DB::table('appointments')
                ->where('status', 'completed')
                ->selectRaw('ROUND(AVG(TIMESTAMPDIFF(MINUTE, start_time, end_time))) as avg_duration')
                ->value('avg_duration');
            
            $avgRating = DB::table('ratings_reviews')
                ->selectRaw('ROUND(AVG(rating),1) as avg_rating')
                ->value('avg_rating');
                
        } else {
            $totalSessions = DB::table('appointments')
                ->join('patients', 'patients.id', '=', 'appointments.patient_id')
                ->where('patients.user_id', $user_id)
                ->count();
            
            $newPatients = 0;
            
            $avgDuration = DB::table('appointments')
                ->join('patients', 'patients.id', '=', 'appointments.patient_id')
                ->where('patients.user_id', $user_id)
                ->where('appointments.status', 'completed')
                ->selectRaw('ROUND(AVG(TIMESTAMPDIFF(MINUTE, start_time, end_time))) as avg_duration')
                ->value('avg_duration');
            
            // Query rating sederhana
            $avgRating = DB::table('ratings_reviews')
                ->selectRaw('ROUND(AVG(rating),1) as avg_rating')
                ->value('avg_rating');
        }

        // ambil data laporan sesi
        if ($role == 'admin') {
            $reports = DB::table('appointments as a')
                ->join('patients as p', 'p.id', '=', 'a.patient_id')
                ->join('users as u', 'u.id', '=', 'p.user_id')
                ->select(
                    'a.id',
                    'u.full_name as patient_name',
                    'a.appointment_date',
                    DB::raw('TIMESTAMPDIFF(MINUTE, a.start_time, a.end_time) as duration'),
                    'a.status'
                )
                ->orderBy('a.appointment_date', 'DESC')
                ->limit(10)
                ->get();
        } else {
            $reports = DB::table('appointments as a')
                ->join('patients as p', 'p.id', '=', 'a.patient_id')
                ->join('users as u', 'u.id', '=', 'p.user_id')
                ->select(
                    'a.id',
                    'u.full_name as patient_name',
                    'a.appointment_date',
                    DB::raw('TIMESTAMPDIFF(MINUTE, a.start_time, a.end_time) as duration'),
                    'a.status'
                )
                ->where('p.user_id', $user_id)
                ->orderBy('a.appointment_date', 'DESC')
                ->limit(10)
                ->get();
        }

        // Ambil history chat untuk ditampilkan di laporan
        $chatHistory = $this->getChatHistory($user_id, $role);

        return view('laporan', compact(
            'totalSessions',
            'newPatients',
            'avgDuration',
            'avgRating',
            'reports',
            'chatHistory'
        ));
    }

    /**
     * Ambil history chat berdasarkan role user
     */
    private function getChatHistory($user_id, $role)
    {
        if ($role == 'admin') {
            // Admin bisa lihat semua chat history dari user
            return DB::table('chat_sessions as cs')
                ->join('users as u', 'u.id', '=', 'cs.user_id')
                ->select(
                    'cs.id',
                    'cs.session_id',
                    'u.full_name as patient_name',
                    'cs.last_message',
                    'cs.message_count',
                    'cs.last_activity',
                    'cs.created_at'
                )
                ->orderBy('cs.last_activity', 'DESC')
                ->limit(20)
                ->get();
        } else {
            // User biasa hanya lihat chat sendiri
            return DB::table('chat_sessions as cs')
                ->join('users as u', 'u.id', '=', 'cs.user_id')
                ->select(
                    'cs.id',
                    'cs.session_id',
                    'u.full_name as patient_name',
                    'cs.last_message',
                    'cs.message_count',
                    'cs.last_activity',
                    'cs.created_at'
                )
                ->where('cs.user_id', $user_id)
                ->orderBy('cs.last_activity', 'DESC')
                ->limit(10)
                ->get();
        }
    }

    public function adminIndex()
    {
        return $this->index();
    }
}