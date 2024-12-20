<?php

namespace App\Http\Controllers\Auth;

use App\Models\Tenants\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;

class ForgotPasswordController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return AuthRepository::forgot($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        return AuthRepository::reset($request, $user);
    }
}
