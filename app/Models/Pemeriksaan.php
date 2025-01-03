<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';
    protected $fillable = ['dinas', 'id_hasil', 'id_petugas', 'id_checklist', 'id_kendaraan', 'tanggal', 'kondisi', 'keterangan'];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'id_checklist');
    }

    
}
