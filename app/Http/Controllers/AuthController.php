<?php

namespace App\Http\Controllers;

use App\Preferences;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
            'name' => 'required|min:3|unique:users'
        ]);

        if ($v->fails()) {

            return response()->json(['status' => 'error', 'errors' => $v->errors()], 422);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->save();

        return response(['status' => 'success', 'data' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        $remember = true;


        if (!$token = Auth::guard()->attempt($credentials, $remember))
            return response(['status' => 'error', 'error' => 'invalid.credentials', 'msg' => 'Invalid Credentials.'], 400);

        $preferences = Preferences::find(Auth::id());
        $preferences->silent = $request['silent'];
        $preferences->update();

        $user = User::find(Auth::id());
        $user->update();

        return response()->json(['status' => 'success', 'user' => $user, 'token' => $token])->header('Authorization', $token);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['status' => 'success', 'msg' => 'Logged out Successfully.'], 200);
    }

    public function user()
    {
        $user = Auth::user();

        return response()->json(['status' => 'success', 'data' => $user], 200);
    }

    public function refresh()
    {
        $user = Auth::user();

        return response($user);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
