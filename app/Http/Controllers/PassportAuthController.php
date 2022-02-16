<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;

use Laravel\Passport\Bridge\RefreshToken;
//use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

class PassportAuthController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {

        $validated = $registerRequest->validated();

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password'])
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout()
    {
        $user = auth()->user();

        $tokens =  $user->tokens->pluck('id');
        Token::whereIn('id', $tokens)
            ->update(['revoked', true]);

        RefreshToken::whereIn('access_token_id', $tokens)->update(['revoked' => true]);
    }
}
