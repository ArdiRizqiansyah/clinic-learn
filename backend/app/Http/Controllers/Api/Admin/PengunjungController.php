<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Pengunjung;
use App\Services\ApiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengunjungController extends Controller
{
    public function index()
    {
        $pengunjung = Pengunjung::with(['pasien','dokter.poli'])->latest()->get();

        $apiService = new ApiService();

        return $apiService->response($pengunjung, 'Data pengunjung');
    }
}
