<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Models\Jadwal;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::with('dokter', 'jadwalDetail')->latest()->get();

        $apiService = new ApiService;

        return $apiService->response($jadwal, 'Semua Jadwal');
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
    public function store(JadwalRequest $request)
    {
        try {
            $jadwal = Jadwal::create($request->validated());

            $apiService = new ApiService;

            return $apiService->response($jadwal, 'Jadwal berhasil ditambahkan', 201);
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
    public function show(Jadwal $jadwal)
    {
        $jadwal->load('dokter', 'jadwalDetail');

        $apiService = new ApiService;

        return $apiService->response($jadwal, 'Detail Jadwal');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JadwalRequest $request, Jadwal $jadwal)
    {
        try {
            $jadwal->update($request->validated());

            $apiService = new ApiService;

            return $apiService->response($jadwal, 'Jadwal berhasil diupdate');
        } catch(\Exception $e) {
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        try {
            $jadwal->delete();

            $apiService = new ApiService;

            return $apiService->response($jadwal, 'Jadwal berhasil dihapus');
        } catch(\Exception $e) {
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }
}
