<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    
    // Pastikan nama tabel benar, default Laravel: 'patients'
    protected $fillable = ['user_id', 'date_of_birth', 'address'];
    public $timestamps = false; // Jika tabel patients tidak punya created_at/updated_at
}