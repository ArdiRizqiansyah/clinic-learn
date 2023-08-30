<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $table = 'pengunjung';

    protected $fillable = [
        'tanggal',
        'dokter_id',
        'jadwal_detail_id',
        'pasien_id',
    ];

    // relationship
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id');
    }

    public function jadwalDetail()
    {
        return $this->belongsTo(JadwalDetail::class, 'jadwal_detail_id', 'id');
    }
}
