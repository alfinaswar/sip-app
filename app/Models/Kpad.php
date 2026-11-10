<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpad extends Model
{
    use HasFactory;

    protected $table = 'kpads';

    protected $fillable = [
        'wilayah_kodim',
        'nama_kpad',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('urutan')->orderBy('id');
    }
}
