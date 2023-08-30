<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Poli extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'poli';

    protected $fillable = [
        'nama',
        'kode',
        'deskripsi',
        'ikon',
    ];

    // relationship
    public function dokter()
    {
        return $this->hasMany(Dokter::class, 'poli_id', 'id');
    }
}
