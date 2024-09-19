<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRepository
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
