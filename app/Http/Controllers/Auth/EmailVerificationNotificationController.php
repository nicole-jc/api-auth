<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['Your e-mail is already verified!',
        'links' => [
            [
                'profile' => url('/api/user/me'), // link to show logged user info
                'method' => 'GET'
            ], [
                'update profile' => url('/api/user/me'), // link to update profile
                'method' => 'PUT'
            ], [
                'delete account' => url('/api/user/me'), // link to delete acct
                'method' => 'DELETE'
            ], [
                'logout' => url('/api/logout'), // link to logout
                'method' => 'POST'
            ]
        ]]);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 'verification-link-sent', 'check your e-mail on Mailtrap inbox']);
    }
}
