<?php

namespace App\Http\Controllers\Api\Public;

use App\Models\JadwalDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Pasien;
use App\Models\Pengunjung;
use App\Services\ApiService;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $dokter = Dokter::where('poli_id', $request->poli_id)->whereHas('jadwal', function($query){
            $query->whereHas('jadwalDetail', function($query){
                $query->available();
            });
        })->get();

        $jadwal = Jadwal::whereIn('dokter_id', $dokter->pluck('id'))->get();

        // ambil hari tanggal ini
        $hari = date('D');

        // ubah jadi senin = 1, selasa = 2, dst
        switch ($hari) {
            case 'Mon':
                $hari = 1;
                break;
            case 'Tue':
                $hari = 2;
                break;
            case 'Wed':
                $hari = 3;
                break;
            case 'Thu':
                $hari = 4;
                break;
            case 'Fri':
                $hari = 5;
                break;
            case 'Sat':
                $hari = 6;
                break;
            case 'Sun':
                $hari = 7;
                break;
        }

        // ambil data jadwal dokter
        $jadwalDetail = JadwalDetail::with(['jadwal.dokter'])
            ->whereIn('jadwal_id', $jadwal->pluck('id'))
            ->whereIn('hari', [$hari, $hari + 1])
            ->available()
            ->get();

        $apiService = new ApiService();

        return $apiService->response($jadwalDetail, 'Data detail jadwal tersedia');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'jadwal_detail_id' => 'required',
            'tanggal' => 'required',
        ]);

        $jadwalDetail = JadwalDetail::findOrFail($request->jadwal_detail_id);

        $pasien = Pasien::create([
            'nama' => $request->nama,
            'telepon' => $request->no_hp,
        ]);

        Pengunjung::create([
            'tanggal' => $request->tanggal,
            'dokter_id' => $jadwalDetail->jadwal->dokter_id,
            'jadwal_detail_id' => $request->jadwal_detail_id,
            'pasien_id' => $pasien->id,
        ]);

        $apiService = new ApiService();

        return $apiService->response(null, 'Berhasil mendaftar');
    }
}
