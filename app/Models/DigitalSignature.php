<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalSignature extends Model
{
    use HasFactory;

    protected $fillable = [
        'idHasilPemeriksaan',
        'ttdDanruPenerima',
        'ttdDanruPenyerah',
        'parafPenyerah',
        'ttdAsstMan',
        'linkDanruPenerima',
        'linkDanruPenyerah',
        'linkAsstMan',
        'linkParafPenyerah',
    ];

}
