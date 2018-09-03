<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest;

use App\User;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class AuthController extends Controller
{
    //registration user
    public function register(RegisterFormRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if ( ! $token = JWTAuth::attempt($credentials)) {
                return response([
                    'status' => 'error',
                    'error' => 'Usuario o contraseña inválida.',
                    'msg' => 'Usuario o contraseña inválida.'
                ], 400);
        }
        return response([
                'status' => 'success'
            ])
            ->header('Authorization', $token);
    }

    public function logout()
        {
            JWTAuth::invalidate();
            return response([
                    'status' => 'success',
                    'msg' => 'Logged out Successfully.'
                ], 200);
        }

    public function user(Request $request)
        {
            $user = User::find(Auth::user()->id);
            return response([
                    'status' => 'success',
                    'data' => $user
                ]);
                }
        public function refresh()
        {
            return response([
                    'status' => 'success'
                ]);
        }

    public function usernamecheck(Request $request)
    {
        $username = $request->only('username');
        $user = User::where('username', $username)->first();

        if(!$user){
            return response([
                'status' => 'success',
                'data' => 'Usuario valido'
            ]);
        }else {
            return response([
                'status' => 'error',
                'data' => 'El usuario ya esta tomado.',
                'error' => 'El usuario ya esta tomado.',
                'msg' => 'El usuario ya esta tomado.'
            ], 422);
        }

    }
    public function emailcheck(Request $request)
    {
        $email = $request->only('email');
        $user = User::where('email', $email)->first();

        if(!$user){
            return response([
                'status' => 'success',
                'data' => 'Email valido'
            ]);
        }else {
            return response([
                'status' => 'error',
                'error' => 'Este email ya esta tomado.',
                'msg' => 'Este email ya esta tomado.'
            ], 422);
        }

    }
}
