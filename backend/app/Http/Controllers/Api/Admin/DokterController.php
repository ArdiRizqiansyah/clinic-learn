<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DokterRequest;
use App\Models\Dokter;
use App\Models\Poli;
use App\Services\ApiService;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokters = Dokter::with(['poli'])->latest()->get();

        $apiService = new ApiService();

        return $apiService->response($dokters, 'All dokters');
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
    public function store(DokterRequest $request)
    {
        try{
            // simpan data dokter
            $dokter = Dokter::create([
                'nama' => $request->nama,
                'poli_id' => $request->poli_id,
            ]);

            // simpan gambar jika ada
            if($request->hasFile('image')){
                $dokter->addMediaFromRequest('image')
                    ->toMediaCollection('dokter');
            }

            $apiService = new ApiService();

            return $apiService->response($dokter, 'Dokter created', 201);
        }catch(\Exception $e){
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        $dokter->load(['poli', 'media']);

        $apiService = new ApiService();

        return $apiService->response($dokter, 'Detail dokter');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dokter)
    {
        $dokter->load(['poli', 'media']);

        $poli = Poli::all();

        $apiService = new ApiService();

        return $apiService->response([
            'dokter' => $dokter,
            'poli' => $poli,
        ], 'Edit dokter');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dokter)
    {
        try{
            // update data dokter
            $dokter->update([
                'nama' => $request->nama,
                'poli_id' => $request->poli_id,
            ]);

            // simpan gambar jika ada
            if($request->hasFile('image')){
                // hapus gambar lama
                $dokter->clearMediaCollection('dokter');

                $dokter->addMediaFromRequest('image')
                    ->toMediaCollection('dokter');
            }

            $apiService = new ApiService();

            return $apiService->response($dokter, 'Dokter updated');
        }catch(\Exception $e){
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dokter)
    {
        try{
            // hapus gambar
            $dokter->clearMediaCollection('dokter');

            // hapus data dokter
            $dokter->delete();

            $apiService = new ApiService();

            return $apiService->response($dokter, 'Dokter deleted');
        }catch(\Exception $e){
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }
}
