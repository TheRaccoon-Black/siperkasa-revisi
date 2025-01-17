<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoTambahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_hasil',
        'reguPenerima',
        'reguJagaPenerima',
        'dinasPenerima',
        'danruPenerima',
        'danruPenyerah',
        'Asstman',
        'komandanPenyerah',
        'komandanPenerima',
    ];
}
