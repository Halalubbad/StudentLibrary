<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmailVerificationController extends Controller
{
    //
    public function notice()
    {
        return response()->view('s_library.auth.verify-email');
    }

    public function send(Request $request)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
            return response()->json(['message' => 'Verification email sent successfully'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Your account has been verified!'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function verify(EmailVerificationRequest $emailVerificationRequest)
    {
        $emailVerificationRequest->fulfill();
        
        // Auth::guard('admin');
        if(Auth::user('admin')){
            return redirect()->route('eduAdmin.dashboard');
        }else{
            return redirect()->route('userHome.index');
        } 
    }
}
