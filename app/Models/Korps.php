<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korps extends Model
{
    use HasFactory;

    protected $table = 'korps';

    protected $fillable = [
        'kode',
        'nama',
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
