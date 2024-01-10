<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    //
    function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // $device = substr($request->userAgent() ?? '', 0, 255);
        // $token = $user->createToken($device)->plainTextToken;
        return response()->json([
            'user' => $user,
            // 'token' => $token
        ], Response::HTTP_CREATED);
    }

    function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password))
            return response()->json([
                'message' => 'The provided credentials are incorrect',
            ], Response::HTTP_UNAUTHORIZED);

        $device = substr($request->userAgent() ?? '', 0, 255);
        $token = $user->createToken($device)->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], Response::HTTP_ACCEPTED);
    }

    function logout()
    {
        /**
         * @var App\Models\User $user
        **/
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response()->noContent();
    }
}
