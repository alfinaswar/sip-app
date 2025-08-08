<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatUpdate extends Model
{
    use HasFactory;
    protected $table = 'riwayat_updates';
    protected $guarded = ['id'];
    protected $casts = [
        'AnggotaKeluarga' => 'array',
    ];
}
