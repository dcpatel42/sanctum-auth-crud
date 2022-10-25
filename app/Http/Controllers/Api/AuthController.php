<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->sendError(['message' => 'Invalid login details'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->sendData([
                                    'access_token' => $token,
                                    'token_type' => 'Bearer',
                                ]);
        
    }

    public function register(UserRequest $request)
    {
        $validatedData = $request->validated();

        if($validatedData->fails()){
            return response()->sendError([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validatedData->errors()
            ], 422);
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->sendData([
                                    'access_token' => $token,
                                    'token_type' => 'Bearer',
                                ]);
    }

    public function me(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();

        return response()->success([
                'status' => true,
                'message' => 'Logout successfully!',
            ], 200);

    }
}
