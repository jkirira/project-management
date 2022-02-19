<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Bridge\RefreshToken;
use Laravel\Passport\Bridge\RefreshTokenRepository;
//use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

class PasswordController extends Controller
{
   public function update(User $user, Request $request)
   {
       $request->validate([
           'old_password' => 'required',
           'password' => 'required|min:8|confirmed',
       ]);

       if ( !Hash::check($request['old_password'], $user->password) ) {
           return response()->json(['message' => 'Old password is incorrect'], 500);
       }

       $user->update([ 'password' => Hash::make($request['password'])] );

       return response()->json(['message' => 'Password changed successfully'], 200);
   }
}

