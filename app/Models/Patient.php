<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'phone', 
        'date_of_birth', 
        'gender', 
        'address', 
        'medical_history', 
        'emergency_contact'
    ];
    
    public $timestamps = false;

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}