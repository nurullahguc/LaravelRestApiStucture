<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function login(Request $request)
    {

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::user();


            $success['token'] = $user->createToken("Login")->accessToken;

            return response()
                ->json([
                    'success' =>  $success
                ], 200);
        }


        return response()
            ->json([
                'error' =>  'Unauthorized'
            ], 401);
    }

    public function logout(Request $request)
    {

        if (Auth::check()) {

            Auth::user()->authUserToken()->delete();

            return response()
                ->json(['message' => 'success logout'], 200);
        }


        return response()
            ->json([
                'error' =>  'Unauthorized'
            ], 401);
    }
}
