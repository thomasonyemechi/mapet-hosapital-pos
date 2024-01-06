<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $val = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:4'
        ])->validate();

        if (!Auth::attempt($val, $request->remeber)) {
            return back()->with('error', 'Invalid credentials, please try again');
        }

        return redirect('/pos?trno='.rand(23212,99999999))->with('success', 'Welcome back ' . auth()->user()->name);
    }
}
