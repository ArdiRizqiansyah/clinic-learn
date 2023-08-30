<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Pasien;
use App\Services\ApiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::latest()->get();

        $apiService = new ApiService();

        return $apiService->response($pasien, 'Data pasien');
    }
}
