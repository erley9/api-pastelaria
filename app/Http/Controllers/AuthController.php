<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    public function auth(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }


        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'successfully logged out',
        ]);
    }


}
