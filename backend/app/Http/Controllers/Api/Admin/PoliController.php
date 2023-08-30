<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PoliRequest;
use App\Models\Poli;
use App\Services\ApiService;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polis = Poli::withCount(['dokter'])->latest()->get();

        $apiService = new ApiService();

        return $apiService->response($polis, 'All polis');
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
    public function store(PoliRequest $request)
    {
        try{
            $code = getRandomCode('poli');

            // simpan data poli
            $poli = Poli::create([
                'kode' => $code,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'ikon' => $request->ikon,
            ]);

            // simpan gambar jika ada
            if($request->hasFile('image')){
                $poli->addMediaFromRequest('image')
                    ->toMediaCollection('poli');
            }

            $apiService = new ApiService();

            return $apiService->response($poli, 'Poli created', 201);
        }catch(\Exception $e){
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Poli $poli)
    {
        $poli->load(['dokter', 'media']);

        $apiService = new ApiService();

        return $apiService->response($poli, 'Poli detail');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poli $poli)
    {
        $poli->load(['dokter', 'media']);

        $apiService = new ApiService();

        return $apiService->response($poli, 'Poli detail');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PoliRequest $request, Poli $poli)
    {
        try{
            // update data poli
            $poli->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'ikon' => $request->ikon,
            ]);

            $apiService = new ApiService();

            return $apiService->response($poli, 'Poli updated');
        }catch(\Exception $e){
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poli $poli)
    {
        try{
            // periksa apakah ada relasi dengan dokter
            if($poli->dokter()->count() > 0){
                $apiService = new ApiService();

                return $apiService->error('Poli masih memiliki dokter', 400);
            }

            // hapus gambar jika ada
            if($poli->media()->count() > 0){
                $poli->clearMediaCollection('poli');
            }

            // hapus data poli
            $poli->delete();

            $apiService = new ApiService();

            return $apiService->response(null, 'Poli deleted');
        }catch(\Exception $e){
            $apiService = new ApiService();

            return $apiService->error($e->getMessage(), 500);
        }
    }
}
