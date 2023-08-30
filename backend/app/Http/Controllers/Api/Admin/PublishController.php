<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublishController extends Controller
{
    // invoke
    public function __invoke(Request $request)
    {
        $request->validate([
            'tabel' => 'required',
            'id' => 'required',
            'is_available' => 'required|boolean',
        ]);

        DB::table($request->tabel)
            ->where('id', $request->id)
            ->update([
                'is_available' => $request->is_available,
            ]);

        return response()->json([
            'message' => 'Berhasil memperbarui status publish',
        ]);
    }
}
