<?php

namespace App\Http\Controllers\Api\Public;

use App\Models\Dokter;
use App\Services\ApiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::with(['jadwal.jadwalDetail', 'poli'])->latest()->get();

        $apiService = new ApiService();

        return $apiService->response($dokter, 'Data Dokter');
    }
}
