<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct() {

    }
    
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')],request('remember_me')
        )){
            $user = Auth::user();

            $tokenResult = $user->createToken('MyApp');
            $token = $tokenResult->token;
            if (request('remember_me'))
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();

            $success['access_token'] =  $tokenResult->accessToken;
            $success['token_type'] = 'Bearer';
            $success['expires_at'] = Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString();
            return response()->json(['success' => $success], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
