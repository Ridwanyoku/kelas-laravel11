<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranKas extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'bulan', 'checklist'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
