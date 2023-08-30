<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'kouta',
        'dokter_id',
    ];

    // relationship
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id');
    }

    public function jadwalDetail()
    {
        return $this->hasMany(JadwalDetail::class, 'jadwal_id', 'id');
    }
}
