<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $fillable = [
        'campaign_id',
        'user_id',
        'nama_donatur',
        'email',
        'no_telepon',
        'alamat',
        'jumlah',
        'pesan',
        'tanggal_donasi',
    ];
}