<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use App\Services\ApiService;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $poli = Poli::latest()->get();

        $apiService = new ApiService();

        return $apiService->response($poli, 'Data Poli');
    }
}
