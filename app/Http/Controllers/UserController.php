<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse {
        // show all users
        $users = User::all();

        return response()->json([$users, 
            'links' => [
                'self' => url('/api/users'), // self
                'method' => 'GET'
            ], [
                'show a user' => url('/api/users/{id}'), // link to show a user
                'method' => 'GET'
            ], [
                'login' => url('/api/login'), // link to login
                'method' => 'POST'
            ], [
                'register' => url('/api/register'), // link to register
                'method' => 'POST'
            ],

        ], 200);
    }

    public function show(User $user): JsonResponse {
        // show user info
        return response()->json([$user,
            'links' => [
                'self' => url('/api/users/{id}'), // link to show a user
                'method' => 'GET'
            ], [
                'show all users' => url('/api/users'), // link to show all users
                'method' => 'GET'
            ], [
                'login' => url('/api/login'),
                'method' => 'POST'
            ], [
                'register' => url('/api/register'), // link to register
                'method' => 'POST'
            ]
        ], 200);
    }

    public function user(UserRequest $request): JsonResponse {
        // show logged user info
        $user = $request->user();

        return response()->json([$user, 
            'links' => [
                'self' => url('/api/user/me'), // self
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
            ],
        ], 200);
    }

    public function update(UserRequest $request): JsonResponse {

        $user = $request->user();

        try {
            // Update user info 
            $user->update([
                'name' =>  $request->name,
                'email' => $request->email
            ]);
            // OK return 
            return response()->json(['message' => 'User updated succesfully!',
                'links' => [
                    'self' => url('/api/user/me'), // self
                    'method' => 'PUT'
                ],[
                    'show your info' => url('/api/user/me'), // link to show logged user info
                    'method' => 'GET'
                ], [
                    'verify e-mail' => url('/api/email/verify/notification'), // link to verify e-mail
                    'method' => 'POST'
                ], [
                    'delete account' => url('/api/user/me'), // link to delete acct
                    'method' => 'DELETE'
                ], [ 
                    'logout' => url('/api/logout'), // link to logout
                    'method' => 'POST'
                ]
            ], 200);

        } catch(Exception $e) {
            // Return error
            return response()->json(['error' => 'User update failed', 'message' => $e->getMessage()], 500);
        }

    }

    public function destroy(UserRequest $request): JsonResponse {
        // Function to delete user account
        $user = $request->user();

        try {
            $user->delete();
            $request->user()->currentAccessToken()->delete();
            // OK return
            return response()->json(['message' => 'User succesfully deleted!',
                'links' => [
                    'all users' => url('/api/users'), // link to show all users
                    'method' => 'GET'
                ], [
                    'register' => url('/api/register'), // link to register
                    'method' => 'POST'
                ]
            ],200);

    } catch(Exception $e) {
        // Return error
        return response()->json(['error' => 'Delete account failed', 'message' => $e->getMessage()], 500);
    }

}

}