<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    function createStaff(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:2'
        ])->validate();


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff'
        ]);

        return back()->with('success', 'Staff profile has been created');
    }


    public function updateStaffInfo(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            
        ])->validate();
    }
}
