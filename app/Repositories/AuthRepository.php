<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function login(Request $request)
    {
        return (new static())->attempt();
    }

    public static function logout()
    {
        return (new static())->invalidate();
    }

    public static function register(Request $request)
    {
        $user = User::create($request->only('email', 'name', 'password'));

        return response()->json(['message' => 'User created successfully'], Response::HTTP_CREATED);
    }

    public static function forgot(Request $request)
    {
        return (new static())->sendResetLink();
    }

    protected function attempt()
    {
        $request = request()->only('email', 'password');

        if (! Auth::attempt($request)) {
            return $this->invalidCredentials();
        }

        /** @var User $user */
        $user = $this->authenticated();

        return response()->json([
            'token' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
            'expires_at' => now()->addDay(1),
            'message' => 'Login successful',
        ], Response::HTTP_OK);
    }

    protected function sendResetLink()
    {
        // TO DO: Send password reset link to user's email

        return response()->json(['message' => 'Password reset link sent to your email'], Response::HTTP_OK);
    }

    protected function authenticated()
    {
        return Auth::user();
    }

    protected function invalidate()
    {
        $this->authenticated()->tokens()->delete();

        return response()->json(['message' => 'Logout successful'], Response::HTTP_OK);
    }

    protected function invalidCredentials()
    {
        return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }
}
