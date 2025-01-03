<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;
    protected $fillable = ['nama_item', 'kategori', 'jenis_kendaraan'];

    public function scopeJenisKendaraan($query, $jenis)
    {
        return $query->where('jenis_kendaraan', $jenis);
    }
}
