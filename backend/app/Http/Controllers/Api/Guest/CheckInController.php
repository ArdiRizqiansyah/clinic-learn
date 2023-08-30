<?php

namespace App\Http\Controllers\Api\Guest;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required|unique:pasien,telepon',
            'jadwal_detail_id' => 'required|exists:jadwal_detail,id',
        ]);

        try {
            
            $pasien = Pasien::create([
                'nama' => $request->nama,
                'telepon' => $request->telepon,
            ]);

            $pasien->checkIn($request->jadwal_detail_id);

            return response()->json([
                'message' => 'Berhasil check in',
                'data' => $pasien,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal check in',
                'data' => $th->getMessage(),
            ], 500);
        }
    }
}
