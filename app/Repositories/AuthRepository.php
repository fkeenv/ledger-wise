<?php

namespace App\Repositories;

use App\Models\Tenants\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use App\Notifications\ResetPasswordNotification;

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
        User::create($request->only('email', 'name', 'password'));

        return response()->json(['message' => 'User created successfully'], Response::HTTP_CREATED);
    }

    public static function forgot(Request $request)
    {
        return (new static())->sendResetLink($request);
    }

    public static function reset(Request $request, User $user)
    {
        return (new static())->resetPassword($request, $user);
    }

    protected function attempt()
    {
        $request = request()->only('email', 'password');

        if (! Auth::attempt($request)) {
            return $this->invalidCredentials();
        }

        $user = $this->authenticated();

        return response()->json([
            'token' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
            'expires_at' => now()->addDay(1),
            'message' => 'Login successful',
        ], Response::HTTP_OK);
    }

    protected function sendResetLink(Request $request)
    {
        // TO DO: Send password reset link to user's email
        $email = $request->only('email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        Notification::route('mail', $user->email)->notify(new ResetPasswordNotification($user));

        return response()->json(['message' => 'Password reset link sent to your email'], Response::HTTP_OK);
    }

    protected function resetPassword(Request $request, User $user)
    {
        $data = $request->only(['email', 'password', 'password_confirmation']);

        $user->update([
            'password' => $data['password'],
        ]);

        return response()->json(['message' => 'Password has been changed successfully.'], Response::HTTP_OK);
    }

    /**
     * Get the authenticated user.
     *
     * @return User
     */
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
