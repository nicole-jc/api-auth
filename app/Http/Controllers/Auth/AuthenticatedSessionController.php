<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        // Login and creating a Bearer Token 
        $request->authenticate();
        $user = Auth::user();
        $token = $user->createToken('api_token')->plainTextToken;
    
        return response()->json([
            'You are logged!',
            'Bearer token' => $token,
            'Token expires in 10 minutes',
            'user' => $user
        , 
            'links' => [
                'show your info' => url('/api/user/me'), // link to show logged user info
                'method' => 'GET'
            ], [
                'update profile' => url('/api/user/me'), // link to update profile
                'method' => 'PUT'
            ], [
                'verify e-mail' => url('/api/email/verify/notification'), // link to verify e-mail
                'method' => 'POST'
            ], [
                'delete account' => url('/api/user/me'), // link to delete acct
                'method' => 'DELETE'
            ], [
                'logout' => url('/api/logout'), // link to logout
                'method' => 'POST'
        ]],
         200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        // API Logout 
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Succesfully logged out!', 
        'links' => [
            'show all users' => url('/api/users'), // link to show all users
            'method' => 'GET'
        ]], 200);
    }
}
