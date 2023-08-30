<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalDetail;
use App\Models\Pasien;
use App\Models\Pengunjung;
use App\Services\ApiService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ambil tanggal hari ini dan ubah hari nya menjadi senin = 1 selasa = 2, dst
        $hari_ini = date('N');

        $data = [
            'total_pasien' => Pasien::count(),
            'total_dokter' => Dokter::count(),
            'total_jadwal' => JadwalDetail::available()->where('hari', $hari_ini)->count(),
            'total_kunjungan' => Pengunjung::where('tanggal', date('Y-m-d'))->count(),
            'pengunjung' => Pengunjung::with(['pasien', 'dokter.poli'])->latest()->limit(6)->get(),
        ];

        $apiService = new ApiService();

        return $apiService->response($data, 'Data halaman dashboard');
    }
}
