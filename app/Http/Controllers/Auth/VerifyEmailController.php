<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): JsonResponse|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {

            return response()->json(['your e-mail is already verified!', [
                [
                    'show your info' => url('/api/user/me'), // link to show logged user info
                    'method' => 'GET'
                ], [
                    'logout' => url('/api/logout'), // link to logout
                    'method' => 'POST'
                ],
                  [
                    'show all users' => url('/api/users'), // link to show all users
                    'method' => 'GET'
                ]
            ]], 200);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json(['your e-mail is verified!', [
            [
                'show your info' => url('/api/user/me'), // link to show logged user info
                'method' => 'GET'
            ], [
                'logout' => url('/api/logout'), // link to logout
                'method' => 'POST'
            ], [
                'show all users' => url('/api/users'), // link to show all users
                'method' => 'GET'
            ]
        ]], 200);
    }
}
