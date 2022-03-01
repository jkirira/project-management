<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Bridge\RefreshToken;
use Laravel\Passport\Bridge\RefreshTokenRepository;
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
            'national_id' => $validated['national_id'],
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
            return response()->json([
                'message' => 'Login Successful!',
                'user' => auth()->user(),
                'token' => $token
            ], 200);
        } else {
            return response()->json(['message' => 'Password and Email do not match our records.'], 401);
        }

    }

    public function logout()
    {
        $user = auth()->user();
        $refreshTokenRepository = app(RefreshTokenRepository::class);
        foreach($user->tokens as $token) {
            $token->revoke();
            $refreshTokenRepository->revokeRefreshToken($token->id);
        }
        return response()->json(['message' => 'Log out successful'], 200);
    }

}
