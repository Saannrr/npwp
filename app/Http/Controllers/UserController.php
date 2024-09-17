<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\IdentitasOrang;
use Illuminate\Http\JsonResponse;
use App\Models\IdentitasPerusahaan;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Validasi manual untuk NPWP dan NIK langsung di tabel users
        $npwpExists = User::where('npwp', $data['npwp'])->exists();
        $nikExists = User::where('nik', $data['nik'])->exists();

        if ($npwpExists || $nikExists) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "npwp or nik already registered"
                    ]
                ]
            ], 400));
        }

        // Buat user baru
        $user = new User($data);
        $user->passphrase = Str::random(7);
        $user->password = Hash::make($data['password']);
        $user->save();

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    /**
     * Log in a user.
     */
    public function login(UserLoginRequest $request): UserResource
    {
        $data = $request->validated();

        // Cari user berdasarkan NPWP di tabel users
        $user = User::where('npwp', $data['npwp'])->first();

        // Cek apakah user ditemukan dan password benar
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "npwp or password wrong"
                    ]
                ]
            ], 401));
        }

        // Konversi token_expires_at ke instance Carbon jika ada
        $tokenExpiresAt = $user->token_expires_at ? Carbon::parse($user->token_expires_at) : null;

        // Cek apakah token sudah kadaluarsa atau tidak ada
        if (!$user->token || !$tokenExpiresAt || $tokenExpiresAt->isPast()) {
            // Generate token baru
            $user->token = Str::uuid()->toString();
            // Set tanggal kadaluarsa token 30 hari dari sekarang
            $user->token_expires_at = now()->addDays(30);
            $user->save();
        }

        return new UserResource($user);
    }

    /**
     * Get the authenticated user.
     */
    public function getUser(): UserResource
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    /**
     * Update the authenticated user's information.
     */
    public function update(UserUpdateRequest $request): UserResource
    {
        $data = $request->validated();
        $user = Auth::user();

        if (isset($data['email'])) {
            $user->email = $data['email'];
        }

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();
        return new UserResource($user);
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(Request $request): JsonResponse
    {
        $user = Auth::user();
        $user->token = null;

        $user->save();

        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }
}
