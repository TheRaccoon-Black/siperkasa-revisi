<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'regu','petugas_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getNamaPetugasAttribute()
    {
        return $this->user->name; // Ambil nama petugas dari relasi user
    }
}
