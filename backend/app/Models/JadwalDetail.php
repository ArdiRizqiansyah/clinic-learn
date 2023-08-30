<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDetail extends Model
{
    use HasFactory;

    protected $table = 'jadwal_detail';

    protected $fillable = [
        'jadwal_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'is_available',
    ];

    protected $appends = [
        'nama_hari',
        'hari_ini',
    ];

    // attributte
    public function getNamaHariAttribute()
    {
        $namaHari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ];

        return $namaHari[$this->hari];
    }

    public function getHariIniAttribute()
    {
        // cek apakah hari jadwal sama dengan hari ini
        if ($this->hari == date('N')) {
            return true;
        }else{
            return false;
        }
    }

    // relationship
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }

    public function pengunjung()
    {
        return $this->hasMany(Pengunjung::class, 'jadwal_detail_id', 'id');
    }

    // scope
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}
