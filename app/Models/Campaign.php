<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    // Nama kolom mengikuti tabel yang sudah ada
    protected $fillable = [
        'kategori_id', 'judul', 'slug', 'deskripsi', 'target_dana', 'dana_terkumpul',
        'tanggal_mulai', 'tanggal_selesai', 'status', 'image',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Alias agar view yang memakai nama Inggris tetap jalan
    public function getTitleAttribute()           { return $this->judul; }
    public function getDescriptionAttribute()     { return $this->deskripsi; }
    public function getTargetAmountAttribute()    { return $this->target_dana; }
    public function getCollectedAmountAttribute() { return $this->dana_terkumpul; }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function getProgressAttribute(): int
    {
        return $this->target_dana > 0
            ? (int) min(100, round($this->dana_terkumpul / $this->target_dana * 100))
            : 0;
    }
}