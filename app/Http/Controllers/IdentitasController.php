<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\IdentitasOrang;
use App\Http\Resources\UserResource;
use App\Http\Resources\IdentitasResource;

class IdentitasController extends Controller
{
    /**
     * Retrieve all users (identitas) in the system.
     */
    public function getAllIdentitas()
    {
        $identitas = User::all(); // Ambil semua pengguna dari tabel users
        return UserResource::collection($identitas); // Mengembalikan dalam bentuk resource collection
    }

    /**
     * Search for a user by NIK and name.
     */
    public function cariIdentitas(Request $request)
    {
        $nik = $request->input('nik');
        $nama = $request->input('nama');

        // Search for a matching record where both NIK and name match
        $identitasNik = User::where('nik', $nik)
            ->where('nama', $nama)
            ->first();

        if ($identitasNik) {
            return response()->json(new UserResource($identitasNik));
        }

        return response()->json([
            'errors' => 'Identitas tidak ditemukan'
        ], 404);
    }

    /**
     * Search for a user by NPWP.
     */
    public function cariIdentitasByNpwp(Request $request)
    {
        $npwp = $request->input('npwp');

        // Cari identitas berdasarkan NPWP di tabel users
        $identitasNpwp = User::where('npwp', $npwp)->first();

        if ($identitasNpwp) {
            return response()->json(new UserResource($identitasNpwp));
        }

        return response()->json([
            'errors' => 'Identitas tidak ditemukan'
        ], 404);
    }
}
