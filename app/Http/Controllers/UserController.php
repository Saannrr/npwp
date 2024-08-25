<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Validasi manual untuk NPWP dan NIK
        $npwpExists = User::where('npwp', $data['npwp'])->count() == 1;
        $nikExists = User::where('nik', $data['nik'])->count() == 1;
        if ($npwpExists || $nikExists) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "npwp or nik already registered"
                    ]
                ]
            ], 400));
        }

        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return (new UserResource($user))->response()->setStatusCode(201);
    }
    public function login(UserLoginRequest $request): UserResource
    {
        $data = $request->validated();

        $user = User::where('npwp', $data['npwp'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "npwp or password wrong"
                    ]
                ]
            ], 401));
        }

        // Convert the token_expires_at to a Carbon instance if it exists
        $tokenExpiresAt = $user->token_expires_at ? Carbon::parse($user->token_expires_at) : null;

        // Check if the token has expired or does not exist
        if (!$user->token || !$tokenExpiresAt || $tokenExpiresAt->isPast()) {
            // Generate a new token
            $user->token = Str::uuid()->toString();
            // Set the token expiration date to 30 days from now
            $user->token_expires_at = now()->addDays(30);
            $user->save();
        }

        return new UserResource($user);
    }

    public function getUser(Request $request): UserResource
    {
        $user = Auth::user();
        return new UserResource($user);
    }

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

        /** @var \App\Models\User $user **/
        $user->save();
        return new UserResource($user);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = Auth::user();
        $user->token = null;

        /** @var \App\Models\User $user **/
        $user->save();

        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }
}
