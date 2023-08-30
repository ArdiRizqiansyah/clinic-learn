<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalDetailRequest;
use App\Models\JadwalDetail;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JadwalDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($jadwal_id)
    {
        $jadwalDetail = JadwalDetail::with('jadwal', 'pengunjung')->where('jadwal_id', $jadwal_id)->get();

        $apiService = new ApiService;

        return $apiService->response($jadwalDetail, 'Semua Jadwal Detail');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JadwalDetailRequest $request)
    {
        try {
            $jadwalDetail = JadwalDetail::create($request->validated());

            $apiService = new ApiService;

            return $apiService->response($jadwalDetail, 'Jadwal Detail berhasil ditambahkan', 201);
        }catch(ValidationException $e){
            $apiService = new ApiService;

            return $apiService->validationError($e->errors(), 422);
        } catch(\Exception $e) {
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalDetail $jadwalDetail)
    {
        $jadwalDetail->load('jadwal', 'pengunjung');

        $apiService = new ApiService;

        return $apiService->response($jadwalDetail, 'Detail Jadwal Detail');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalDetail $jadwalDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JadwalDetailRequest $request, JadwalDetail $jadwalDetail)
    {
        try {
            $jadwalDetail->update($request->validated());

            $apiService = new ApiService;

            return $apiService->response($jadwalDetail, 'Jadwal Detail berhasil diupdate');
        }catch(ValidationException $e){
            $apiService = new ApiService;

            return $apiService->validationError($e->errors(), 422);
        } catch(\Exception $e) {
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalDetail $jadwalDetail)
    {
        try {
            $jadwalDetail->delete();

            $apiService = new ApiService;

            return $apiService->response($jadwalDetail, 'Jadwal Detail berhasil dihapus');
        } catch(\Exception $e) {
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }
}
