<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Dokter extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'dokter';

    protected $fillable = [
        'nama',
        'poli_id',
    ];

    // relationship
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id', 'id');
    }

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'dokter_id', 'id');
    }

    public function pengunjung()
    {
        return $this->hasMany(Pengunjung::class, 'dokter_id', 'id');
    }
}
