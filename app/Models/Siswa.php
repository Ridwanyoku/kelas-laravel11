<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];
    protected $table = 'siswa';

    public function pembayaranKas()
    {
        return $this->hasMany(PembayaranKas::class);
    }
}

