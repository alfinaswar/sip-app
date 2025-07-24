<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratIzin extends Model
{
    use HasFactory;

    protected $table = 'surat_izins';

    protected $guarded = ['id'];

    protected $casts = [
        'AnggotaKeluarga' => 'array',
    ];
}
